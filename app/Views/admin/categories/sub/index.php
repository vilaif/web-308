<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sub Kategori: <?= esc($parent['category_name']) ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('categories') ?>">Kategori Utama</a></li>
                        <li class="breadcrumb-item active">Sub Kategori</li>
                    </ol>
                </div>
            </div>

            <!-- Form Tambah Sub-Kategori -->
            <form action="<?= base_url('/sub-categories/store') ?>" method="post">
                <div class="input-group mt-3">
                    <input type="hidden" name="category_id" value="<?= esc($parent['id']) ?>">
                    <input type="text" class="form-control" name="name" placeholder="Nama Sub-Kategori" required>
                    <button class="btn btn-success" type="submit">Tambah Sub-Kategori</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sub Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($subCategories) && is_array($subCategories)): ?>
                                    <?php foreach ($subCategories as $index => $sub): ?>
                                    <tr>
                                        <td><?= esc($index + 1); ?>.</td>
                                        <td><?= esc($sub['name']); ?></td>
                                        <td style="text-align: center">
                                            <a href="<?= base_url('/sub-categories/edit/' . esc($sub['id'])) ?>"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('/sub-categories/delete/' . esc($sub['id'])) ?>"
                                                onclick="return confirm('Hapus sub-kategori ini?')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada sub kategori</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <a href="<?= base_url('categories') ?>" class="btn btn-secondary mt-3">
                                Kembali ke Kategori Utama
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?= $this->include('admin/partial/footer'); ?>