<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\CategoryModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $transactionModel = new TransactionModel();
        $productModel = new ProductModel();
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();

        // Total pemasukan (hanya status 'paid')
        $transactions = $transactionModel->where('status', 'paid')->findAll();
        $totalPemasukan = array_sum(array_column($transactions, 'total_price'));

        // Total transaksi
        $totalTransaksi = $transactionModel->countAll();

        // Total kateogri
        $totalCategory = $categoryModel->countAll();

        // Total produk
        $totalProducts = $productModel->countAll();

        // Transaksi terbaru (misal 5 terakhir)
        $latestTransactions = $transactionModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

        $lowStockProducts = $productModel
            ->where('stok <', 5)
            ->paginate(3, 'lowstock'); // 5 item per halaman, 'lowstock' adalah nama grup

        $pager = $productModel->pager;

        $data = [
            'total_pemasukan' => $totalPemasukan,
            'total_transaksi' => $totalTransaksi,
            'total_category' => $totalCategory,
            'total_products' => $totalProducts,
            'latest_transactions' => $latestTransactions,
            'low_stock_products' => $lowStockProducts,
            'pager' => $pager,
            'title' => 'Dashboard'
        ];

        $header['title']='Dashboard';
        return view('admin/dashboard', $data);
        // echo view('partial/header',$header);
        // echo view('partial/top_menu');
        // echo view('partial/side_menu');
        // echo view('dashboard');
        // echo view('partial/footer');
    }
}