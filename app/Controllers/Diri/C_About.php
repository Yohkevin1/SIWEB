<?php

namespace App\Controllers\Diri;

use App\Controllers\BaseController;

class C_About extends BaseController
{
    public function index()
    {
        return view('Kelas/V_about');
    }

    public function aku()
    {
        return view('Kelas/V_datadiri');
    }

    public function organisasi()
    {
        return view('Kelas/V_organisasi');
    }
}
