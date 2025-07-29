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
                    <h1 class="m-0">Data Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Produk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <a href="<?= base_url('/d_products/add') ?>" class="btn btn-success mb-1">Tambah
                                        Produk</a>
                                </div>
                            </div>

                            <form method="get" action="<?= base_url('d_products') ?>">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="Cari produk/kategori..." value="<?= esc($_GET['search'] ?? '') ?>">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama Produk</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($product) && (is_array($product) || is_object($product))): ?>

                                    <?php 
                                        // Jumlah item per halaman (sama seperti di controller paginate(10))
                                        $perPage = 5;

                                        // Ambil current page dari variabel yang dikirim controller, kalau tidak ada default 1
                                        $currentPage = isset($currentPage) ? $currentPage : 1;

                                        // Hitung nomor urut awal di halaman ini
                                        $no = ($currentPage - 1) * $perPage + 1;
                                    ?>

                                    <?php foreach ((array) $product as $item): ?>
                                    <tr>
                                        <td><?= $no++; ?>.</td>
                                        <td><?= esc($item['product_name']); ?></td>
                                        <td><?= esc($item['stok']); ?></td>
                                        <td><?= esc($item['category_name']); ?></td>
                                        <td><?= !empty($item['name']) ? esc($item['name']) : '-' ?></td>
                                        <td><?= esc($item['price']); ?></td>
                                        <td><?= esc($item['description']); ?></td>
                                        <td>
                                            <?php if (!empty($item['image'])): ?>
                                            <a href="<?= base_url('uploads/products/' . $item['image']); ?>"
                                                target="_blank">
                                                <img src="<?= base_url('uploads/products/' . $item['image']); ?>"
                                                    width="100">
                                            </a>
                                            <?php else: ?>
                                            <span>Tidak ada gambar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="d-grid gap-2 d-md-block">
                                                <a href="<?= base_url('d_products/edit/' . $item['id']) ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('d_products/delete/' . $item['id']) ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>

                                    <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center">No products found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>


                            </table>

                            <!-- ✅ Pagination -->
                            <div class="pagination-wrapper d-flex justify-content-center" style="margin-top: 20px;">
                                <?= $pager->links('product_group', 'custom_pagination') ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <= $pager->links(); ?>
            </ul>
        </div> -->
    </section>


    <!-- /.main-content -->

</div><!-- /.container-fluid -->
<!-- /.content-wrapper -->

<?= $this->include('admin/partial/footer'); ?>