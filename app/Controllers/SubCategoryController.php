<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;

class SubCategoryController extends BaseController
{
    public function index($categoryId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $subCategoryModel = new SubCategoryModel();
        $categoryModel = new CategoryModel();

        // Cek apakah kategori ada
        $category = $categoryModel->find($categoryId);
        if (!$category) {
            return redirect()->to('/categories')->with('error', 'Kategori tidak ditemukan.');
        }

        $data = [
            'parent' => $category,
            'subCategories' => $subCategoryModel->where('category_id', $categoryId)->findAll()
        ];

        return view('admin/categories/sub/index', $data);
    }

    public function store()
    {
        $subCategoryModel = new SubCategoryModel();

        // Validasi input
        if (!$this->validate([
            'category_id' => 'required|integer',
            'name' => 'required|min_length[3]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid.');
        }

        // Simpan data
        $subCategoryModel->insert([
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to('/sub-categories/' . $this->request->getPost('category_id'))->with('success', 'Sub-kategori berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $subCategoryModel = new SubCategoryModel();
        $categoryModel = new CategoryModel(); // Model untuk kategori utama

        $subCategory = $subCategoryModel->find($id);

        if (!$subCategory) {
            return redirect()->to('/categories')->with('error', 'Sub-kategori tidak ditemukan.');
        }

        if ($this->request->getMethod() === 'post') {
            $subCategoryModel->update($id, [
                'name' => $this->request->getPost('name'),
                'category_id' => $this->request->getPost('category_id')
            ]);

            return redirect()->to('/sub-categories/' . $this->request->getPost('category_id'))
                            ->with('success', 'Sub-kategori berhasil diperbarui.');
        }

        // Ambil kategori utama berdasarkan category_id
        $parent = $categoryModel->find($subCategory['category_id']);

        $data = [
            'subCategory' => $subCategory,
            'parent' => $parent
        ];

        return view('admin/categories/sub/edit', $data);
    }

    public function update($id)
    {
        $subCategoryModel = new SubCategoryModel();

        // Validasi input
        if (!$this->validate(['name' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('error', 'Nama sub-kategori tidak valid.');
        }

        // Cek apakah data ada sebelum update
        if (!$subCategoryModel->find($id)) {
            return redirect()->to('/sub-categories/' . $this->request->getPost('category_id'))->with('error', 'Sub-kategori tidak ditemukan.');
        }

        // Update data
        $subCategoryModel->update($id, [
            'name' => $this->request->getPost('name')
        ]);


        return redirect()->to('/sub-categories/' . $this->request->getPost('category_id'))->with('success', 'Sub-kategori berhasil diperbarui.');
        
    }

    public function delete($id)
    {
        $subCategoryModel = new SubCategoryModel();

        // Ambil data sub-kategori berdasarkan ID
        $subCategory = $subCategoryModel->find($id);

        // Cek apakah sub-kategori ada
        if (!$subCategory) {
            return redirect()->to('/categories')->with('error', 'Sub-kategori tidak ditemukan.');
        }

        // Hapus data
        $subCategoryModel->delete($id);

        // Redirect ke halaman sub-kategori
        return redirect()->to('/sub-categories/' . $subCategory['category_id'])->with('success', 'Sub-kategori berhasil dihapus.');
    }
}