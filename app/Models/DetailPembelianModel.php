<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPembelianModel extends Model
{
    protected $table = 'detail_pembelian';
    protected $primaryKey = 'id'; // Ganti dengan primary key Anda
    protected $allowedFields = ['id_pembelian', 'id_produk', 'kuantitas'];

    public function getDetailPembelian($idPembelian)
    {
        return $this->where('id_pembelian', $idPembelian)->findAll();
    }
}
