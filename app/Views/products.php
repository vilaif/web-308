<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- ***** Main Banner Area Start ***** -->
<!-- <div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Check Our Products</h2>
                    <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- ***** Main Banner Area End ***** -->


<!-- ***** Products Area Starts ***** -->
<style>
.left-sidebar {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
}

.left-sidebar h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
    color: #333;
}

.category-products .panel {
    border: none;
    box-shadow: none;
    margin-bottom: 10px;
}

.category-products .panel-heading {
    background: none;
    padding: 0;
}

.category-products .panel-title a {
    display: flex;
    justify-content: space-between;
    /* Nama di kiri, icon di kanan */
    align-items: center;
    text-decoration: none;
    font-size: 16px;
    color: #000;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.category-products .panel-title a:hover {
    background-color: #f5f5f5;
    color: #007bff;
}

.category-products .panel-title a .category-name {
    flex: 1;
    text-align: left;
}

.category-products .panel-title a .toggle-icon {
    margin-left: 10px;
    font-weight: bold;
    font-size: 18px;
}

.category-products .panel-body {
    padding: 10px 0 10px 15px;
}

.category-products .panel-body ul {
    list-style: none;
    padding-left: 0;
}

.category-products .panel-body ul li {
    margin-bottom: 6px;
}

.category-products .panel-body ul li a {
    font-size: 14px;
    color: #555;
    text-decoration: none;
    transition: color 0.2s ease;
}

.category-products .panel-body ul li a:hover {
    color: #000;
    text-decoration: underline;
}
</style>

<section class="section mt-5" id="products">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Our Products</h2>
                    <span>Check out all of our products.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- Sidebar kategori -->
            <div class="col-md-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <?php foreach ($categories as $cat): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#cat<?= $cat['id']; ?>">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        <?= esc($cat['category_name']); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="cat<?= $cat['id']; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <?php if (!empty($subcategories[$cat['id']])): ?>
                                        <?php foreach ($subcategories[$cat['id']] as $sub): ?>
                                        <li>
                                            <a href="<?= base_url('products?subcategory=' . $sub['id']); ?>">
                                                <?= esc($sub['name']); ?>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <li>
                                            <a href="<?= base_url('products?category=' . $cat['id']); ?>">
                                                All
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Produk -->
            <div class="col-lg-9">
                <div class="row">

                    <?php if (empty($products)): ?>
                    <div class="col-12">
                        <p>Tidak ada produk ditemukan.</p>
                    </div>
                    <?php else: ?>
                    <?php foreach ($products as $product): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
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
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- <div class="d-flex justify-content-center mt-4">
                    <= $pager->links() ?>
                </div> -->
                <!-- Tampilkan pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    <?= $pager->links('products', 'custom_pagination') ?>
                </div>
            </div>

        </div>
    </div>



</section>
<!-- ***** Products Area Ends ***** -->

<?= $this->endSection(); ?>