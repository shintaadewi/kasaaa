<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\PemasokModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();
        $pemasokModel = new PemasokModel();

        $data = [
            'totalProduk' => $produkModel->countAllResults(),
            'totalKategori' => $kategoriModel->countAllResults(),
            'totalPemasok' => $pemasokModel->countAllResults(),
        ];

        return view('dashboard', $data);
    }
}
