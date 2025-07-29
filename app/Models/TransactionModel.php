<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'transaction_code', 'recipient_name', 'address', 'contact', 'payment_proof',
    'total_price', 'status'];
    protected $useTimestamps = true;

    public function getItemsByTransactionId($transactionId)
    {
        return $this->select('transaction_items.*, products.name AS product_name')
                    ->join('products', 'products.id = transaction_items.product_id')
                    ->where('transaction_id', $transactionId)
                    ->findAll();
    }

    // helper untuk join dengan user
    public function getWithUser(int $id)
    {
        return $this
            ->select('transactions.*, users.email, users.username')
            ->join('users','users.id = transactions.user_id')
            ->where('transactions.id',$id)
            ->first();
    }

    public function getTransactions($startDate, $endDate)
    {
        return $this->where('DATE(created_at) >=', $startDate)
                    ->where('DATE(created_at) <=', $endDate)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }
}