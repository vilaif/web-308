<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<style>
#cart {
    margin-top: 50px;
    padding-top: 100px;
    /* Atau padding-top */
}
</style>

<section id="cart">
    <div class="container">
        <div class="card">

        </div>
        <div class="card-header">
            <h2 class="card-title">Riwayat Pemesanan Saya</h2>
        </div>
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (empty($transactions)): ?>
        <p class="card-text">Belum ada transaksi.</p>
        <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $t): ?>
                <tr>
                    <td><?= esc($t['transaction_code']) ?></td>
                    <td>Rp <?= number_format($t['total_price'], 0, ',', '.') ?></td>
                    <td><?= ucfirst($t['status']) ?></td>
                    <td><?= date('d M Y H:i', strtotime($t['created_at'])) ?></td>
                    <td style="text-align: center">
                        <div class="d-grid gap-2 d-md-block">
                            <a href="<?= base_url('/my_orders/detail/' . $t['id']) ?>"
                                class="btn btn-info btn-sm"><strong>Detail</strong></a>
                            <?php if ($t['status'] == 'paid'): ?>
                            <a href="<?= base_url('invoice/' . $t['id']) ?>" target="_blank"
                                class="btn btn-warning btn-sm"><strong>Cetak
                                    Invoice</strong></a>
                            <?php else: ?>
                            <button class="btn btn-warning btn-sm" disabled><strong>Cetak
                                    Invoice</strong></button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

    </div>


</section>

<?= $this->endSection(); ?>