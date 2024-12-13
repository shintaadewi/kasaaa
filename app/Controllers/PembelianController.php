<?php

namespace App\Controllers;

use App\Models\PembelianModel;
use App\Models\DetailPembelianModel; // Tambahkan ini
use App\Models\PemasokModel; // Tambahkan ini
use App\Models\ProdukModel; // Tambahkan ini

class PembelianController extends BaseController
{
    public function index()
    {
        $model = new PembelianModel();
        $data['pembelian'] = $model->getPembelian();
        return view('pembelian/index', $data);
    }

    public function create()
    {
        // Ambil data pemasok dan produk untuk dropdown
        $modelPemasok = new PemasokModel();
        $modelProduk = new ProdukModel();

        $data['pemasok'] = $modelPemasok->findAll();
        $data['produk'] = $modelProduk->findAll();
        return view('pembelian/create', $data);
    }

    public function store()
    {
        $model = new PembelianModel();

        // Validasi input
        $this->validate([
            'id_pemasok' => 'required',
            'tanggal_pembelian' => 'required',
            'detail_pembelian' => 'required'
        ]);

        // Data yang akan disimpan
        $data = [
            'id_pemasok' => $this->request->getPost('id_pemasok'),
            'tanggal_pembelian' => $this->request->getPost('tanggal_pembelian'),
            'total_harga' => 0 // Set total_harga awalnya 0
        ];

        // Simpan pembelian dan dapatkan id_pembelian yang baru
        $model->savePembelian($data);
        $id_pembelian = $model->insertID();

        // Proses detail pembelian dan hitung total harga
        $total_harga = 0;
        foreach ($this->request->getPost('detail_pembelian') as $detail) {
            $detailData = [
                'id_pembelian' => $id_pembelian,
                'id_produk' => $detail['id_produk'],
                'kuantitas' => $detail['kuantitas']
            ];

            // Simpan detail pembelian
            $modelDetail = new \App\Models\DetailPembelianModel();
            $modelDetail->insert($detailData);

            // Hitung total harga
            $produkModel = new \App\Models\ProdukModel();
            $produk = $produkModel->find($detail['id_produk']);
            $total_harga += $produk['harga'] * $detail['kuantitas'];

            // Update stok
            $stokModel = new \App\Models\StokModel();
            $stokModel->save([
                'id_produk' => $detail['id_produk'],
                'stok_masuk' => $detail['kuantitas'], // Menambah stok
                'stok_keluar' => 0,
                'tanggal' => date('Y-m-d') // Gunakan tanggal hari ini
            ]);
        }

        // Update total_harga di tabel pembelian
        $model->update($id_pembelian, ['total_harga' => $total_harga]);

        return redirect()->to('/pembelian')->with('success', 'Pembelian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new PembelianModel();
        $data['pembelian'] = $model->find($id);

        // Ambil data pemasok dan produk untuk dropdown
        $modelPemasok = new \App\Models\PemasokModel();
        $modelProduk = new \App\Models\ProdukModel();

        // Ambil data detail pembelian
        $modelDetail = new \App\Models\DetailPembelianModel();
        $data['detailPembelian'] = $modelDetail->where('id_pembelian', $id)->findAll();

        $data['pemasok'] = $modelPemasok->findAll();
        $data['produk'] = $modelProduk->findAll();

        return view('pembelian/edit', $data);
    }


    public function update($id)
    {
        // Proses untuk memperbarui data pembelian
        $model = new PembelianModel();

        // Validasi input
        $this->validate([
            'id_pemasok' => 'required',
            'tanggal_pembelian' => 'required',
            'detail_pembelian' => 'required'
        ]);

        // Data yang akan diperbarui
        $data = [
            'id_pemasok' => $this->request->getPost('id_pemasok'),
            'tanggal_pembelian' => $this->request->getPost('tanggal_pembelian'),
            'total_harga' => 0 // Set total_harga awalnya 0
        ];

        // Perbarui pembelian
        $model->update($id, $data);

        // Proses detail pembelian dan hitung total harga
        $total_harga = 0;
        $modelDetail = new DetailPembelianModel();

        // Hapus detail lama jika ada
        $modelDetail->where('id_pembelian', $id)->delete();

        foreach ($this->request->getPost('detail_pembelian') as $detail) {
            $detailData = [
                'id_pembelian' => $id,
                'id_produk' => $detail['id_produk'],
                'kuantitas' => $detail['kuantitas']
            ];
            // Simpan detail pembelian
            $modelDetail->insert($detailData);

            // Hitung total harga
            $produkModel = new ProdukModel();
            $produk = $produkModel->find($detail['id_produk']);
            $total_harga += $produk['harga'] * $detail['kuantitas'];
        }

        // Update total_harga di tabel pembelian
        $model->update($id, ['total_harga' => $total_harga]);

        return redirect()->to('/pembelian')->with('success', 'Pembelian berhasil diperbarui');
    }

    public function delete($id)
    {
        $model = new PembelianModel();
        $model->delete($id);

        // Hapus detail pembelian terkait
        $modelDetail = new DetailPembelianModel();
        $modelDetail->where('id_pembelian', $id)->delete();

        return redirect()->to('/pembelian')->with('success', 'Pembelian berhasil dihapus');
    }

    public function detail($id_pembelian)
    {
        $pembelianModel = new PembelianModel();
        $detailPembelianModel = new DetailPembelianModel();
        $pemasokModel = new PemasokModel();
        $produkModel = new ProdukModel();
    
        // Ambil data pembelian berdasarkan ID
        $pembelian = $pembelianModel->find($id_pembelian);
        if (!$pembelian) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Pembelian dengan ID $id_pembelian tidak ditemukan.");
        }
    
        // Ambil detail pembelian
        $detail_pembelian = $detailPembelianModel->where('id_pembelian', $id_pembelian)->findAll();
    
        // Ambil data pemasok
        $pemasok = $pemasokModel->find($pembelian['id_pemasok']);
    
        // Buat array untuk menyimpan informasi produk
        $produkArray = [];
        foreach ($detail_pembelian as $item) {
            $produk = $produkModel->find($item['id_produk']);
            if ($produk) {
                $produkArray[$item['id_produk']] = $produk;
            }
        }
    
        // Kirim data ke view
        $data = [
            'pembelian' => $pembelian,
            'detail_pembelian' => $detail_pembelian,
            'pemasok' => $pemasok,
            'produkArray' => $produkArray,
        ];
    
        return view('pembelian/detail', $data);
    }
        

}
