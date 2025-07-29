<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CategoryController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $categoryModel = new CategoryModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $categoryModel->like('category_name', $search);
        }

        $categories = $categoryModel->findAll(); // Ambil semua kategori utama
        return view('admin/categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin/categories/add');
    }

    public function store()
    {
        $categoryModel = new CategoryModel();

        $data = [
            'category_name' => $this->request->getPost('category_name'),
        ];

        $categoryModel->insert($data);
        return redirect()->to('/categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        if (!$category) {
            return redirect()->to('/categories')->with('error', 'Kategori tidak ditemukan.');
        }

        return view('admin/categories/edit', ['category' => $category]);
    }

    public function update($id)
    {
        $categoryModel = new CategoryModel();
        $data = [
            'category_name' => $this->request->getPost('category_name'),
        ];

        $categoryModel->update($id, $data);
        return redirect()->to('/categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);

        return redirect()->to('/categories')->with('success', 'Kategori berhasil dihapus.');
    }



}