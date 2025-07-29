<html>

<head>
    <title><?= $title ?></title>
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

    .pemasukan-container {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 10px;
    }

    /* .btn-print {
        margin-top: 20px;
        padding: 8px 16px;
        background-color: #444;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    } */

    /* .btn-print:hover {
        background-color: #333;
    } */

    /* .footer-note {
        font-size: 12px;
        color: #777;
        margin-top: 40px;
    } */


    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    form {
        margin-bottom: 20px;
    }

    label {
        margin-right: 10px;
        font-weight: bold;
    }

    input[type="date"] {
        padding: 5px;
        margin-right: 10px;
    }

    button {
        padding: 5px 15px;
        background-color: #28a745;
        color: white;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    /* table,
    th,
    td {
        border: 1px solid #ccc;
    }

    th {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: left;
    }

    td {
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .total-row {
        background-color: #d4edda;
        font-weight: bold;
    } */

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .btn-back {
        display: flex;
        justify-content: flex-end;
        /* membuat konten di dalam div mentok kanan */
    }

    #btn-back {
        margin: 10px 10px 0px;
        padding: 5px 15px;
        background-color: rgb(99, 99, 99);
        color: white;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    #btn-back:hover {
        background-color: rgb(148, 148, 148);
    }

    #btn-print {
        margin-top: 10px;
        padding: 5px 15px;
        background-color: rgb(44, 44, 255);
        color: white;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;

        /* display: inline-block; */
        /* margin-top: 10px;
        padding: 8px 15px;
        background: #4CAF50;
        color: #fff;
        text-decoration: none; */

    }

    #btn-print:hover {
        background-color: rgb(101, 101, 254);
    }
    </style>
</head>

<body>
    <div class="pemasukan-container">
        <div class="header">
            <div style="text-align: center;">
                <img src="<?= base_url('uploads/logo/' . ($title2['image'] ?? 'default-logo.png')) ?>"
                    alt="Logo Perusahaan" style="width: 300px;">
            </div>
            <h2><?= esc($title) ?></h2>
        </div>


        <form method="get">
            <label for="start_date">Dari Tanggal:</label>
            <input type="date" id="start_date" name="start_date" value="<?= esc($start_date) ?>">

            <label for="end_date">Sampai Tanggal:</label>
            <input type="date" id="end_date" name="end_date" value="<?= esc($end_date) ?>">

            <button type="submit">Tampilkan</button>
        </form>

        <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px; width:100%;">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode Transaksi</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transaction)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada transaksi</td>
                </tr>
                <?php else: ?>
                <?php foreach ($transaction as $trx): ?>
                <tr>
                    <td><?= date('d-m-Y', strtotime($trx['created_at'])) ?></td>
                    <td><?= esc($trx['transaction_code']) ?></td>
                    <td><?= esc($trx['status']) ?></td>
                    <td>Rp <?= number_format($trx['total_price'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total Pemasukan:</strong></td>
                    <td><strong>Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></strong></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="btn-back">
            <a href="<?= base_url('/admin/transactions') ?>" id="btn-back">Back</a>
            <!-- Tombol cetak PDF -->
            <?php if (!empty($start_date) && !empty($end_date)) : ?>
            <!-- <a href="<?= base_url('/admin/laporan/print-pdf') . '?start_date=' . esc($start_date) . '&end_date=' . esc($end_date) ?>"
                target="_blank" id="btn-print" style="">
                Cetak PDF
            </a> -->
            <a href="<?= base_url('/admin/laporan/print-pdf') . '?start_date=' . esc($start_date) . '&end_date=' . esc($end_date) ?>"
                target="_blank" id="btn-print" style="">
                Cetak PDF
            </a>
            <?php endif; ?>
        </div>
    </div>


</body>

</html>