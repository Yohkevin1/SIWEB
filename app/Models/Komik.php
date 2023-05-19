<?php

namespace App\Models;

use CodeIgniter\Model;

class Komik extends Model
{
    protected $table = 'data_komik';
    protected $primaryKey = 'komik_id';
    protected $allowedFields = ['judul', 'cover', 'tahun_rilis', 'penulis', 'harga', 'diskon', 'stock', 'id_kategori'];
    protected $useSoftDeletes = true;

    public function getData($id = false)
    {
        //query builder
        if ($id == false) {
            $this->join('tbl_kategori', 'data_komik.id_kategori = tbl_kategori.id_kategori')
                ->where('deleted_at is null');
            return $this->get()->getResultArray();
        } else {
            $this->join('tbl_kategori', 'data_komik.id_kategori = tbl_kategori.id_kategori');
            $this->where(['komik_id' => $id], 'deleted_at is null');
            return $this->first();
        }


        // $query = $this->db->query("select * from tbl_buku join tbl_kategori using (id_kategori)")->getResultArray();
        // return $query;
    }

    public function insertData($data)
    {
        // $this->db->insertID($data);
        // return $this->db->affected_rows();
    }
}
