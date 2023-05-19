<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;

define('_Tittle', 'Data Customer');
class C_Customer extends BaseController
{
    public function index()
    {
        $crud = new GroceryCrud();
        $crud->setTable('tbl_customer');
        $crud->setLanguage('indonesian');
        $crud->columns(['nama', 'no_customer', 'gender', 'alamat', 'email', 'no_telp']);
        $crud->unsetColumns(['created_at', 'updated_at', 'deleted_at']);
        $crud->displayAs(array(
            'nama' => 'Nama Customer',
            'no_cutomer' => 'No. Customer',
            'gender' => 'Jenis Kelamin (L/P)',
            'no_telp' => 'Telp',
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
            'no_customer',
            'No. Customer',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );

        $crud->setRule(
            'alamat',
            'Alamat',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );

        $crud->setRule(
            'email',
            'Email',
            'required',
            [
                'required' => '{field} wajib diisi'
            ]
        );

        $crud->setRule(
            'no_telp',
            'No. Hp',
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
        $crud->setTheme('datatables');
        $output = $crud->render();
        $data = [
            'title' => _Tittle,
            'data' => $output
        ];
        return view('Customer/index', $data);
    }
}
