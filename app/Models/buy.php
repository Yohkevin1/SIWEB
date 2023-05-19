<?php

namespace App\Models;

use CodeIgniter\Model;

class buy extends Model
{
    protected $table = 'tbl_buy';
    protected $useTimestamps = true;
    protected $allowedFields = ['sale_id', 'id_pengguna', 'supplier_id'];
}
