<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $allowedFields = ['id_pemasok', 'tanggal_pembelian', 'total_harga'];

    public function getPembelian()
    {
        // Join dengan tabel pemasok untuk mendapatkan nama pemasok
        return $this->select('pembelian.*, pemasok.nama_pemasok')
            ->join('pemasok', 'pembelian.id_pemasok = pemasok.id_pemasok')
            ->findAll();
    }

    public function savePembelian($data)
    {
        return $this->insert($data);
    }
}
