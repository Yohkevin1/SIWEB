<?php

namespace App\Controllers\Kelas;

use App\Controllers\BaseController;

define('_Tittle', 'Container');
class C_Tugas2 extends BaseController
{
    public function index()
    {
        $data = [
            'title' => _Tittle
        ];
        return view('Kelas/Tugas2', $data);
    }
}
