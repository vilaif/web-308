<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_name'];

    protected $useTimestamps = true;

    // Ambil semua kategori utama
    public function getAllCategories()
    {
        return $this->findAll();
    }
}