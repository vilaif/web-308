<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<style>
#checkout {
    margin-top: 100px;
    padding-top: 100px;
    padding-bottom: 100px;
    /* Atau padding-top */
}
</style>

<section id="checkout">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Checkout</h2>
                        </div>
                        <div class="card-body">

                            <?php if (session()->getFlashdata('success')) : ?>
                            <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')) : ?>
                            <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
                            <?php endif; ?>

                            <form action="<?= base_url('/checkout/process') ?>" method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <h3 class="card-title">Detail Pengiriman</h3>
                                <div class="form-group">
                                    <label for="recipient_name">Nama Penerima</label>
                                    <input type="text" name="recipient_name" class="form-control"
                                        placeholder="Nama Penerima" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">Alamat</label><br>
                                    <textarea rows="4" name="address" placeholder="Alamat tinggal saat ini"
                                        class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="contact">Kontak</label>
                                    <input type="text" name="contact" class="form-control"
                                        placeholder="Kontak yang bisa dihubungi" required>
                                </div>

                                <div class="form-group">
                                    <label for="payment_roof">Bukti Pembayaran <span
                                            class="badge bg-info text-white">No.
                                            Rekening : **********</span></label>
                                    <input type="file" name="payment_proof" accept="image/*" class="form-control-file"
                                        required>

                                </div>

                                <div class="form-group mt-5 mb-5">
                                    <h3 class="card-title">Ringkasan Belanja</h3>
                                    <ul>
                                        <?php foreach($cart as $item): ?>
                                        <li>
                                            <?= esc($item['name']) ?> × <?= $item['quantity'] ?>
                                            — Rp <?= number_format($item['price'] * $item['quantity'],0,',','.') ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <p><strong>Total: Rp
                                            <?= number_format(array_reduce($cart, fn($s,$i)=>$s+($i['price']*$i['quantity']),0),0,',','.') ?></strong>
                                    </p>
                                </div>



                                <button type="submit" class="btn btn-success w-100">Generate</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>