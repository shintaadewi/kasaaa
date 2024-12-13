<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPenjualanModel extends Model
{
    protected $table = 'detail_penjualan';
    protected $primaryKey = 'id_detail_penjualan';
    protected $allowedFields = ['id_penjualan', 'id_produk', 'kuantitas', 'harga_satuan', 'jumlah'];

    public function getDetailPenjualan($idPenjualan)
    {
        return $this->where('id_penjualan', $idPenjualan)->findAll();
    }
}
