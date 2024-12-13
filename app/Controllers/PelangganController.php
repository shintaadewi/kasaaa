<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class PelangganController extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        // Mengambil semua data pelanggan
        $data['pelanggan'] = $this->pelangganModel->findAll();
        return view('pelanggan/index', $data);
    }

    public function create()
    {
        return view('pelanggan/create');
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate([
            'nama_pelanggan' => 'required|min_length[3]',
            'kontak' => 'required',
            'alamat' => 'required'
        ])) {
            // Jika validasi gagal, kembalikan ke form dengan pesan kesalahan
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Menyimpan data pelanggan
        $this->pelangganModel->save([
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'kontak' => $this->request->getPost('kontak'),
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Mengambil data pelanggan berdasarkan ID
        $data['pelanggan'] = $this->pelangganModel->find($id);

        // Pastikan pelanggan ditemukan
        if (!$data['pelanggan']) {
            return redirect()->to('/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        return view('pelanggan/edit', $data);
    }

    public function update($id)
    {
        // Validasi input
        if (!$this->validate([
            'nama_pelanggan' => 'required|min_length[3]',
            'kontak' => 'required',
            'alamat' => 'required'
        ])) {
            // Jika validasi gagal, kembalikan ke form dengan pesan kesalahan
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Memperbarui data pelanggan
        $this->pelangganModel->update($id, [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'kontak' => $this->request->getPost('kontak'),
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Menghapus pelanggan berdasarkan ID
        $this->pelangganModel->delete($id);
        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
