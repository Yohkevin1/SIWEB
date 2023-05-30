<?php

namespace App\Models;

use CodeIgniter\Model;

class dashboardModel extends Model
{

    public function reportTransaksi($tahun)
    {
        return $this->db->table('tbl_sale_detail as sd')
            ->select('MONTH(s.created_at) month, SUM(sd.total_harga) Total')
            ->join('tbl_sale s', 'sale_id')
            ->where('YEAR(s.created_at)', $tahun)
            ->orderBy('MONTH(s.created_at)')
            ->get()->getResultArray();
    }

    public function reportCust($tahun)
    {
        return $this->db->table('tbl_customer')
            ->select('MONTH(created_at) month, COUNT(*) Total')
            ->where('YEAR(created_at)', $tahun)
            ->groupBy('MONTH(created_at)')
            ->orderBy('MONTH(created_at)')
            ->get()->getResultArray();
    }
}
