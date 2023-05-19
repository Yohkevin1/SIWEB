<?php

namespace App\Controllers;

use \App\Models\Book;
use \App\Models\Customer;
use \App\Models\sale_detail;
use \App\Models\sale;
use TCPDF;
use PhpOffice\PhpSpreadsheet;

class C_Penjualan extends BaseController
{
    private $book, $cart, $cust, $sale, $saldet;
    public function __construct()
    {
        $this->book = new Book();
        $this->cart = \Config\Services::cart();
        $this->cust = new Customer();
        $this->sale = new sale();
        $this->saldet = new sale_detail();
    }

    public function index()
    {
        $this->cart->destroy();
        $dataBook = $this->book->getData();
        $dataCust = $this->cust->getData();
        $data = [
            'title' => 'Transaksi Penjualan',
            'dataBuku' => $dataBook,
            'dataCust' => $dataCust
        ];
        // dd($dataBook);
        return view('Penjualan/list', $data);
    }

    public function showCart()
    {
        //Fungsi untuk menampilkan cart
        $output = '';
        $no = 1;
        foreach ($this->cart->contents() as $items) {
            $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
            $output .= '
            <tr>
            <td>' . $no++ . '</td>
            <td>' . $items['name'] . '</td>
            <td>' . $items['qty'] . '</td>
            <td>' . number_to_currency($items['price'], 'IDR', 'id_ID', 2) . '</td>
            <td>' . number_to_currency($diskon, 'IDR', 'id_ID', 2) . '</td>
            <td>' . number_to_currency(($items['subtotal'] - $diskon), 'IDR', 'id_ID', 2) . '</td>
            <td>
            <button id="' . $items['rowid'] . '" qty="' . $items['qty'] . '" class="ubah_cart btn btn-warning btn-xs" title="Ubah Jumlah"><i class="fa fa-edit"></i></button>
            <button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button>
            </td>
            </tr>
            ';
        }

        if (!$this->cart->contents()) {
            $output = '<tr><td colspan="7" align="center">Tidak ada transaksi!</td></tr>';
        }
        return $output;
    }

    public function loadCart()
    {
        //load data cart
        echo $this->showCart();
    }

    public function addCart()
    {
        $this->cart->insert(array(
            'id'      => $this->request->getVar('id'),
            'qty'     => $this->request->getVar('qty'),
            'price'   => $this->request->getVar('price'),
            'name'    => $this->request->getVar('name'),
            'options' => array(
                'discount' => $this->request->getVar('discount')
            )
        ));
        echo $this->showCart();
    }

    public function getTotal()
    {
        $totalBayar = 0;
        foreach ($this->cart->contents() as $items) {
            $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
            $totalBayar += $items['subtotal'] - $diskon;
        }
        echo number_to_currency($totalBayar, 'IDR', 'id_ID', 2);
    }

    public function updateCart()
    {
        $this->cart->update(array(
            'rowid' => $this->request->getVar('rowid'),
            'qty'   => $this->request->getVar('qty')
        ));
        echo $this->showCart();
    }

    public function deleteCart($rowid)
    {
        $this->cart->remove($rowid);
        echo $this->showCart();
    }

    public function pembayaran()
    {
        if (!$this->cart->contents()) {
            //transaksi kosong
            $response = [
                'status' => false,
                'msg' => 'Tidak Ada Transaksi',
            ];
            echo json_encode($response);
        } else {
            //cek customer
            $idcust = $this->request->getVar('id-cust');
            if ($idcust == null) {
                $response = [
                    'status' => false,
                    'msg' => 'Customer Masih Kosong',
                ];
                echo json_encode($response);
            } else {
                //ada transaksi
                $totalBayar = 0;
                $stockAman = true;

                foreach ($this->cart->contents() as $items) {
                    $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
                    $totalBayar += $items['subtotal'] - $diskon;

                    //cek stock buku
                    $book = $this->book->where(['id_buku' => $items['id']])->first();
                    if ($book['jumlah'] < $items['qty']) {
                        $stockAman = false;
                        break;
                    }
                }

                if (!$stockAman) {
                    // Jika stok buku tidak mencukupi
                    $response = [
                        'status' => false,
                        'msg' => 'Stok Buku Tidak Mencukupi',
                    ];
                    echo json_encode($response);
                } else {

                    $nominal = $this->request->getVar('nominal');
                    $id = "J" . time();

                    //pengecekan nominal cukup apa kgk
                    if ($nominal < $totalBayar) {
                        $response = [
                            'status' => false,
                            'msg' => 'Nominal Pembayaran Kurang',

                        ];
                        echo json_encode($response);
                    } else {
                        //jika nominal terpenuhi
                        $this->sale->save([
                            'sale_id' => $id,
                            'id_pengguna' => session()->id_pengguna,
                            'customer_id' => $idcust,
                        ]);
                        foreach ($this->cart->contents() as $items) {
                            // $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
                            $this->saldet->save([
                                'sale_id' => $id,
                                'id_buku' => $items['id'],
                                'jumlah'  => $items['qty'],
                                'harga'   => $items['price'],
                                'diskon'    => $diskon,
                                'total_harga'   => $items['subtotal'] - $diskon,
                            ]);

                            //mengurangi jumlah stock
                            $book = $this->book->where(['id_buku' => $items['id']])->first();
                            $this->book->save([
                                'id_buku' => $items['id'],
                                'jumlah' => $book['jumlah'] - $items['qty'],
                            ]);
                        }

                        $this->cart->destroy();
                        $kembalian = $nominal - $totalBayar;

                        $response = [
                            'status' => true,
                            'msg' => 'Pembayaran berhasil',
                            'data' => [
                                'kembalian' => number_to_currency(
                                    $kembalian,
                                    'IDR',
                                    'id_ID',
                                    2
                                )
                            ],
                        ];
                        echo json_encode($response);
                    }
                }
            }
        }
    }

    public function report()
    {
        $laporan = $this->sale->getReport();
        $data = [
            'title' => 'Laporan Penjualan',
            'laporan' => $laporan
        ];
        return view('Penjualan/report', $data);
    }

    public function exportPDF()
    {
        $laporan = $this->sale->getReport();
        $data = [
            'title' => 'Laporan Penjualan',
            'laporan' => $laporan,
        ];
        $html = view('Penjualan/exportPDF', $data);

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTS-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('apllication/pdf');
        $pdf->Output('Laporan-Penjualan.pdf', 'I');
    }
}
