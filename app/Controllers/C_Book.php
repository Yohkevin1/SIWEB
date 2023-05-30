<?php

namespace App\Controllers;

use App\Models\Book as BookModel;
use App\Models\Kategori_Book;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

define('_Tittle', 'Buku');
class C_Book extends BaseController
{
    private $book_model, $kategori_buku_model, $rules;
    public function __construct()
    {
        $this->book_model = new BookModel();
        $this->kategori_buku_model = new Kategori_Book();
        $this->rules = [
            'judul_buku' => [
                'rules' => 'required|is_unique[tbl_buku.judul_buku]',
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah digunakan.'
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'required|numeric',
                'label' => 'Tahun terbit',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} hanya bisa diisi dengan angka.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'label' => 'Penerbit',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ],
            'penulis'  => [
                'rules' => 'required',
                'label' => 'Penulis',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'label' => 'Jumlah',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} hanya bisa diisi dengan angka.'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB.',
                    'is_image' => 'Yang anda pilih bukan {field}.',
                    'mime_in' => 'Yang anda pilih bukan {field}'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'label' => 'Jumlah',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} hanya bisa diisi dengan angka.'
                ]
            ],
            'diskon' => [
                'rules' => 'permit_empty|decimal',
                'label' => 'Diskon',
                'errors' => [
                    'decimal' => '{field} hanya bisa diisi dengan angka decimal.'
                ]
            ],
        ];
    }

    public function index()
    {
        $dataBuku = $this->book_model->getData();
        $data = [
            'title' => _Tittle,
            'dataBuku' => $dataBuku
        ];
        // dd($dataBuku);
        return view('Book/index', $data);
    }

    public function detail($id)
    {
        $dataBuku = $this->book_model->getData($id);
        $data = [
            'title' => _Tittle,
            'dataBuku' => $dataBuku
        ];
        // dd($dataBuku);
        return view('book/detail', $data);
    }

    public function insert()
    {
        session();
        $data = [
            'title' => _Tittle,
            'tbl_kategori' => $this->kategori_buku_model->orderby('nama_kategori')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($kategori_buku_model->findAll());
        return view('book/create', $data);
    }

    public function hal_update($id)
    {
        $dataBuku = $this->book_model->getData($id);
        if (empty($dataBuku)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul buku $id tidak ditemukan");
        }
        $data = [
            'title' => "Update " . _Tittle,
            'tbl_kategori' => $this->kategori_buku_model->findAll(),
            'validation' => \config\Services::validation(),
            'dataBuku' => $dataBuku
        ];
        // dd($dataBuku);
        return view('Book/update', $data);
    }

    public function update($id)
    {
        if (!$this->validate(
            [
                'judul_buku' => [
                    'rules' => 'required',
                    'label' => 'Judul',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah digunakan.'
                    ]
                ],
                'tahun_terbit' => [
                    'rules' => 'required|numeric',
                    'label' => 'Tahun terbit',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'numeric' => '{field} hanya bisa diisi dengan angka.'
                    ]
                ],
                'penerbit' => [
                    'rules' => 'required',
                    'label' => 'Penerbit',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'penulis'  => [
                    'rules' => 'required',
                    'label' => 'Penulis',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'jumlah' => [
                    'rules' => 'required|numeric',
                    'label' => 'Jumlah',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'numeric' => '{field} hanya bisa diisi dengan angka.'
                    ]
                ],
                'gambar' => [
                    'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                    'label' => 'Gambar',
                    'errors' => [
                        'max_size' => '{field} tidak boleh lebih dari 1MB.',
                        'is_image' => 'Yang anda pilih bukan {field}.',
                        'mime_in' => 'Yang anda pilih bukan {field}'
                    ]
                ],
                'harga' => [
                    'rules' => 'required|numeric',
                    'label' => 'Jumlah',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'numeric' => '{field} hanya bisa diisi dengan angka.'
                    ]
                ],
                'diskon' => [
                    'rules' => 'permit_empty|decimal',
                    'label' => 'Diskon',
                    'errors' => [
                        'decimal' => '{field} hanya bisa diisi dengan angka decimal.'
                    ]
                ],
            ]
        )) {
            // dd(\config\Services::validation()->getErrors());
            return redirect()->to('book-update/' . $id)->withInput();
        }

        $namaFileLama = $this->request->getVar('gambarlama');
        $sampul = $this->request->getFile('gambar');
        if ($sampul->getError() == 4) {
            $namaFile = $namaFileLama;
            // if ($sampul == "") {
            //     $namaFile = $namaFileLama;
            // }
        } else {
            $namaFile = $sampul->getRandomName();
            $sampul->move('img', $namaFile);
            if ($namaFileLama != $this->defaultImage && $namaFileLama != "") {
                unlink('img/' . $namaFileLama);
            }
        }

        if ($this->book_model->save([
            'id_buku' => $id,
            'judul_buku' => $this->request->getVar('judul_buku'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'penerbit' => $this->request->getVar('penerbit'),
            'penulis' => $this->request->getVar('penulis'),
            'jumlah' => $this->request->getVar('jumlah'),
            'diskon' => $this->request->getVar('diskon'),
            'harga' => $this->request->getVar('harga'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'gambar' => $namaFile
        ])) {
            session()->setFlashdata('success', 'Data berhasil diupdate');
        } else {
            session()->setFlashdata('error', 'Data gagal diupdate');
        }
        return redirect()->to('/book');
    }

    public function save()
    {
        // dd($this->request->getVar('judul_buku'));

        if (!$this->validate(
            $this->rules
        )) {
            // dd(\config\Services::validation()->getErrors());
            return redirect()->to('/book-create')->withInput();
        }

        $sampul = $this->request->getFile('gambar');
        if ($sampul->getError() == 4) {
            $namaFile = $this->defaultImage;
        } else {
            $namaFile = $sampul->getRandomName();
            $sampul->move('img', $namaFile);
        }

        if ($this->book_model->save([
            'judul_buku' => $this->request->getVar('judul_buku'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'penerbit' => $this->request->getVar('penerbit'),
            'penulis' => $this->request->getVar('penulis'),
            'jumlah' => $this->request->getVar('jumlah'),
            'diskon' => $this->request->getVar('diskon'),
            'harga' => $this->request->getVar('harga'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'gambar' => $namaFile
        ])) {
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
        }
        return redirect()->to('/book');
    }

    public function delete($id)
    {
        $databuku = $this->book_model->find($id);
        $this->book_model->delete($id);
        if ($databuku['gambar'] != $this->defaultImage) {
            unlink('img/' . $databuku['gambar']);
            $this->book_model->save([
                'id_buku' => $databuku['id_buku'],
                'judul' => $databuku['judul_buku'],
                'tahun_rilis' => $databuku['tahun_terbit'],
                'harga' => $databuku['harga'],
                'penerbit' => $databuku['penerbit'],
                'penulis' => $databuku['penulis'],
                'jumlah' => $databuku['jumlah'],
                'diskon' => $databuku['diskon'],
                'id_kategori' => $databuku['id_kategori'],
                'gambar' => $this->defaultImage
            ]);
        }
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/book');
    }

    public function import()
    {
        $file = $this->request->getFile("file");
        $ext = $file->getExtension();
        if ($ext == "xls")
            $reader = new Xls();
        else
            $reader = new Xlsx();

        $excel = $reader->load($file);
        $sheet = $excel->getActiveSheet()->toArray();

        foreach ($sheet as $key => $value) {
            if ($key == 0) continue;

            $namaFile = $this->defaultImage;
            $slug = url_title($value[1], ' ', true);

            $dataLama = $this->book_model->cekJudul($slug);
            if (!$dataLama) {
                $this->book_model->save([
                    'judul_buku' => $value[1],
                    'tahun_terbit' => $value[2],
                    'penerbit' => $value[3],
                    'penulis' => $value[4],
                    'id_kategori' => $value[5],
                    'diskon' => $value[6],
                    'harga' => $value[7],
                    'jumlah' => $value[8],
                    'gambar' => $namaFile
                ]);
                session()->setFlashdata('success', 'Data berhasil diimport');
            }
        }

        return redirect()->to('/book');
    }
}
