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
        margin-top: 10px;
        padding: 5px 15px;
        background-color: rgb(99, 99, 99);
        color: white;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    #btn-back:hover {
        background-color: rgb(148, 148, 148);
    }
    </style>
</head>

<body>
    <div class="pemasukan-container">
        <div class="header">
            <div style="text-align: center;">
                <!-- <img src="<?= base_url('uploads/logo/' . ($title2['image'] ?? 'default-logo.png')) ?>"
                    alt="Logo Perusahaan" style="width: 300px;"> -->
                <!-- <img src="<?= base_url('uploads/logo/1747714645_02bad58d45a9b332dc92.png'  ?? 'default-logo.png') ?>"
                    alt="Logo Perusahaan" style="width: 300px;"> -->
                <!-- <img src="<?= FCPATH . 'uploads/logo/1747714645_02bad58d45a9b332dc92.png'  ?? 'default-logo.png' ?>"
                    style="width: 300px;" alt="Logo Perusahaan"> -->
                <img src="<?= FCPATH . 'uploads/logo/' . ($title2['image'] ?? 'default-logo.png') ?>"
                    style="width: 300px;" alt="Logo Perusahaan">
                <!-- <?php
                $image_path = FCPATH . 'uploads/logo/' . ($title2['image'] ?? 'default-logo.png');
                ?>

                <img src="file://<?= $image_path ?>" style="width: 300px;" alt="Logo Perusahaan"> -->



            </div>
            <h2><?= esc($title) ?></h2>
            <p>Periode: <?= esc($start_date) ?> s/d <?= esc($end_date) ?></p>
        </div>


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
                <?php endif; ?>
            </tbody>

            <?php if (!empty($transaction)) : ?>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total Pemasukan:</strong></td>
                    <td><strong>Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></strong></td>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table>
    </div>


</body>

</html>