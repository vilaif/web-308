<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
use App\Models\TransactionItemModel;
use App\Models\ProductModel;

class TransactionController extends BaseController
{
    public function processCheckout()
    {
        $session = session();
        $cart    = $session->get('cart') ?? [];
        $userId  = $session->get('user_id');  // ambil dari session

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }
        if (! $userId) {
            return redirect()->to('/login')->with('error', 'Silakan login untuk checkout.');
        }

        // Ambil input dari form
        $recipientName = $this->request->getPost('recipient_name');
        $address       = $this->request->getPost('address');
        $contact       = $this->request->getPost('contact');

        // hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $file = $this->request->getFile('payment_proof');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/bukti_pembayaran', $fileName); // Simpan di folder public/uploads/bukti_pembayaran
        } else {
            return redirect()->back()
                ->with('error', 'Upload bukti pembayaran gagal: ' . $file->getErrorString());
        }

        $transactionData = [
            'user_id'         => $userId,
            'transaction_code'=> 'TXN' . time(),
            'recipient_name'  => $recipientName,
            'address'         => $address,
            'contact'         => $contact,
            'total_price'     => $total,
            'status'          => 'pending',
            'payment_proof'   => $fileName
        ];

        // Simpan ke transaction
        $transactionModel = new TransactionModel();
        $transactionModel->insert($transactionData);
        $transactionId = $transactionModel->insertID();

        // Simpan ke transaction_item
        $itemModel = new TransactionItemModel();
        foreach ($cart as $item) {
            $itemModel->insert([
                'transaction_id' => $transactionId,
                'product_id'     => $item['id'],
                'quantity'       => $item['quantity'],
                'price'          => $item['price']
            ]);
        }

        // Hapus item di cart
        $session->remove('cart');

        return redirect()->to('/thank-you')->with('success', 'Transaksi berhasil!');
    }

    public function showCheckout()
    {
        $session = session();
        $cart    = $session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Keranjang kosong.');
        }

        // Tampilkan form checkout—nanti user bisa input alamat, dsb.
        return view('checkout', [
            'cart'  => $cart,
            'title' => $this->titleData
        ]);
    }

    public function thankYou()
    {
        // Cek apakah ada pesan sukses di session
        if (!session()->getFlashdata('success')) {
            return redirect()->to('/'); // Jika tidak ada transaksi, kembali ke halaman utama
        }

        return view('thank_you', [
            'title' => $this->titleData
        ]);
    }

    public function myOrders()
    {
        $session = session();
        $userId = $session->get('user_id'); // pastikan user login

        if (! $userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $transactionModel = new \App\Models\TransactionModel();
        $transactions = $transactionModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('customer/my_order', [
            'transactions' => $transactions,
            'title' => $this->titleData
        ]);
    }

    public function orderDetail($id)
    {
        $userId = session()->get('user_id');

        $transactionModel = new \App\Models\TransactionModel();
        $transactionItemModel = new \App\Models\TransactionItemModel();

        // Ambil transaksi yang sesuai dengan ID dan user yang login
        $transaction = $transactionModel->where('id', $id)->where('user_id', $userId)->first();

        if (! $transaction) {
            return redirect()->to('/customer/my_order')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Ambil item dengan join ke tabel products agar dapat nama produk
        $items = $transactionItemModel->select('transaction_items.*, product.product_name AS product_name')
                                    ->join('product', 'product.id = transaction_items.product_id')
                                    ->where('transaction_id', $id)
                                    ->findAll();

        return view('customer/order_detail', [
            'transaction' => $transaction,
            'items'       => $items,
            'title' => $this->titleData
        ]);
    }

    public function invoice($id)
    {
        // Inisialisasi model
        $transactionModel = new \App\Models\TransactionModel();
        $detailModel = new \App\Models\TransactionItemModel();

        // Ambil data transaksi utama + username dari users
        $transactions = $transactionModel
            ->select('transactions.*, users.username')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->find($id);

        // Jika transaksi tidak ditemukan, tampilkan halaman 404
        if (!$transactions) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Transaksi tidak ditemukan');
        }

        // Ambil data detail transaksi yang sudah di-join dengan nama produk
        $detailProduct = $detailModel
            ->select('transaction_items.*, product.product_name')
            ->join('product', 'product.id = transaction_items.product_id', 'left')
            ->where('transaction_id', $id)
            ->findAll();

        // Kirim data ke view
        return view('customer/invoice', [
            'transactions'    => $transactions,
            'detail_product' => $detailProduct,
            'title'          => $this->titleData // Pastikan properti ini ada
        ]);

    }

    public function updateStatus($transactionId)
    {
        $transactionModel = new TransactionModel();
        $itemModel = new TransactionItemModel();
        $productModel = new ProductModel();

        // Misalnya request Post membawa status baru
        $newStatus = $this->request->getPost('status');

        // Update status transaksi
        $transactionModel->update($transactionId, ['status' => $newStatus]);

        // Cek jika status adalah "paid"
        if ($newStatus === 'paid') {
            // Ambil item-item yang ada di transaksi tersebut
            $items = $itemModel->where('transaction_id', $transactionId)->findAll();

            foreach ($items as $item) {
                // Ambil data produk terkait
                $product = $productModel->find($item['product_id']);

                // Hitung stok baru
                $newStock = $product['stock'] - $item['quantity'];

                // Update stok produk
                $productModel->update($item['product_id'], ['stock' => $newStock]);
            }
        }
        
        return redirect()->back()->with('success', 'Status updated.');
    }



}