<?php

namespace App\Models;

use CodeIgniter\Model;

class Supplier extends Model
{
    protected $table = 'tbl_supplier';
    protected $primaryKey = 'supplier_id';
    protected $allowedFields = ['nama', 'no_supplier', 'gender', 'email', 'alamat', 'no_telp'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    public function getData($id = false)
    {
        //query builder
        if ($id == false) {
            return $this->get()->getResultArray();
        } else {
            $this->where(['supplier_id' => $id]);
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
