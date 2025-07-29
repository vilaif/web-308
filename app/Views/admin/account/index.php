<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile Admin</h1>
                </div><!-- /.col -->

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
                            <!-- Pesan Succes ganti profile -->
                            <?php if (session()->getFlashdata('success')) : ?>
                            <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
                            <?php endif; ?>

                            <!-- Pesan Error ganti profile -->
                            <?php if (session()->getFlashdata('error')) : ?>
                            <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
                            <?php endif; ?>

                            <form action="<?= base_url('/admin-profile/update') ?>" method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <!-- <input type="hidden" name="_method" value="PUT"> -->

                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" name="username" value="<?= esc($user['username']) ?>"
                                        class="form-control" required><br>
                                </div>

                                <div class="form-group">
                                    <label for="password">Ganti Password (opsional):</label><br>
                                    <input type="password" name="password" placeholder="Password baru"
                                        class="form-control"><br>
                                    <input type="password" name="password_confirm"
                                        placeholder="Konfirmasi password baru" class="form-control"><br>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Update</button>
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