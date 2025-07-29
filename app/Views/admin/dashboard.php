<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Pemasukan</h5>
                            <p class="card-text fs-5">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Transaksi</h5>
                            <p class="card-text fs-5"><?= $total_transaksi ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-info">
                        <div class="card-body">
                            <h5 class="card-title">Total Kategori</h5>
                            <p class="card-text fs-5"><?= $total_category ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Total Produk</h5>
                            <p class="card-text fs-5"><?= $total_products ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    Transaksi Terbaru
                </div>
                <div class="card-body">
                    <?php if (empty($latest_transactions)): ?>
                    <p class="text-muted">Belum ada transaksi.</p>
                    <?php else: ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latest_transactions as $trx): ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($trx['created_at'])) ?></td>
                                <td><?= esc($trx['transaction_code']) ?></td>
                                <td><span
                                        class="badge bg-<?= $trx['status'] == 'paid' ? 'success' : 'warning' ?>"><?= esc($trx['status']) ?></span>
                                </td>
                                <td>Rp <?= number_format($trx['total_price'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Produk Stok Rendah -->
            <div class="card">
                <div class="card-header bg-danger text-white">
                    Produk dengan Stok Rendah
                </div>
                <div class="card-body">
                    <?php if (empty($low_stock_products)): ?>
                    <p class="text-muted">Semua stok produk aman.</p>
                    <?php else: ?>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    // Menghitung nomor urut
                    $currentPage = $pager->getCurrentPage('lowstock');
                    $perPage = 3;
                    $no = ($currentPage - 1) * $perPage + 1;
                    ?>
                            <?php foreach ($low_stock_products as $product): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($product['product_name']) ?></td>
                                <td><?= esc($product['stok']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Tampilkan pagination -->
                    <div class="mt-3">
                        <?= $pager->links('lowstock', 'custom_pagination') ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->include('admin/partial/footer'); ?>