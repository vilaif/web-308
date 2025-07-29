<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
use App\Models\TransactionItemModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;

class DataTransaction extends BaseController
{
    

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $transactionModel = new \App\Models\TransactionModel();

        // Ambil keyword dari input GET
        $search = $this->request->getGet('search');

        // Buat base query builder
        $builder = $transactionModel
            ->select('transactions.*, users.username, users.email')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->orderBy('transactions.created_at', 'DESC');

        // Jika ada pencarian, tambahkan filter pencarian
        if (!empty($search)) {
            $builder->groupStart()
                ->like('transactions.transaction_code', $search)
                ->orLike('transactions.recipient_name', $search)
                ->orLike('transactions.status', $search)
                ->orLike('users.username', $search)
                ->orLike('users.email', $search)
                ->groupEnd();
        }

        // Jalankan pagination SETELAH builder selesai disusun
        $data['transactions'] = $builder->paginate(5, 'transactions');
        $data['pager'] = $transactionModel->pager;
        $data['search'] = $search; // untuk tetap menampilkan keyword di view

        return view('admin/transaction/index', $data);

    }

    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $transactionModel = new \App\Models\TransactionModel();
        $itemModel = new \App\Models\TransactionItemModel();
        $productModel = new \App\Models\ProductModel();

        // Ambil data transaksi
        $transaction = $transactionModel->find($id);

        if (!$transaction) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi dengan ID $id tidak ditemukan.");
        }

        // Ambil item dalam transaksi tersebut beserta nama produk dan harga
        $items = $itemModel
            ->select('transaction_items.*, product.product_name, product.price')
            ->join('product', 'product.id = transaction_items.product_id')
            ->where('transaction_items.transaction_id', $id)
            ->findAll();

        return view('admin/transaction/edit', [
            'transaction' => $transaction,
            'items' => $items // kirim ke view untuk ditampilkan
        ]);
    }

    public function update($id)
    {
        $transactionModel = new \App\Models\TransactionModel();
        $itemModel = new \App\Models\TransactionItemModel();
        $productModel = new \App\Models\ProductModel();

        // Ambil status baru dari form
        $newStatus = $this->request->getPost('status');

        // Ambil transaksi lama
        $transaction = $transactionModel->find($id);
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $previousStatus = $transaction['status'];

        // Jika status berubah menjadi "paid", kurangi stok produk
        if ($previousStatus !== 'paid' && $newStatus === 'paid') {
            $items = $itemModel->where('transaction_id', $id)->findAll();

            foreach ($items as $item) {
                $product = $productModel->find($item['product_id']);
                if (!$product) {
                    return redirect()->back()->with('error', 'Produk tidak ditemukan untuk ID: ' . $item['product_id']);
                }

                $newStock = $product['stok'] - $item['quantity'];
                if ($newStock < 0) {
                    return redirect()->back()->with('error', 'Stok tidak cukup untuk produk: ' . $product['name']);
                }

                $productModel->update($item['product_id'], ['stok' => $newStock]);
            }
        }

        // Update status transaksi
        $data = [
            'status' => $newStatus,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $transactionModel->update($id, $data);

        return redirect()->to('/admin/transactions')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function invoice($id)
    {
        // Inisialisasi model
        $transactionModel = new \App\Models\TransactionModel();
        $detailModel = new \App\Models\TransactionItemModel();

        // Ambil data transaksi utama + username dari users
        $transaction = $transactionModel
            ->select('transactions.*, users.username')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->find($id);

        // Jika transaksi tidak ditemukan, tampilkan halaman 404
        if (!$transaction) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Transaksi tidak ditemukan');
        }

        // Ambil data detail transaksi yang sudah di-join dengan nama produk
        $detailProduct = $detailModel
            ->select('transaction_items.*, product.product_name')
            ->join('product', 'product.id = transaction_items.product_id', 'left')
            ->where('transaction_id', $id)
            ->findAll();

        // Kirim data ke view
        return view('admin/transaction/invoice', [
            'transaction'    => $transaction,
            'detail_product' => $detailProduct,
            'title'          => $this->titleData // Pastikan properti ini ada
        ]);

    }

    public function sendInvoice(int $id)
    {
        $this->transactions = new TransactionModel();
        $this->detalitems        = new TransactionItemModel();
        
        // 1. Ambil data transaksi + email & username customer
        $trx = $this->transactions->getWithUser($id);
        if (!$trx) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Transaksi #{$id} tidak ditemukan");
        }

        // 2. Ambil detail produk
        $detail = $this->detalitems
                    ->select('transaction_items.*, product.product_name')
                    ->join('product', 'product.id = transaction_items.product_id')
                    ->where('transaction_id', $id)
                    ->findAll();

        // 3. Generate URL invoice (halaman view invoice yang sudah kamu punya)
        $invoiceUrl = base_url("admin/transaction/invoice/{$id}");

        // 4. Kirim email
        $email = \Config\Services::email();
        $email->setFrom('info@308store.com','308 Store');
        $email->setTo($trx['email']);
        $email->setSubject("Invoice Pembayaran #{$trx['transaction_code']}");

        // Render view invoice (pakai flag is_pdf agar tombol cetak/download hilang)
        $message = view('admin/transaction/invoice', [
            'transaction'    => $trx,
            'detail_product' => $detail,
            'title'          => ['image'=>'default-logo.png'], 
            'is_pdf'         => true,
        ]);
        $email->setMessage($message);

        if (! $email->send()) {
            // log error
            log_message('error', $email->printDebugger(['headers','subject','to','body']));
            session()->setFlashdata('error','Gagal mengirim email invoice.');
        } else {
            session()->setFlashdata('success','Invoice berhasil dikirim ke email '.$trx['email']);
        }

        // 5. Buat link WhatsApp
        $phone     = preg_replace('/\D/','',$trx['contact']); 
        $pesan     = "Halo {$trx['recipient_name']}, ini link invoice Anda: {$invoiceUrl}";
        $waLink    = 'https://wa.me/'.$phone.'?text='.urlencode($pesan);

        // 6. Redirect atau kirim balik link ke view
        return redirect()->back()->with('waLink', $waLink);
    }

    public function generatePdf($transactionId)
    {
        $transactionModel = new \App\Models\TransactionModel();
        $detailModel = new \App\Models\TransactionItemModel();

        // Ambil data transaksi
        $transaction = $transactionModel
            ->select('transactions.*, users.username')
            ->join('users', 'users.id = transactions.user_id')
            ->where('transactions.id', $transactionId)
            ->first();

        // Ambil detail produk
        $detail_product = $detailModel
            ->select('transaction_items.*, product.product_name')
            ->join('product', 'product.id = transaction_items.product_id', 'left')
            ->where('transaction_id', $transactionId)
            ->findAll();

        // Ambil logo dan encode ke base64
        $path = FCPATH . 'uploads/logo/1747714645_02bad58d45a9b332dc92.png';
        if (! is_file($path)) {
            return redirect()->back()->with('error', 'Logo perusahaan tidak ditemukan di server.');
        }
        $type     = pathinfo($path, PATHINFO_EXTENSION);
        $logoFile = file_get_contents($path);
        $base64   = 'data:image/' . $type . ';base64,' . base64_encode($logoFile);


        $title = $this->titleData;

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $data = [
            'transaction' => $transaction,
            'detail_product' => $detail_product,
            'title' => $title,
            'is_pdf' => true,
            'base64Logo' => $base64 // kirim ke view
        ];

        $html = view('admin/transaction/invoice', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('invoice_' . $transaction['transaction_code'] . '.pdf', ['Attachment' => false]);

    }
}