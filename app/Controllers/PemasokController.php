<?php

namespace App\Controllers;

use App\Models\PemasokModel;

class PemasokController extends BaseController
{
    protected $pemasokModel;

    public function __construct()
    {
        $this->pemasokModel = new PemasokModel();
    }

    public function index()
    {
        $data['pemasok'] = $this->pemasokModel->findAll();
        return view('pemasok/index', $data);
    }

    public function create()
    {
        return view('pemasok/create');
    }

    public function store()
    {
        $this->pemasokModel->save([
            'nama_pemasok' => $this->request->getPost('nama_pemasok'),
            'kontak' => $this->request->getPost('kontak'),
            'alamat' => $this->request->getPost('alamat')
        ]);
        return redirect()->to('/pemasok');
    }

    public function edit($id)
    {
        $data['pemasok'] = $this->pemasokModel->find($id);
        return view('pemasok/edit', $data);
    }

    public function update($id)
    {
        $this->pemasokModel->update($id, [
            'nama_pemasok' => $this->request->getPost('nama_pemasok'),
            'kontak' => $this->request->getPost('kontak'),
            'alamat' => $this->request->getPost('alamat')
        ]);
        return redirect()->to('/pemasok');
    }

    public function delete($id)
    {
        $this->pemasokModel->delete($id);
        return redirect()->to('/pemasok');
    }
}
