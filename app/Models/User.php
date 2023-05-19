<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_pengguna';
    protected $allowedFields = ['firstname', 'lastname', 'email', 'username', 'password', 'role', 'user_created_at'];

    public function getData($id = false)
    {
        //query builder
        if ($id == false) {
            // $this->join('komik_kategori', 'data_komik.id_kategori = komik_kategori.id_kategori')
            //     ->where('deleted_at is null');
            return $this->get()->getResultArray();
        } else {
            // $this->join('komik_kategori', 'data_komik.id_kategori = komik_kategori.id_kategori');
            $this->where(['id_pengguna' => $id]);
            return $this->first();
        }


        // $query = $this->db->query("select * from tbl_buku join tbl_kategori using (id_kategori)")->getResultArray();
        // return $query;
    }
}
