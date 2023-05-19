<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table = 'tbl_buku';
    protected $primaryKey = 'id_buku';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul_buku', 'gambar', 'tahun_terbit', 'penerbit', 'penulis', 'jumlah', 'id_kategori', 'harga', 'diskon'];
    protected $useSoftDeletes = true;

    public function getData($id = false)
    {
        //query builder
        if ($id == false) {
            $this->join('tbl_kategori', 'tbl_buku.id_kategori = tbl_kategori.id_kategori')
                ->where('deleted_at is null');
            return $this->get()->getResultArray();
        } else {
            $this->join('tbl_kategori', 'tbl_buku.id_kategori = tbl_kategori.id_kategori');
            $this->where(['id_buku' => $id]);
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
