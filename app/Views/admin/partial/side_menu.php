<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link" style="text-decoration: none;">
        <img src="<?=base_url('logo308w.png')?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <?php if (session()->get('isLoggedIn')): ?>
        <span class="brand-text font-weight-light">
            Hi, <?= esc(session()->get('username')) ?>
        </span>
        <?php endif; ?>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<=base_url('adminLTE/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/categories') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i> <!-- ganti dari fa-th -->
                        <p>Kategori</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/d_products') ?>" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i> <!-- ganti dari fa-copy -->
                        <p>Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/admin/transactions') ?>" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i> <!-- ganti dari fa-copy -->
                        <p>Transaksi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/admin-profile') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i> <!-- ganti dari fa-copy -->
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/title') ?>" class="nav-link">
                        <i class="nav-icon fas fa-heading"></i> <!-- ganti dari fa-copy -->
                        <p>Title & Logo</p>
                    </a>
                </li>


            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>