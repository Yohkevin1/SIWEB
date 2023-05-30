<?php

namespace App\Controllers;

use App\Models\Komik as KomikModel;
use App\Models\Kategori_Book;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

define('_Tittle', 'Komik');
class C_Komik extends BaseController
{
    private $komik_model, $kategori_komik_model, $rules;
    public function __construct()
    {
        $this->komik_model = new KomikModel();
        $this->kategori_komik_model = new Kategori_Book();
        $this->rules = [
            'judul' => [
                'rules' => 'required|is_unique[data_komik.judul]',
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah digunakan.'
                ]
            ],
            'tahun_rilis' => [
                'rules' => 'required|numeric',
                'label' => 'Tahun terbit',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} hanya bisa diisi dengan angka.'
                ]
            ],
            'penulis'  => [
                'rules' => 'required',
                'label' => 'Penulis',
                'errors' => [
                    'required' => '{field} harus diisi.'
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
            'stock' => [
                'rules' => 'required|numeric',
                'label' => 'Jumlah',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} hanya bisa diisi dengan angka.'
                ]
            ],
            'cover' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB.',
                    'is_image' => 'Yang anda pilih bukan {field}.',
                    'mime_in' => 'Yang anda pilih bukan {field}'
                ]
            ]
        ];
    }

    public function index()
    {
        $dataKomik = $this->komik_model->getData();
        $dataKomik = [
            'title' => _Tittle,
            'dataKomik' => $dataKomik
        ];
        // dd($dataKomik);
        return view('Komik/index', $dataKomik);
    }

    public function detail($id)
    {
        $dataKomik = $this->komik_model->getData($id);
        $dataKomik = [
            'title' => _Tittle,
            'dataKomik' => $dataKomik
        ];
        // dd($dataKomik);
        return view('Komik/detail', $dataKomik);
    }

    public function insert()
    {
        session();
        $dataKomik = [
            'title' => _Tittle,
            'tbl_kategori' => $this->kategori_komik_model->orderby('nama_kategori')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($kategori_buku_model->findAll());
        return view('komik/create', $dataKomik);
    }

    public function save()
    {
        // dd($this->request->getVar('judul_buku'));
        $rules = $this->rules;

        if (!$this->validate($rules)) {
            // dd(\config\Services::validation()->getErrors());
            return redirect()->to('/komik-create')->withInput();
        }

        $cover = $this->request->getFile('cover');
        if ($cover->getError() == 4) {
            $namaFile = $this->defaultImage;
        } else {
            $namaFile = $cover->getRandomName();
            $cover->move('img', $namaFile);
        }

        if ($this->komik_model->save([
            'judul' => $this->request->getVar('judul'),
            'tahun_rilis' => $this->request->getVar('tahun_rilis'),
            'harga' => $this->request->getVar('harga'),
            'penulis' => $this->request->getVar('penulis'),
            'stock' => $this->request->getVar('stock'),
            'diskon' => $this->request->getVar('diskon'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'cover' => $namaFile
        ])) {
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
        }
        return redirect()->to('/komik');
    }

    public function hal_update($id)
    {
        $dataKomik = $this->komik_model->getData($id);
        if (empty($dataKomik)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul buku $id tidak ditemukan");
        }
        $data = [
            'title' => "Update " . _Tittle,
            'tbl_kategori' => $this->kategori_komik_model->findAll(),
            'validation' => \config\Services::validation(),
            'dataKomik' => $dataKomik
        ];
        // dd($dataKomik);
        return view('Komik/update', $data);
    }

    public function update($id)
    {
        if (!$this->validate(
            [
                'judul' => [
                    'rules' => 'required',
                    'label' => 'Judul',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah digunakan.'
                    ]
                ],
                'tahun_rilis' => [
                    'rules' => 'required|numeric',
                    'label' => 'Tahun terbit',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'numeric' => '{field} hanya bisa diisi dengan angka.'
                    ]
                ],
                'penulis'  => [
                    'rules' => 'required',
                    'label' => 'Penulis',
                    'errors' => [
                        'required' => '{field} harus diisi.'
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
                'stock' => [
                    'rules' => 'required|numeric',
                    'label' => 'Jumlah',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'numeric' => '{field} hanya bisa diisi dengan angka.'
                    ]
                ],

            ]
        )) {
            // dd(\config\Services::validation()->getErrors());
            return redirect()->to('komik-update/' . $id)->withInput();
        }

        $namaFileLama = $this->request->getVar('coverLama');
        $sampul = $this->request->getFile('cover');
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

        if ($this->komik_model->save([
            'komik_id' => $id,
            'judul' => $this->request->getVar('judul'),
            'tahun_rilis' => $this->request->getVar('tahun_rilis'),
            'harga' => $this->request->getVar('harga'),
            'penulis' => $this->request->getVar('penulis'),
            'stock' => $this->request->getVar('stock'),
            'diskon' => $this->request->getVar('diskon'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'cover' => $namaFile
        ])) {
            session()->setFlashdata('success', 'Data berhasil diupdate');
        } else {
            session()->setFlashdata('error', 'Data gagal diupdate');
        }
        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $dataKomik = $this->komik_model->find($id);
        $this->komik_model->delete($id);
        if ($dataKomik['cover'] != $this->defaultImage) {
            unlink('img/' . $dataKomik['cover']);
            $this->komik_model->save([
                'komik_id' => $dataKomik['komik_id'],
                'judul' => $dataKomik['judul'],
                'tahun_rilis' => $dataKomik['tahun_rilis'],
                'harga' => $dataKomik['harga'],
                'penulis' => $dataKomik['penulis'],
                'stock' => $dataKomik['stock'],
                'diskon' => $dataKomik['diskon'],
                'id_kategori' => $dataKomik['id_kategori'],
                'cover' => $this->defaultImage
            ]);
        }
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/komik');
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
            // dd($slug);
            $dataLama = $this->komik_model->cekJudul($slug);

            if (!$dataLama) {
                $this->komik_model->save([
                    'judul' => $value[1],
                    'tahun_rilis' => $value[2],
                    'penulis' => $value[3],
                    'id_kategori' => $value[4],
                    'diskon' => $value[5],
                    'harga' => $value[6],
                    'stock' => $value[7],
                    'cover' => $namaFile
                ]);
                session()->setFlashdata('success', 'Data berhasil diimport');
            }
        }

        return redirect()->to('/komik');
    }
}
