<?php

namespace App\Models;

use CodeIgniter\Model;

class sale_detail extends Model
{
    protected $table = 'tbl_sale_detail';
    protected $allowedFields = ['sale_id', 'id_buku', 'jumlah', 'harga', 'diskon', 'total_harga'];
}
