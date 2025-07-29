<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
use Dompdf\Dompdf;

class ReportController extends BaseController
{
    public function pemasukan()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01'); // default awal bulan
        $endDate   = $this->request->getGet('end_date') ?? date('Y-m-d');    // default hari ini

        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $builder->select('*');  
        $builder->where('status', 'paid');
        $builder->where("DATE(created_at) >=", $startDate);
        $builder->where("DATE(created_at) <=", $endDate);
        $transactions = $builder->get()->getResultArray();

        // Hitung total pemasukan
        $total = 0;
        foreach ($transactions as $trx) {
            $total += $trx['total_price'];
        }

        $data = [
            'transaction' => $transactions,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_pemasukan' => $total,
            'title' => 'Laporan Pemasukan',
            'title2'  => $this->titleData // Pastikan properti ini ada
        ];

        return view('admin/report/pemasukan', $data);
    }

    public function printPdf()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        $transactionModel = new TransactionModel();

        // Hanya ambil transaksi yang status-nya "paid"
        $transactions = $transactionModel
            ->where('DATE(created_at) >=', $start_date)
            ->where('DATE(created_at) <=', $end_date)
            ->where('status', 'paid')
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $total_pemasukan = array_sum(array_column($transactions, 'total_price'));

        $data = [
            'title' => 'Laporan Pemasukan',
            'title2'  => $this->titleData, // Pastikan properti ini ada
            'transaction' => $transactions,
            'total_pemasukan' => $total_pemasukan,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];

        $html = view('admin/report/pdf_pemasukan', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("laporan_pemasukan.pdf", ["Attachment" => false]);
        
    }

    
}