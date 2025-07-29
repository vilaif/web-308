<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<?php
$namaProduk = $product['product_name']; // Misal: "Kaos 308 Hitam"
$idProduk = $product['id']; // Misal: 2
$linkProduk = base_url('single_product/' . $idProduk);

$pesan = "Halo, saya tertarik dengan produk *$namaProduk*. Berikut linknya: $linkProduk";
$pesanEncoded = urlencode($pesan);
?>


<!-- ***** Main Banner Area Start ***** -->
<div class="page-heading" id="top">
    <div class="container">
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Single Product Page</h2>
                    <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<!-- ***** Product Area Starts ***** -->
<section class="section" id="product">
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="left-images">
                    <a href="<?= base_url('uploads/products/' . $product['image']) ?>" target="_blank">
                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>"
                            alt="<?= esc($product['product_name']) ?>">
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content">
                    <h4><?= esc($product['product_name']) ?></h4>
                    <span class="price">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>

                    <div class="quote">
                        <p><?= nl2br(esc($product['description'] ?? '-')) ?></p>
                    </div>

                    <div class="quantity-content">


                        <!-- Form Tambah ke Keranjang -->
                        <form action="<?= base_url('/add-to-cart') ?>" method="post">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="product_name" value="<?= $product['product_name'] ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>">

                            <div class="form-group">
                                <label for="quantity">Jumlah:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" required
                                    class="form-control mb-2">
                            </div>

                            <div class="main-border-button mb-3">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-cart-shopping"></i>&nbsp; Tambah ke Keranjang</button>
                            </div>
                        </form>

                        <!-- Tombol WhatsApp -->
                        <!-- <div class="main-border-button mb-3">
                            <a href="https://wa.me/6289679583095?text=<?= $pesanEncoded ?>" target="_blank"
                                class="btn btn-success">
                                <i class="fa-brands fa-whatsapp"></i></i>&nbsp; Chat via WhatsApp
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ***** Product Area Ends ***** -->

<?= $this->endSection(); ?>