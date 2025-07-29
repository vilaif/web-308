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
            <h2 class="card-title">Detail Transaksi</h2>
        </div>

        <div class="card-body">
            <p class="card-text"><strong>Kode Transaksi:</strong> <?= esc($transaction['transaction_code']) ?></p>
            <p class="card-text"><strong>Tanggal:</strong>
                <?= date('d M Y H:i', strtotime($transaction['created_at'])) ?></p>
            <p class="card-text"><strong>Nama Penerima:</strong> <?= esc($transaction['recipient_name']) ?></p>
            <p class="card-text"><strong>Alamat:</strong> <?= esc($transaction['address']) ?></p>
            <p class="card-text"><strong>Kontak:</strong> <?= esc($transaction['contact']) ?></p>
            <p class="card-text"><strong>Status:</strong> <?= ucfirst($transaction['status']) ?></p>
            <p class="card-text"><strong>Total:</strong> Rp
                <?= number_format($transaction['total_price'], 0, ',', '.') ?></p>

            <?php if ($transaction['payment_proof']): ?>
            <p class="card-text"><strong>Bukti Pembayaran:</strong><br>
                <a href="<?= base_url('uploads/bukti_pembayaran/' . $transaction['payment_proof']) ?>" target="_blank">
                    <img src="<?= base_url('uploads/bukti_pembayaran/' . $transaction['payment_proof']) ?>"
                        alt="Bukti Pembayaran" width="200">
                </a>
            </p>
            <?php endif; ?>

            <hr>

            <h3 class="card-title">Item Transaksi</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= esc($item['product_name']) ?></td>
                        <!-- Bisa diganti nama produk jika relasi ke tabel produk -->
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <br>
            <a href="<?= base_url('/my_orders') ?>" class="btn btn-primary">← Kembali ke Riwayat Pesanan</a>
        </div>
    </div>
</section>



<?= $this->endSection(); ?>