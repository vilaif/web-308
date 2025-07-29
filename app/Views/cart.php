<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<style>
#cart {
    margin-top: 100px;
    padding-top: 100px;
    /* Atau padding-top */
}
</style>

<section class="section mt-5" id="cart">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Keranjang Belanja</h2>
            </div>


            <?php if (!empty($cart)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total = 0;
                        foreach ($cart as $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td>
                            <form action="<?= base_url('cart/update') ?>" method="post" class="d-flex"
                                style="gap: 5px;">
                                <input type="hidden" name="product_id" value="<?= esc($item['id']) ?>">
                                <input type="number" name="quantity" value="<?= esc($item['quantity']) ?>" min="1"
                                    style="width: 60px;">
                                <button type="submit" class="btn btn-sm btn-warning">Update</button>
                            </form>
                        </td>
                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        <td>
                            <a href="/cart/remove/<?= esc($item['id']) ?>"
                                onclick="return confirm('Yakin ingin menghapus item ini?')"
                                class="btn btn-sm btn-danger">Hapus</a>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td colspan="2"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <a href="<?= base_url('/checkout') ?>" class="btn btn-primary">Lanjut ke Checkout</a>
            <?php else: ?>
            <div class="form-group pt-3">
                <div class="row justify-content-center">
                    <p class="card-text">Keranjang masih kosong.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>



    </div>
</section>

<?= $this->endSection(); ?>