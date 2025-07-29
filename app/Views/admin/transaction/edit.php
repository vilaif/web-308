<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Status Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/transactions/update/' . $transaction['id']) ?>"
                                method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="card-body">
                                    <p class="card-text"><strong>Kode Transaksi:</strong>
                                        <?= esc($transaction['transaction_code']) ?></p>
                                    <p class="card-text"><strong>Tanggal:</strong>
                                        <?= date('d M Y H:i', strtotime($transaction['created_at'])) ?></p>
                                    <p class="card-text"><strong>Nama Penerima:</strong>
                                        <?= esc($transaction['recipient_name']) ?></p>
                                    <p class="card-text"><strong>Alamat:</strong> <?= esc($transaction['address']) ?>
                                    </p>
                                    <p class="card-text"><strong>Kontak:</strong> <?= esc($transaction['contact']) ?>
                                    </p>

                                    <p class="card-text"><strong>Total:</strong> Rp
                                        <?= number_format($transaction['total_price'], 0, ',', '.') ?></p>


                                    <?php if (!empty($transaction['payment_proof'])): ?>
                                    <p class="card-text"><strong>Bukti Pembayaran:</strong><br>
                                        <a href="<?= base_url('uploads/bukti_pembayaran/' . $transaction['payment_proof']) ?>"
                                            target="_blank">
                                            <img src="<?= base_url('uploads/bukti_pembayaran/' . $transaction['payment_proof']) ?>"
                                                alt="Bukti Pembayaran" width="300">
                                        </a>
                                        <?php else: ?>
                                    <p class="card-text"><i>Tidak ada bukti pembayaran</i></p>
                                    <?php endif; ?>
                                </div>

                                <div class='card-body'>
                                    <h5 class="mt-4">Ringkasan Belanja</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $grandTotal = 0; ?>
                                            <?php foreach ($items as $item): ?>
                                            <?php $subtotal = $item['price'] * $item['quantity']; ?>
                                            <tr>
                                                <td><?= esc($item['product_name']) ?></td>
                                                <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                                <td><?= $item['quantity'] ?></td>
                                                <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                            </tr>
                                            <?php $grandTotal += $subtotal; ?>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="3"><strong>Total</strong></td>
                                                <td><strong>Rp <?= number_format($grandTotal, 0, ',', '.') ?></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending"
                                            <?= $transaction['status'] == 'pending' ? 'selected' : '' ?>>Pending
                                        </option>
                                        <option value="paid" <?= $transaction['status'] == 'paid' ? 'selected' : '' ?>>
                                            Paid
                                        </option>
                                        <option value="cancelled"
                                            <?= $transaction['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled
                                        </option>
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Update</button>

                                    <a href="<?= base_url('/admin/transactions') ?>"
                                        class="btn btn-secondary">Cancel</a>

                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->include('admin/partial/footer'); ?>