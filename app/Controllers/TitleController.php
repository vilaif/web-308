<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TitleModel;
use CodeIgniter\Controller;

class TitleController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $titleModel = new TitleModel();
        $data['title'] = $titleModel->first(); // Mengambil data pertama dari tabel title
        return view('admin/title/index', $data);
    }

    public function store()
    {
        $titleModel = new TitleModel();

        // Upload Gambar Pertama (image)
        $imageFile = $this->request->getFile('image');
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('uploads/logo/', $imageName); // Simpan gambar ke folder uploads/logo
        } else {
            $imageName = null;
        }

        // Upload Gambar Kedua (image2)
        $imageFile2 = $this->request->getFile('image2');
        if ($imageFile2->isValid() && !$imageFile2->hasMoved()) {
            $imageName2 = $imageFile2->getRandomName();
            $imageFile2->move('uploads/logo/', $imageName2); // Simpan gambar kedua
        } else {
            $imageName2 = null;
        }

        // Simpan ke database
        $titleModel->insert([
            'title' => $this->request->getPost('title'),
            'image' => $imageName,
            'image2' => $imageName2 // Tambahkan image2 ke database
        ]);

        return redirect()->to('/admin/title')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $titleModel = new TitleModel();
        $data['title'] = $titleModel->find($id);
        return view('admin/title/edit', $data);
    }

    public function update($id)
    {
        $titleModel = new TitleModel();
        $titleData = $titleModel->find($id);

        // Upload gambar utama
        $imageFile = $this->request->getFile('image');
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            // Hapus gambar lama jika ada
            if (!empty($titleData['image']) && file_exists('uploads/logo/' . $titleData['image'])) {
                unlink('uploads/logo/' . $titleData['image']);
            }

            $imageName = $imageFile->getRandomName();
            $imageFile->move('uploads/logo', $imageName);
        } else {
            $imageName = $titleData['image']; // Gunakan gambar lama jika tidak ada yang baru
        }

        // Proses upload untuk image2 (Second Logo)
        $imageFile2 = $this->request->getFile('image2');
        if ($imageFile2->isValid() && !$imageFile2->hasMoved()) {
            if (!empty($titleData['image2']) && file_exists('uploads/logo/' . $titleData['image2'])) {
                unlink('uploads/logo/' . $titleData['image2']);
            }
            $imageName2 = $imageFile2->getRandomName();
            $imageFile2->move('uploads/logo/', $imageName2);
        } else {
            $imageName2 = $titleData['image2']; // Gunakan gambar lama jika tidak ada yang baru
        }

        $titleModel->update($id, [
            'title' => $this->request->getPost('title'),
            'image' => $imageName,
            'image2' => $imageName2
        ]);

        return redirect()->to('/title')->with('success', 'Data berhasil diperbarui!');
    }

}