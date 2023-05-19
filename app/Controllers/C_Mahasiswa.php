<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;

define('_Tittle', 'Data Mahasiswa');
class C_Mahasiswa extends BaseController
{
    public function index()
    {
        $crud = new GroceryCrud();
        $crud->setTable('mahasiswa_1137');
        $crud->setLanguage('indonesian');
        $crud->columns(['nama', 'tempat_lahir', 'gender', 'hobi', 'kategori_favorit']);
        $crud->unsetColumns(['created_at', 'updated_at', 'deleted_at']);
        $crud->displayAs(array(
            'nama' => 'Nama Mahasiswa',
            'gender' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'hobi' => 'Hobi',
            'kategori_favorit' => 'Buku Favorit'
        ));
        $crud->where('deleted_at', null);
        $crud->unsetAddFields(['created_at', 'updated_at', 'deleted_at']);
        $crud->unsetEditFields(['created_at', 'updated_at', 'deleted_at']);
        $crud->setRule(
            'nama',
            'Nama Customer',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );
        $crud->setRule(
            'gender',
            'Jenis Kelamin',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );

        $crud->setRule(
            'tempat_lahir',
            'Tempat Lahir',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );

        $crud->setRule(
            'hobi',
            'Hobi',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );

        $crud->setRule(
            'kategori_favorit',
            'Kategori favorit',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );

        // $crud->unsetAdd();
        // $crud->unsetEdit();
        // $crud->unsetDelete();
        $crud->unsetExport();
        $crud->unsetPrint();
        $crud->setRelation('kategori_favorit', 'tbl_kategori', 'nama_kategori');
        $crud->setTheme('datatables');
        $output = $crud->render();
        $data = [
            'title' => _Tittle,
            'data' => $output
        ];
        return view('Mahasiswa/index', $data);
    }
}
