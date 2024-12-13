<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function register()
    {
        return view('auth/register');
    }

    // Menyimpan data registrasi ke database
    public function storeRegister()
    {
        // Membuat instance UserModel untuk berinteraksi dengan database
        $userModel = new UserModel();

        // Ambil data dari form yang dikirimkan via POST
        $data = [
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'), // Tetapkan created_at secara manual
        ];

        // Simpan data ke database
        $userModel->save($data);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Proses autentikasi login
    public function authenticate()
    {
        // Membuat instance UserModel untuk berinteraksi dengan database
        $userModel = new UserModel();

        // Ambil data email dan password dari form yang dikirimkan via POST
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Mencari user berdasarkan email
        $user = $userModel->where('email', $email)->first();

        // Memeriksa apakah user ditemukan dan password valid
        if ($user && password_verify($password, $user['password'])) {
            // Jika login berhasil, simpan data user ke session
            session()->set('user', $user);

            // Redirect ke halaman dashboard
            return redirect()->to('/dashboard');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Invalid login credentials.');
    }

    // Proses logout
    public function logout()
    {
        // Hapus session user
        session()->destroy();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Logged out successfully.');
    }
}
