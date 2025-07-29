<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <a href="<?= base_url('/categories/add') ?>" class="btn btn-success mb-1">Tambah
                                        Kategori</a>
                                </div>
                            </div>
                            <form method="get" action="<?= base_url('categories') ?>">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Kategori..."
                                        value="<?= esc($_GET['search'] ?? '') ?>">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama Kategori</th>
                                        <th style="width: 20%">Sub Kategori</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $index => $category): ?>
                                    <tr>
                                        <td><?= $index + 1; ?>.</td>
                                        <td><?= esc($category['category_name']); ?></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="<?= base_url('sub-categories/' . $category['id']) ?>"
                                                class="btn btn-info">Lihat Sub Kategori</a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="<?= base_url('categories/edit/' . $category['id']) ?>"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('categories/delete/' . $category['id']) ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');"><i
                                                    class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada kategori</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('admin/partial/footer'); ?>