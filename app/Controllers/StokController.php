<?php

namespace App\Controllers;

use App\Models\StokModel;
use App\Models\ProdukModel;

class StokController extends BaseController
{
    protected $stokModel;
    protected $produkModel;

    public function __construct()
    {
        $this->stokModel = new StokModel();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data['stok'] = $this->stokModel->getStokWithProduk();
        return view('stok/index', $data);
    }

    public function create()
    {
        $data['produk'] = $this->produkModel->findAll();
        return view('stok/create', $data);
    }

    public function store()
    {
        $this->stokModel->save([
            'id_produk' => $this->request->getPost('id_produk'),
            'stok_masuk' => $this->request->getPost('stok_masuk'),
            'stok_keluar' => $this->request->getPost('stok_keluar'),
            'tanggal' => $this->request->getPost('tanggal')
        ]);
        return redirect()->to('/stok');
    }

    public function edit($id)
    {
        $data['stok'] = $this->stokModel->find($id);
        $data['produk'] = $this->produkModel->findAll();
        return view('stok/edit', $data);
    }

    public function update($id)
    {
        $this->stokModel->update($id, [
            'id_produk' => $this->request->getPost('id_produk'),
            'stok_masuk' => $this->request->getPost('stok_masuk'),
            'stok_keluar' => $this->request->getPost('stok_keluar'),
            'tanggal' => $this->request->getPost('tanggal')
        ]);
        return redirect()->to('/stok');
    }

    public function delete($id)
    {
        $this->stokModel->delete($id);
        return redirect()->to('/stok');
    }
}
