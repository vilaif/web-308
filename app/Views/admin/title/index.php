<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Title & Logo</h1>
                </div><!-- /.col -->
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#<= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Product</li>
                    </ol>
                </div>/.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Form Tambah Produk -->
                            <?php if (session()->has('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <form action="<?= base_url('title/update/' . $title['id']) ?>" method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <!-- <input type="hidden" name="_method" value="PUT"> -->

                                <div class="mb-3">
                                    <label for="title" class="form-label">Nama Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="<?= $title['title'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Main Logo</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <?php if ($title['image']) : ?>
                                    <img src="<?= base_url('uploads/logo/' . $title['image']) ?>" alt="Logo"
                                        width="100">
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="image2" class="form-label">Upload Second Logo</label>
                                    <input type="file" name="image2" id="image2" class="form-control">
                                    <?php if ($title['image2']) : ?>
                                    <img src="<?= base_url('uploads/logo/' . $title['image2']) ?>" alt="Logo"
                                        width="100">
                                    <?php endif; ?>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- /.main-content -->

</div><!-- /.container-fluid -->
<!-- /.content-wrapper -->




<?= $this->include('admin/partial/footer'); ?>