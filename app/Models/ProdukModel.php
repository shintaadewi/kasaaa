<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['nama_produk', 'id_kategori', 'harga', 'stok_tersedia']; // Pastikan hanya kolom yang ada di tabel

    // Fungsi untuk mengambil produk dengan kolom jumlah dan harga
    public function getProdukWithJumlahHarga()
    {
        return $this->select('id_produk, nama_produk, stok_tersedia AS jumlah, harga')->findAll();
    }
}
