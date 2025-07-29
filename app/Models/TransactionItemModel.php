<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionItemModel extends Model
{
    protected $table = 'transaction_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['transaction_id', 'product_id', 'quantity', 'price'];
    protected $useTimestamps = true;
}