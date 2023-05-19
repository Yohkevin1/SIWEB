<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table = 'tbl_customer';
    protected $primaryKey = 'customer_id';
    protected $allowedFields = ['nama', 'no_customer', 'gender', 'email', 'alamat', 'no_telp'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    public function getData($id = false)
    {
        //query builder
        if ($id == false) {
            return $this->get()->getResultArray();
        } else {
            $this->where(['customer_id' => $id]);
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
