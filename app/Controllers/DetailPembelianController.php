<?php

namespace App\Controllers;

use App\Models\DetailPembelianModel;

class DetailPembelianController extends BaseController
{
    protected $detailPembelianModel;

    public function __construct()
    {
        $this->detailPembelianModel = new DetailPembelianModel();
    }

    public function index($idPembelian)
    {
        $data['detailPembelian'] = $this->detailPembelianModel->getDetailPembelian($idPembelian);
        return view('detail_pembelian/index', $data);
    }

    public function create($idPembelian)
    {
        return view('detail_pembelian/create', ['id_pembelian' => $idPembelian]);
    }

    public function store()
    {
        $this->detailPembelianModel->save([
            'id_pembelian' => $this->request->getPost('id_pembelian'),
            'id_produk' => $this->request->getPost('id_produk'),
            'kuantitas' => $this->request->getPost('kuantitas')
        ]);

        return redirect()->to('/pembelian');
    }

    public function edit($id)
    {
        $data['detail'] = $this->detailPembelianModel->find($id);
        return view('detail_pembelian/edit', $data);
    }

    public function update($id)
    {
        $this->detailPembelianModel->update($id, [
            'id_produk' => $this->request->getPost('id_produk'),
            'kuantitas' => $this->request->getPost('kuantitas')
        ]);

        return redirect()->to('/pembelian');
    }

    public function delete($id)
    {
        $this->detailPembelianModel->delete($id);
        return redirect()->to('/pembelian');
    }
}
