<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function loginForm()
    {
        return view('auth/login'); // Bisa disesuaikan nanti tampilannya
    }

    public function login()
    {
        $input = $this->request->getPost('username'); // Bisa username atau email
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        // Cari user berdasarkan username atau email
        $user = $userModel
            ->where('username', $input)
            ->orWhere('email', $input)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'role'       => $user['role']
            ]);

            // Regenerate session ID
            session()->regenerate();

            // Redirect sesuai role
            if ($user['role'] === 'admin') {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/');
            }
        }

        return redirect()->to('/login')->with('error', 'Username/email atau password salah!');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function registerForm()
    {
        return view('auth/register');
    }

    public function register()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah digunakan. Pilih username lain.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'valid_email' => '{field} tidak valid.',
                    'is_unique' => '{field} sudah digunakan. Gunakan email lain.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 5 karakter.'
                ]
            ],
            'confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'matches' => '{field} tidak sama dengan Password.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/register')
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Jika valid, simpan ke database
        $userModel = new \App\Models\UserModel();
        $userModel->insert([
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => 'customer',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }


}