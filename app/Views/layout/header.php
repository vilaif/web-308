<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="<?= base_url('/') ?>" class="logo">
                        <!-- <img src="<= base_url('logo308b.png'); ?>"> -->
                        <img src="<?= base_url('uploads/logo/' . ($title['image'] ?? 'default-logo.png')) ?>" alt="Logo"
                            class="logo-img" style="padding: 15px">

                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="<?= base_url('/') ?> ">Home</a></li>
                        <li class="scroll-to-section"><a href="<?= base_url('products') ?>">Product</a></li>
                        <!-- <li class="submenu"> -->
                        <!-- <a href="javascript:;">Category</a> -->
                        <!-- <ul> -->
                        <!-- <= view_cell('App\Controllers\ComponentController::categoriesMenu') ?> -->
                        <!-- </ul> -->
                        <!-- </li> -->

                        <a href="<?= base_url('/cart') ?>"
                            class="btn btn-dark d-flex align-items-center gap-2 px-3 py-2 rounded shadow">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <!-- <span>Lihat Keranjang</span> -->
                        </a>

                        <!-- Tombol log in Start -->
                        <?php if (session()->get('isLoggedIn')): ?>
                        <li class="scroll-to-section submenu">
                            <a href="javascript:;">
                                Hi, <?= esc(session()->get('username')) ?>
                            </a>
                            <ul style="list-style: none;">
                                <li><a href="<?= base_url('/profile') ?>">Profil</a></li>
                                <li><a href="<?= base_url('/my_orders') ?>">Riwayat Pemesanan</a></li>
                                <li><a href="<?= base_url('/logout') ?>">Logout</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="scroll-to-section">
                            <a href="<?= base_url('/login') ?>" class="btn btn-success btn-sm" style="color: #ffffff;">
                                Log In
                            </a>
                        </li>
                        <?php endif; ?>

                        <!-- Tombol Login End -->
                        <!-- <li class="scroll-to-section"><a href="about">About</a></li>
                        <li class="scroll-to-section"><a href="contact">Contact</a></li> -->
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->