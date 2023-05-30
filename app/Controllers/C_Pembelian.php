<?php

namespace App\Controllers;

use \App\Models\Komik;
use \App\Models\Supplier;
use \App\Models\buy_detail;
use \App\Models\buy;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

class C_Pembelian extends BaseController
{
    private $komik, $cart, $Supp, $buy, $buydet;
    public function __construct()
    {
        $this->komik = new Komik();
        $this->cart = \Config\Services::cart();
        $this->Supp = new Supplier();
        $this->buy = new buy();
        $this->buydet = new buy_detail();
    }

    public function index()
    {
        $this->cart->destroy();
        $datakomik = $this->komik->getData();
        $dataSupp = $this->Supp->getData();
        $data = [
            'title' => 'Transaksi Pembelian',
            'datakomik' => $datakomik,
            'dataSupp' => $dataSupp
        ];
        // dd($datakomik);
        return view('Pembelian/listbeli', $data);
    }

    public function showCart()
    {
        //Fungsi untuk menampilkan cart
        $output = '';
        $no = 1;
        foreach ($this->cart->contents() as $items) {
            $output .= '
            <tr>
            <td>' . $no++ . '</td>
            <td>' . $items['name'] . '</td>
            <td>' . $items['qty'] . '</td>
            <td>' . number_to_currency($items['price'], 'IDR', 'id_ID', 2) . '</td>
            <td>' . number_to_currency(($items['subtotal']), 'IDR', 'id_ID', 2) . '</td>
            <td>
            <button id="' . $items['rowid'] . '" qty="' . $items['qty'] . '" class="ubah_cart btn btn-warning btn-xs" title="Ubah Jumlah"><i class="fa fa-edit"></i></button>
            <button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-xs"><i class="fa fa-trash" title="Hapus"></i></button>
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
            // 'options' => array(
            //     'discount' => $this->request->getVar('discount')
            // )
        ));
        echo $this->showCart();
    }

    public function getTotal()
    {
        $totalBayar = 0;
        foreach ($this->cart->contents() as $items) {
            // $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
            $totalBayar += $items['subtotal'];
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
            $idsupp = $this->request->getVar('id-supp');
            if ($idsupp == null) {
                $response = [
                    'status' => false,
                    'msg' => 'Supplier Masih Kosong',
                ];
                echo json_encode($response);
            } else {
                //ada transaksi
                $totalBayar = 0;
                $stockAman = true;
                foreach ($this->cart->contents() as $items) {
                    // $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
                    $totalBayar += $items['subtotal'];

                    $komik = $this->komik->where(['komik_id' => $items['id']])->first();
                    if ($komik['stock'] < $items['qty']) {
                        $stockAman = false;
                        break;
                    }
                }
                if (!$stockAman) {
                    // Jika stok buku tidak mencukupi
                    $response = [
                        'status' => false,
                        'msg' => 'Stok Komik Tidak Mencukupi',
                    ];
                    echo json_encode($response);
                } else {
                    $nominal = $this->request->getVar('nominal');
                    //pengecekan nominal cukup apa kgk
                    if ($nominal < $totalBayar) {
                        $response = [
                            'status' => false,
                            'msg' => 'Nominal Pembayaran Kurang',

                        ];
                        echo json_encode($response);
                    } else {
                        //jika nominal terpenuhi
                        $id = "B" . time();
                        $this->buy->save([
                            'buy_id' => $id,
                            'id_pengguna' => session()->id_pengguna,
                            'supplier_id' => $idsupp,
                        ]);
                        foreach ($this->cart->contents() as $items) {
                            // $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
                            $this->buydet->save([
                                'buy_id' => $id,
                                'komik_id' => $items['id'],
                                'jumlah'  => $items['qty'],
                                'harga'   => $items['price'],
                                // 'diskon'    => $diskon,
                                'total_harga'   => $items['subtotal'],
                            ]);

                            //mengurangi jumlah komik
                            $komik = $this->komik->where(['komik_id' => $items['id']])->first();
                            $this->komik->save([
                                'komik_id' => $items['id'],
                                'stock' => $komik['stock'] - $items['qty'],
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

    public function report($tgl_awal = null, $tgl_akhir = null)
    {
        $_SESSION['tgl_awal'] = $tgl_awal == null ? date('Y-m-01') : $tgl_awal;
        $_SESSION['tgl_akhir'] = $tgl_akhir == null ? date('Y-m-t') : $tgl_akhir;

        $tgl1 = $_SESSION['tgl_awal'];
        $tgl2 = $_SESSION['tgl_akhir'];

        $laporan = $this->buy->getReport($tgl1, $tgl2);
        $data = [
            'title' => 'Laporan Pembelian',
            'laporan' => $laporan,
            'tanggal' => [
                'tgl_awal' => $tgl1,
                'tgl_akhir' => $tgl2,
            ],
        ];
        // dd($laporan);
        return view('Pembelian/report_beli', $data);
    }

    public function exportPDF()
    {
        $tgl1 = $_SESSION['tgl_awal'];
        $tgl2 = $_SESSION['tgl_akhir'];

        $laporan = $this->buy->getReport($tgl1, $tgl2);
        $data = [
            'title' => 'Laporan Pembelian',
            'laporan' => $laporan,
        ];
        $html = view('Pembelian/exportPDF', $data);

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTS-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('apllication/pdf');
        $pdf->Output('Laporan-Pembelian.pdf', 'I');
    }

    public function exportInvoice($id)
    {
        $laporan = $this->buy->getInvoice($id);
        $data = [
            'title' => 'Invoice Pembelian',
            'laporan' => $laporan,
        ];
        // dd($laporan);
        $html = view('Pembelian/invoice_beli', $data);

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTS-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('apllication/pdf');
        $pdf->Output('Invoice-Penjualan.pdf', 'I');
    }

    public function exportExcel()
    {
        $tgl1 = $_SESSION['tgl_awal'];
        $tgl2 = $_SESSION['tgl_akhir'];

        $laporan = $this->buy->getReport($tgl1, $tgl2);

        $spreadsheet = new Spreadsheet();

        //tulis header/nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nota')
            ->setCellValue('C1', 'Tgl Transaksi')
            ->setCellValue('D1', 'User')
            ->setCellValue('E1', 'Customer')
            ->setCellValue('F1', 'Total');

        //tulis data buku ke cell
        $rows = 2;
        $no = 1;
        foreach ($laporan as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $rows, $no++)
                ->setCellValue('B' . $rows, $value['buy_id'])
                ->setCellValue('C' . $rows, $value['tgl_transaksi'])
                ->setCellValue('D' . $rows, $value['firstname'] . ' ' . $value['lastname'])
                ->setCellValue('E' . $rows, $value['nama_supp'])
                ->setCellValue('F' . $rows, $value['Total']);
            $rows++;
        }

        //tulis dalam format xlsx
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan-Pembelian';

        //redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function filter()
    {
        $_SESSION['tgl_awal'] = $this->request->getVar('tgl_awal');
        $_SESSION['tgl_akhir'] = $this->request->getVar('tgl_akhir');
        return $this->report($_SESSION['tgl_awal'], $_SESSION['tgl_akhir']);
    }
}
