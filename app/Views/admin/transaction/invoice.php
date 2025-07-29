<!DOCTYPE html>
<html>

<head>
    <title>Invoice #<?= esc($transaction['transaction_code']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 40px;
        color: #333;
    }

    .header,
    .footer-note {
        margin-bottom: 20px;
    }

    .company-info {
        font-size: 14px;
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    h2,
    h3 {
        margin-bottom: 0;
    }

    .no-border {
        border: none;
    }

    .text-right {
        text-align: right;
    }

    .invoice-container {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 10px;
    }

    .btn-print {
        margin-top: 20px;
        padding: 8px 16px;
        background-color: #444;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-print:hover {
        background-color: #333;
    }

    .footer-note {
        font-size: 12px;
        color: #777;
        margin-top: 40px;
    }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <div style="text-align: center;">
                <img src="<?= base_url('uploads/logo/' . ($title['image'] ?? 'default-logo.png')) ?>"
                    alt="Logo Perusahaan" style="width: 300px;">
            </div>


            <div class="company-info">
                <strong>308 Store</strong><br>
                Jl. Contoh Alamat No. 88<br>
                Telp: 0812-xxxx-xxxx<br>
                Email: info@308store.com
            </div>
        </div>

        <p><strong>Tanggal:</strong> <?= date('d F Y', strtotime($transaction['created_at'])) ?></p>
        <p><strong>Kode Transaksi:</strong> <?= esc($transaction['transaction_code']) ?></p>
        <p><strong>Username:</strong> <?= esc($transaction['username']) ?></p>
        <p><strong>Penerima:</strong> <?= esc($transaction['recipient_name']) ?></p>
        <p><strong>Alamat:</strong> <?= esc($transaction['address']) ?></p>
        <p><strong>No. Telp:</strong> <?= esc($transaction['contact']) ?></p>


        <table>
            <tr>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Transaksi Pembayaran</td>
                <td><?= esc($transaction['status']) ?></td>
            </tr>
        </table>

        <h3>Detail Produk</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $grandTotal = 0;
        foreach ($detail_product as $item):
            $total = $item['quantity'] * $item['price'];
            $grandTotal += $total;
        ?>
                <tr>
                    <td><?= esc($item['product_name']) ?></td>
                    <td><?= esc($item['quantity']) ?></td>
                    <td>Rp<?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td>Rp<?= number_format($total, 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Grand Total:</strong></td>
                    <td><strong>Rp<?= number_format($grandTotal, 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>

        <?php if (!isset($is_pdf) || !$is_pdf): ?>
        <button class="btn-print" onclick="window.print()">🖨️ Cetak</button>
        <!-- <a href="<= base_url('invoice/pdf/' . $transaction['id']) ?>" target="_blank" class="btn-print">
            Download PDF
        </a> -->
        <!-- <php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <php endif; ?> -->

        <!-- <php if(session()->get('waLink')): ?>
        <a href="<= session()->get('waLink') ?>" target="_blank" class="btn btn-success">
            📲 Kirim Invoice via WhatsApp
        </a>
        <php endif; ?> -->

        <!-- Tombol untuk trigger pengiriman -->
        <!-- <form action="<= base_url('transaction/sendInvoice/'.$transaction['id']) ?>" method="post">
            <= csrf_field() ?>
            <button class="btn btn-primary">✉️ Kirim Invoice ke Email & WA</button>
        </form>
        <?php endif; ?> -->

        <div class="footer-note">
            <hr>
            <p><em>Invoice ini dicetak secara otomatis oleh sistem dan tidak memerlukan tanda tangan.</em></p>
        </div>
    </div>
</body>

</html>