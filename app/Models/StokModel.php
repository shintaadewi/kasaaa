<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table = 'stok';
    protected $primaryKey = 'id_stok';
    protected $allowedFields = ['id_produk', 'stok_masuk', 'stok_keluar', 'tanggal'];

    public function getStokWithProduk()
    {
        return $this->select('stok.*, produk.nama_produk')
            ->join('produk', 'produk.id_produk = stok.id_produk')
            ->findAll();
    }
}
