<?php

namespace App\Models;

use CodeIgniter\Model;

class buy extends Model
{
    protected $table = 'tbl_buy';
    protected $useTimestamps = true;
    protected $allowedFields = ['buy_id', 'id_pengguna', 'supplier_id'];

    public function getReport($tgl_awal, $tgl_akhir)
    {
        return $this->db->table('tbl_buy_detail as bd')
            ->select('b.buy_id, b.created_at tgl_transaksi, us.id_pengguna, us.firstname, us.lastname,
            us.username, s.supplier_id, s.nama nama_supp, s.no_supplier, SUM(bd.total_harga) Total')
            ->join('tbl_buy b', 'buy_id')
            ->join('tbl_user us', 'us.id_pengguna = b.id_pengguna')
            ->join('tbl_supplier s', 'supplier_id', 'left')
            ->where('date(b.created_at) >=', $tgl_awal)
            ->where('date(b.created_at) <=', $tgl_akhir)
            ->groupBy('b.buy_id')
            ->get()->getResultArray();
    }

    public function getInvoice($id)
    {
        return $this->db->table('tbl_buy_detail as bd')
            ->select('b.buy_id, b.created_at tgl_transaksi, dk.judul, bd.jumlah ,bd.harga ,bd.total_harga Total_Harga')
            ->join('tbl_buy b', 'buy_id')
            ->join('data_komik dk', 'komik_id', 'left')
            ->where('b.buy_id', $id)
            ->get()->getResultArray();
    }
}
