<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use CodeIgniter\Controller;

class DataAdmin extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $data['user'] = $userModel->first(); // Mengambil data pertama dari tabel user
        return view('admin/account/index', $data);
    }

    public function updateProfile()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $data = [];

        // Ambil data baru
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        // Validasi
        if (!empty($username)) {
            $data['username'] = $username;
        }

        if (!empty($password)) {
            if ($password !== $passwordConfirm) {
                return redirect()->back()->with('error', 'Password dan konfirmasi tidak cocok!');
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $data);

        return redirect()->to('/admin-profile')->with('success', 'Profil berhasil diperbarui!');
    }
}