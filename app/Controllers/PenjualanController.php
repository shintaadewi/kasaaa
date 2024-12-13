<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\PelangganModel;
use App\Models\ProdukModel;
use App\Models\DetailPenjualanModel;

class PenjualanController extends BaseController
{
    protected $penjualanModel;
    protected $pelangganModel;
    protected $produkModel;
    protected $detailPenjualanModel;

    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
        $this->pelangganModel = new PelangganModel();
        $this->produkModel = new ProdukModel();
        $this->detailPenjualanModel = new DetailPenjualanModel();
    }

    public function index()
    {
        $data['penjualan'] = $this->penjualanModel->getPenjualanWithPelanggan();
        return view('penjualan/index', $data);
    }

    public function create()
    {
        $data = [
            'produk' => $this->produkModel->findAll(),
            'pelanggan' => $this->pelangganModel->findAll()
        ];
        return view('penjualan/create', $data);
    }

    public function store()
    {
        $id_pelanggan = $this->request->getPost('id_pelanggan');
        $produk = $this->request->getPost('produk');

        if (!$id_pelanggan || empty($produk)) {
            return redirect()->back()->with('error', 'Data pelanggan atau produk tidak boleh kosong.');
        }

        $total_harga = 0;
        foreach ($produk as $item) {
            if (isset($item['jumlah'], $item['harga_satuan'])) {
                $total_harga += $item['jumlah'] * $item['harga_satuan'];
            }
        }

        $dataPenjualan = [
            'id_pelanggan' => $id_pelanggan,
            'total_harga' => $total_harga,
            'tanggal_penjualan' => date('Y-m-d H:i:s')
        ];

        $this->penjualanModel->insert($dataPenjualan);
        $id_penjualan = $this->penjualanModel->insertID();

        foreach ($produk as $item) {
            if (isset($item['id'], $item['jumlah'], $item['harga_satuan'])) {
                $dataDetail = [
                    'id_penjualan' => $id_penjualan,
                    'id_produk' => $item['id'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan']
                ];
                $this->detailPenjualanModel->insert($dataDetail);
            }
        }

        return redirect()->to('/penjualan')->with('success', 'Penjualan berhasil disimpan.');
    }

    public function edit($id_penjualan)
{
    $penjualanModel = new PenjualanModel();
    $penjualan = $penjualanModel->find($id_penjualan);

    // Ambil data pelanggan untuk dropdown
    $pelangganModel = new PelangganModel();
    $pelanggan = $pelangganModel->findAll();

    // Ambil data produk untuk dropdown
    $produkModel = new ProdukModel();
    $produk = $produkModel->findAll();

    // Ambil detail produk yang terkait dengan penjualan ini
    $penjualanProduk = $penjualanModel->getPenjualanProduk($id_penjualan);

    // Pastikan data produk terhubung dengan id_produk
    foreach ($penjualanProduk as &$item) {
        // Mengambil harga produk untuk setiap item, jika belum ada
        $produkDetail = $produkModel->find($item['id_produk']);
        $item['harga_satuan'] = $produkDetail['harga'] ?? 0; // Set default harga jika tidak ada
        // Menambahkan pengecekan jika id_produk tidak ada
        if (!isset($item['id_produk'])) {
            $item['id_produk'] = null; // Jika id_produk hilang, berikan null atau tangani sesuai kebutuhan
        }
    }

    return view('penjualan/edit', [
        'penjualan' => $penjualan,
        'pelanggan' => $pelanggan,
        'produk' => $produk,
        'penjualan_produk' => $penjualanProduk
    ]);
}




    public function update($id)
    {
        $penjualan = $this->penjualanModel->find($id);
        if (!$penjualan) {
            return redirect()->to('/penjualan')->with('error', 'Data penjualan tidak ditemukan.');
        }

        $id_pelanggan = $this->request->getPost('id_pelanggan');
        $produk = $this->request->getPost('produk');

        if (!$id_pelanggan || empty($produk)) {
            return redirect()->back()->with('error', 'Data pelanggan atau produk tidak boleh kosong.');
        }

        $total_harga = 0;
        foreach ($produk as $item) {
            if (isset($item['jumlah'], $item['harga_satuan'])) {
                $total_harga += $item['jumlah'] * $item['harga_satuan'];
            }
        }

        $dataPenjualan = [
            'id_pelanggan' => $id_pelanggan,
            'total_harga' => $total_harga,
            'tanggal_penjualan' => date('Y-m-d H:i:s')
        ];
        $this->penjualanModel->update($id, $dataPenjualan);

        // Hapus detail lama dan tambahkan yang baru
        $this->detailPenjualanModel->where('id_penjualan', $id)->delete();

        foreach ($produk as $item) {
            if (isset($item['id'], $item['jumlah'], $item['harga_satuan'])) {
                $dataDetail = [
                    'id_penjualan' => $id,
                    'id_produk' => $item['id'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan']
                ];
                $this->detailPenjualanModel->insert($dataDetail);
            }
        }

        return redirect()->to('/penjualan')->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $penjualan = $this->penjualanModel->find($id);
        if (!$penjualan) {
            return redirect()->to('/penjualan')->with('error', 'Data penjualan tidak ditemukan.');
        }

        $this->detailPenjualanModel->where('id_penjualan', $id)->delete();
        $this->penjualanModel->delete($id);

        return redirect()->to('/penjualan')->with('success', 'Penjualan berhasil dihapus.');
    }

    public function detail($id)
    {
        $penjualan = $this->penjualanModel->find($id);
        if (!$penjualan) {
            return redirect()->to('/penjualan')->with('error', 'Data penjualan tidak ditemukan.');
        }

        $detail_penjualan = $this->detailPenjualanModel->where('id_penjualan', $id)->findAll();
        $produkList = $this->produkModel->findAll();
        $produkArray = [];
        foreach ($produkList as $p) {
            $produkArray[$p['id_produk']] = $p;
        }

        $pelanggan = $this->pelangganModel->find($penjualan['id_pelanggan']);

        return view('penjualan/detail', [
            'penjualan' => $penjualan,
            'detail_penjualan' => $detail_penjualan,
            'produkArray' => $produkArray,
            'pelanggan' => $pelanggan
        ]);
    }
}
