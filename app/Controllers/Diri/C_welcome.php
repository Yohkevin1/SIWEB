<?php

namespace App\Controllers\Diri;

use App\Controllers\BaseController;

class C_welcome extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function contact()
    {
        return view('Kelas/V_contact');
    }
}
