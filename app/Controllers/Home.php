<?php

namespace App\Controllers;
use App\Models\TitleModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Home extends BaseController
{

    public function __construct()
    {
        $titleModel = new TitleModel();
        $this->titleData = $titleModel->first(); // Ambil satu data dari tabel title
    }
    
    public function index() {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        $productModel = new ProductModel();
        $products = $productModel
            ->orderBy('created_at', 'DESC')
            ->findAll();
        
        return view('home', [
            'categories' => $categories,
            'products' => $products,
            'title' => $this->titleData
        ]);
    }

    public function products() {
        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel();
        $subcategoryModel = new \App\Models\SubCategoryModel();

        $categoryId = $this->request->getGet('category');
        $subcategoryId = $this->request->getGet('subcategory');

        // Query dasar dengan join
        $productModel = $productModel
            ->select('product.*, categories.category_name, sub_categories.name as sub_category_name')
            ->join('categories', 'categories.id = product.category_id', 'left')
            ->join('sub_categories', 'sub_categories.id = product.sub_category_id', 'left')
            ->where('stok >', 5)
            ->orderBy('created_at', 'DESC');

        // Filter berdasarkan subkategori atau kategori jika ada
        if ($subcategoryId) {
            $productModel->where('product.sub_category_id', $subcategoryId);
        } elseif ($categoryId) {
            $productModel->where('product.category_id', $categoryId);
        }

        // Gunakan paginate() untuk pagination
        $data['products'] = $productModel->groupBy('product.id')->paginate(6, 'products'); // 8 item per halaman
        $data['pager'] = $productModel->pager;

        // Ambil semua kategori
        $data['categories'] = $categoryModel->findAll();

        // Ambil dan kelompokkan subkategori
        $subcategories = $subcategoryModel->findAll();
        $groupedSubcategories = [];
        foreach ($subcategories as $sub) {
            $groupedSubcategories[$sub['category_id']][] = $sub;
        }
        $data['subcategories'] = $groupedSubcategories;

        return view('products', [
            'title' => $this->titleData,
            'products' => $data['products'],
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'pager' => $data['pager']
        ]);
    }

    public function filterByCategory($categoryId)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $data['products'] = $productModel->where('category_id', $categoryId)->findAll();
        $data['categories'] = $categoryModel->findAll(); // tetap tampilkan semua kategori

        return view('product', [
            'title' => $this->titleData,
            'products' => $data['products'],
            'categories' => $data['categories'],
            'pager' => $data['pager'] ?? null
        ]); // ganti dengan nama view kamu
    }

    public function productByCategory($id)
    {
        $productModel = new \App\Models\ProductModel(); // ganti jika modelmu berbeda
        $categoryModel = new CategoryModel();

        $products = $productModel->where('category_id', $id)->findAll();
        $categories = $categoryModel->findAll();

        return view('products', [
            'title' => $this->titleData,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function single_product($id)
    {
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($id);
    
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Produk dengan ID $id tidak ditemukan.");
        }
    
        return view('single_product', [
            'title' => $this->titleData,
            'product' => $product
        ]);
    }

    public function contact() {
        return view('contact', ['title' => $this->titleData]);
    }

    public function about() {
        return view('about', ['title' => $this->titleData]);
    }
}