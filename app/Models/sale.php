<?php

namespace App\Models;

use CodeIgniter\Model;

class sale extends Model
{
    protected $table = 'tbl_sale';
    protected $useTimestamps = true;
    protected $allowedFields = ['sale_id', 'id_pengguna', 'customer_id'];

    public function getReport($tgl_awal, $tgl_akhir)
    {
        return $this->db->table('tbl_sale_detail as sd')
            ->select('s.sale_id, s.created_at tgl_transaksi, us.id_pengguna, us.firstname, us.lastname,
            us.username, c.customer_id, c.nama nama_cust, c.no_customer ,SUM(sd.total_harga) Total')
            ->join('tbl_sale s', 'sale_id')
            ->join('tbl_user us', 'us.id_pengguna = s.id_pengguna')
            ->join('tbl_customer c', 'customer_id', 'left')
            ->where('date(s.created_at) >=', $tgl_awal)
            ->where('date(s.created_at) <=', $tgl_akhir)
            ->groupBy('s.sale_id')
            ->get()->getResultArray();
    }

    public function getInvoice($id)
    {
        return $this->db->table('tbl_sale_detail as sd')
            ->select(' s.sale_id, s.created_at tgl_transaksi, b.judul_buku, sd.jumlah, sd.diskon ,sd.harga , sd.total_harga Total_Harga')
            ->join('tbl_sale s', 's.sale_id = sd.sale_id')
            ->join('tbl_buku b', 'id_buku', 'left')
            ->where('s.sale_id = ', $id)
            ->get()->getResultArray();
    }
}
