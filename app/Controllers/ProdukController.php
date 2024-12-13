<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;

class ProdukController extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        // Ambil data produk dengan nama kategori
        $produk = $this->produkModel->select('produk.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = produk.id_kategori')
            ->findAll();

        $data['produk'] = $produk;

        return view('produk/index', $data);
    }

    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('produk/create', $data);
    }

    public function store()
    {
        // Validasi input
        $this->validate([
            'nama_produk' => 'required|min_length[3]',
            'id_kategori' => 'required|is_not_unique[kategori.id_kategori]', // Pastikan kategori ada
            'harga' => 'required|decimal',
            'stok_tersedia' => 'required|integer' // Pastikan stok diisi
        ]);

        // Simpan data produk
        $this->produkModel->save([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga' => $this->request->getPost('harga'),
            'stok_tersedia' => $this->request->getPost('stok_tersedia') // Pastikan ini sesuai dengan nama kolom di database
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil produk berdasarkan id
        $data['produk'] = $this->produkModel->find($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('produk/edit', $data);
    }

    public function update($id)
    {
        // Validasi input
        $this->validate([
            'nama_produk' => 'required|min_length[3]',
            'id_kategori' => 'required|is_not_unique[kategori.id_kategori]', // Pastikan kategori ada
            'harga' => 'required|decimal',
            'stok_tersedia' => 'required|integer' // Pastikan stok diisi
        ]);

        // Update data produk
        $this->produkModel->update($id, [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga' => $this->request->getPost('harga'),
            'stok_tersedia' => $this->request->getPost('stok_tersedia') // Pastikan ini sesuai dengan nama kolom di database
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Hapus produk berdasarkan id
        $this->produkModel->delete($id);
        return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
