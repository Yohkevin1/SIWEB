<?php

namespace App\Models;

use CodeIgniter\Model;

class buy_detail extends Model
{
    protected $table = 'tbl_buy_detail';
    protected $allowedFields = ['sale_id', 'komik_id', 'jumlah', 'harga', 'diskon', 'total_harga'];
}
