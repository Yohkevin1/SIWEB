<?php

namespace App\Controllers\Kelas;

use App\Controllers\BaseController;

define('_Tittle', 'Container');
class C_Datadiri extends BaseController
{
    public function index()
    {
        $data = [
            'title' => _Tittle
        ];
        return view('Kelas/datadiri', $data);
    }
}
