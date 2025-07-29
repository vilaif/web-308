<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4>We Are 308AbsltUnscared</h4>
                            <!-- <span>Awesome, clean &amp; creative HTML5 Template</span> -->
                            <div class="main-border-button">
                                <a href="<?= base_url('products') ?>">Purchase Now!</a>
                            </div>
                        </div>
                        <img src="<?= base_url('assets/images/left-banner-image.jpg'); ?>" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<!-- ***** Men Area Starts ***** -->
<section class="section" id="women">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Our Latest Product</h2>
                    <!-- <span>Details to details is what makes Hexashop different from the other themes.</span> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="women-item-carousel">
                    <div class="owl-women-item owl-carousel">
                        <?php foreach ($products as $product): ?>
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="<?= base_url('single_product/' . $product['id']) ?>"><i
                                                    class="fa fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <?php if (!empty($product['image'])): ?>
                                <img src="<?= base_url('uploads/products/' . $product['image']); ?>"
                                    alt="<?= esc($product['product_name']); ?>">
                                <?php else: ?>
                                <img src="<?= base_url('uploads/products/default.png'); ?>" alt="No image">
                                <?php endif; ?>
                            </div>
                            <div class="down-content">
                                <h4><?= esc($product['product_name']); ?></h4>
                                <span>Rp <?= number_format($product['price'], 0, ',', '.'); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Main Banner Men End ***** -->

<!-- ***** Social Area Starts ***** -->
<section class="section" id="social">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Our Social Media</h2>
                    <!-- <span>Details to details is what makes Hexashop different from the other themes.</span> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row images justify-content-center">
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a
                            href="https://www.instagram.com/store.308absltunscrdyk?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                            <h6>Instagram</h6>
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                    <img src="<?= base_url('uploads/socmed/ig.png') ?>" alt="">
                </div>
            </div>

            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="https://www.tiktok.com/@308absltunscrd?is_from_webapp=1&sender_device=pc">
                            <h6>Tiktok</h6>
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                    <img src="<?= base_url('uploads/socmed/tk.png') ?>" alt="">
                </div>
            </div>

            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="https://www.facebook.com/308absoluteunscared.official/">
                            <h6>Facebook</h6>
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </div>
                    <img src="<?= base_url('uploads/socmed/fb.png') ?>" alt="">
                </div>
            </div>
            <!-- https://www.tiktok.com/@308absltunscrd?is_from_webapp=1&sender_device=pc -->
        </div>
    </div>
</section>
<!-- ***** Social Area Ends ***** -->



<?= $this->endSection(); ?>