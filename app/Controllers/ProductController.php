<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductImageModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class ProductController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        
        $model = new ProductModel();
        $search = $this->request->getGet('search');

        // Query dengan join ke kategori dan sub-kategori
        $query = $model->select('product.*, categories.category_name, sub_categories.name')
            ->join('categories', 'categories.id = product.category_id', 'left')
            ->join('sub_categories', 'sub_categories.id = product.sub_category_id', 'left')
            ->orderBy('created_at', 'DESC');

        // Jika ada pencarian, lakukan filter
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('product.product_name', $search)
                ->orLike('categories.category_name', $search)
                ->orLike('sub_categories.name', $search)
                ->groupEnd();
        }

        // Ambil data dengan pagination
        $data['product'] = $model->paginate(5, 'product_group');
        $data['pager'] = $model->pager;
        $data['currentPage'] = $model->pager->getCurrentPage('product_group');


        // Debugging
        if (empty($data['product'])) {
            dd('No products found', $data['product']);
        }

        return view('admin/products/index', $data);
    }



    public function getSubCategories()
    {
        // if ($this->request->isAJAX()) {
        //     $category_id = $this->request->getGet('category_id');
    
        //     $subCategoryModel = new SubCategoryModel();
        //     $subCategories = $subCategoryModel->where('category_id', $category_id)->findAll();
    
        //     return $this->response->setJSON($subCategories);
        // } else {
        //     return $this->response->setJSON(['error' => 'Invalid request']);
        // }
        if ($this->request->isAJAX()) {
            $category_id = $this->request->getGet('category_id');
    
            log_message('debug', 'Category ID received: ' . $category_id);
    
            if (!$category_id) {
                return $this->response->setJSON(['error' => 'Category ID is missing']);
            }
    
            $subCategoryModel = new SubCategoryModel();
            $subCategories = $subCategoryModel->where('category_id', $category_id)->findAll();
    
            if (empty($subCategories)) {
                return $this->response->setJSON(['error' => 'No sub categories found']);
            }
    
            return $this->response->setJSON($subCategories);
        } else {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $subCategoryModel = new SubCategoryModel();
        
        $data['categories'] = $categoryModel->findAll();
        $data['sub_categories'] = $subCategoryModel->findAll();

        return view('admin/products/add', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validationRules = [
            'category_id'   => 'required|integer',
            'sub_category_id' => 'required|integer',
            'product_name'  => 'required|max_length[255]',
            'stok'          => 'required|integer',
            'price'         => 'required|numeric',
            'description'   => 'permit_empty',
            'image'         => 'uploaded[image]|is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif,image/webp,image/bmp]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/products/', $imageName);
        }

        $productModel = new ProductModel();
        $productModel->insert([
            'category_id'   => $this->request->getPost('category_id'),
            'sub_category_id' => $this->request->getPost('sub_category_id'),
            'product_name'  => $this->request->getPost('product_name'),
            'stok'          => $this->request->getPost('stok'),
            'price'         => $this->request->getPost('price'),
            'description'   => $this->request->getPost('description'),
            'image'         => $imageName
        ]);

        return redirect()->to('/d_products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new ProductModel();
        $categoryModel = new CategoryModel();
        $subCategoryModel = new SubCategoryModel();

        $product = $model->find($id);
        $categories = $categoryModel->findAll();
        $sub_categories = $subCategoryModel->findAll();

        // Menentukan sub kategori yang dipilih
        $selected_sub_category = $product['sub_category_id'] ?? '';

        $data = [
            'product' => $product,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'selected_sub_category' => $selected_sub_category, // Kirim ke view
        ];

        return view('admin/products/edit', $data);
    }

    public function update($id)
    {
        // dd($this->request->getPost(), $this->request->getFile('image'));
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        $data = [
            'product_name'   => $this->request->getPost('product_name'),
            'stok'   => $this->request->getPost('stok'),
            'category_id'    => $this->request->getPost('category_id'),
            'sub_category_id' => $this->request->getPost('sub_category_id'),
            'price'          => $this->request->getPost('price'),
            'description'    => $this->request->getPost('description'),
        ];

        // Handle file upload
        $file = $this->request->getFile('image'); 

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/products/', $newName); // Pastikan 'uploads/products' bisa ditulis

            // Hapus gambar lama jika ada
            if (!empty($product['image'])) {
                $oldImagePath = 'uploads/products/' . $product['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Update data dengan gambar baru
            $data['image'] = $newName;
        }

        $productModel->update($id, $data);

        return redirect()->to('/d_products')->with('success', 'Produk berhasil diperbarui');
    }


    public function delete($id)
    {
        $productModel = new \App\Models\ProductModel(); // Sesuaikan dengan model yang digunakan

        // Ambil data produk berdasarkan ID
        $product = $productModel->find($id);
        
        if ($product) {
            // Hapus file gambar jika ada
            if (!empty($product['image']) && file_exists('uploads/' . $product['image'])) {
                unlink('uploads/' . $product['image']);
            }

            // Hapus produk dari database
            $productModel->delete($id);
            
            return redirect()->to(base_url('d_products'))->with('success', 'Produk berhasil dihapus!');
        }

        return redirect()->to(base_url('d_products'))->with('error', 'Produk tidak ditemukan!');
    }





}