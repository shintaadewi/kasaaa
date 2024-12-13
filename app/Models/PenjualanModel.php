<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $allowedFields = ['id_pelanggan', 'total_harga', 'tanggal_penjualan'];

    public function getPenjualanWithPelanggan()
    {
        return $this->select('penjualan.*, pelanggan.nama_pelanggan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan')
            ->findAll();
    }

    public function getPenjualanProduk($id_penjualan)
{
    // Misalnya, jika menggunakan tabel 'penjualan_produk' untuk detail produk
    return $this->db->table('penjualan')
        ->where('id_penjualan', $id_penjualan)
        ->get()
        ->getResultArray();
}

}
