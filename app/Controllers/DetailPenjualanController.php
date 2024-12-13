<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\PelangganModel;
use App\Models\DetailPenjualanModel; // Menggunakan DetailPenjualanModel
use App\Models\ProdukModel;

class PenjualanController extends BaseController
{
    protected $penjualanModel;
    protected $pelangganModel;
    protected $detailPenjualanModel; // Ganti ItemPenjualanModel dengan DetailPenjualanModel
    protected $produkModel;

    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
        $this->pelangganModel = new PelangganModel();
        $this->detailPenjualanModel = new DetailPenjualanModel(); // Menggunakan DetailPenjualanModel
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $penjualan = $this->penjualanModel->findAll();

        foreach ($penjualan as &$p) {
            $pelanggan = $this->pelangganModel->find($p['id_pelanggan']);
            $p['nama_pelanggan'] = $pelanggan ? $pelanggan['nama'] : 'Tidak Diketahui';

            // Ambil detail penjualan untuk ditampilkan
            $detailPenjualans = $this->detailPenjualanModel->where('penjualan_id', $p['id'])->findAll();
            foreach ($detailPenjualans as &$detail) {
                $produk = $this->produkModel->find($detail['produk_id']); // Ganti dari obat_id menjadi produk_id
                $detail['nama_produk'] = $produk ? $produk['nama_produk'] : 'Tidak Diketahui';
            }
            $p['detail_penjualan'] = $detailPenjualans; // Ganti dari item_penjualan menjadi detail_penjualan
        }

        return view('penjualan/index', ['penjualan' => $penjualan]);
    }

    public function create()
    {
        $data['pelanggan'] = $this->pelangganModel->findAll();
        $data['produk'] = $this->produkModel->findAll();
        return view('penjualan/create', $data);
    }

    public function store()
    {
        $model = new PenjualanModel();
        $produkData = $this->request->getPost('produk');

        $total_harga = 0;

        foreach ($produkData as $item) {
            $harga = (float)$item['harga'];
            $jumlah = (int)$item['jumlah'];
            $total_harga += $harga * $jumlah;
        }

        $penjualanData = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tanggal_penjualan' => date('Y-m-d H:i:s'),
            'total_harga' => $total_harga
        ];

        $model->save($penjualanData);

        // Simpan detail penjualan di tabel detail_penjualan
        $detailModel = new DetailPenjualanModel(); // Menggunakan DetailPenjualanModel
        $penjualanID = $model->insertID();
        foreach ($produkData as $item) {
            $detailModel->save([
                'penjualan_id' => $penjualanID,
                'produk_id' => $item['id'], // Ganti dari obat_id menjadi produk_id
                'jumlah' => (int)$item['jumlah'],
                'harga' => (float)$item['harga']
            ]);

            // Update stok produk
            $produk = $this->produkModel->find($item['id']);
            $this->produkModel->update($item['id'], [
                'stok' => $produk['stok'] - (int)$item['jumlah']
            ]);
        }

        return redirect()->to('/penjualan');
    }

    public function edit($id)
    {
        $model = new PenjualanModel();
        $data['penjualan'] = $model->find($id);

        // Ambil data pelanggan dan produk untuk ditampilkan di dropdown
        $pelangganModel = new PelangganModel();
        $produkModel = new ProdukModel();
        $data['pelanggan'] = $pelangganModel->findAll();
        $data['produk'] = $produkModel->findAll();

        // Ambil detail penjualan untuk ditampilkan di form edit
        $detailModel = new DetailPenjualanModel(); // Menggunakan DetailPenjualanModel
        $data['detail_penjualan'] = $detailModel->where('penjualan_id', $id)->findAll(); // Ganti dari item_penjualan menjadi detail_penjualan

        return view('penjualan/edit', $data);
    }

    public function update($id)
    {
        $model = new PenjualanModel();
        $produkData = $this->request->getPost('produk');

        // Hapus detail penjualan yang lama dan update stok
        $detailModel = new DetailPenjualanModel(); // Menggunakan DetailPenjualanModel
        $oldDetails = $detailModel->where('penjualan_id', $id)->findAll();

        foreach ($oldDetails as $oldDetail) {
            // Kembalikan stok produk yang sudah terjual
            $produk = $this->produkModel->find($oldDetail['produk_id']);
            $this->produkModel->update($oldDetail['produk_id'], [
                'stok' => $produk['stok'] + $oldDetail['jumlah']
            ]);
        }

        $total_harga = 0;

        foreach ($produkData as $item) {
            $harga = (float)$item['harga'];
            $jumlah = (int)$item['jumlah'];
            $total_harga += $harga * $jumlah;
        }

        $penjualanData = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tanggal_penjualan' => date('Y-m-d H:i:s'),
            'total_harga' => $total_harga
        ];

        $model->update($id, $penjualanData);

        // Simpan detail penjualan di tabel detail_penjualan
        $detailModel->where('penjualan_id', $id)->delete(); // Hapus detail penjualan yang lama

        foreach ($produkData as $item) {
            $detailModel->save([
                'penjualan_id' => $id,
                'produk_id' => $item['id'], // Ganti dari obat_id menjadi produk_id
                'jumlah' => (int)$item['jumlah'],
                'harga' => (float)$item['harga']
            ]);

            // Update stok produk
            $produk = $this->produkModel->find($item['id']);
            $this->produkModel->update($item['id'], [
                'stok' => $produk['stok'] - (int)$item['jumlah']
            ]);
        }

        return redirect()->to('/penjualan');
    }

    public function delete($id)
    {
        // Hapus detail penjualan terkait
        $this->detailPenjualanModel->where('penjualan_id', $id)->delete(); // Menggunakan DetailPenjualanModel
        // Hapus penjualan
        $this->penjualanModel->delete($id);
        return redirect()->to('/penjualan');
    }

    public function detail($id)
    {
        $penjualan = $this->penjualanModel->find($id);

        // Ambil nama pelanggan
        $pelanggan = $this->pelangganModel->find($penjualan['id_pelanggan']);
        $penjualan['nama_pelanggan'] = $pelanggan ? $pelanggan['nama'] : 'Tidak Diketahui';

        // Ambil detail penjualan
        $detailPenjualans = $this->detailPenjualanModel->where('penjualan_id', $id)->findAll(); // Ganti dari item_penjualan menjadi detail_penjualan
        foreach ($detailPenjualans as &$detail) {
            $produk = $this->produkModel->find($detail['produk_id']);
            $detail['nama_produk'] = $produk ? $produk['nama_produk'] : 'Tidak Diketahui';
        }

        $penjualan['detail_penjualan'] = $detailPenjualans;

        return view('penjualan/detail', ['penjualan' => $penjualan]);
    }
}
