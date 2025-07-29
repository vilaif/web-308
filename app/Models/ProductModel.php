<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_id', 'sub_category_id', 'product_name', 'stok', 'price', 'description', 'image'];

    public function getProduct()
    {
        return $this->select('product.*, sub_categories.name, categories.category_name')
            ->join('sub_categories', 'sub_categories.id = product.sub_category_id', 'left')
            ->join('categories', 'categories.id = product.category_id', 'left')
            ->findAll();
    }
    public function getProductsWithCategory()
    {
        return $this->db->table('product')
            ->select('product.id, product.product_name, product.price, product.image, categories.category_name as category_name')
            ->join('categories', 'categories.id = product.category_id')
            ->groupBy('product.id')
            ->get()
            ->getResult();
    }

    protected $useTimestamps = true;


}