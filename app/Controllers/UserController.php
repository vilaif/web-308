<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function profile()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('customer/profile', [
            'user' => $user,
            'title' => $this->titleData
        ]);
        
    }

    public function updateProfile()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $data = [];

        // Ambil data baru
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        // Validasi username
        if (!empty($username)) {
            $data['username'] = $username;
        }

        // Validasi email
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('error', 'Format email tidak valid!');
            }

            // Cek apakah email sudah digunakan oleh user lain
            $existingUser = $userModel
                ->where('email', $email)
                ->where('id !=', $userId)
                ->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'Email sudah digunakan oleh pengguna lain!');
            }

            $data['email'] = $email;
        } else {
            return redirect()->back()->with('error', 'Email wajib diisi!');
        }

        // Validasi password (jika diisi)
        if (!empty($password)) {
            if ($password !== $passwordConfirm) {
                return redirect()->back()->with('error', 'Password dan konfirmasi tidak cocok!');
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Update data jika ada yang diubah
        if (!empty($data)) {
            $userModel->update($userId, $data);
        }

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}