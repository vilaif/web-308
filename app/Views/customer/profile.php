<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<style>
#profile {
    margin-top: 100px;
    padding-top: 100px;
    padding-bottom: 100px;
    /* Atau padding-top */
}
</style>

<section id="profile">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profil Anda</h3>
                        </div>
                        <div class="card-body">
                            <!-- Pesan Succes ganti profile -->
                            <?php if (session()->getFlashdata('success')) : ?>
                            <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
                            <?php endif; ?>

                            <!-- Pesan Error ganti profile -->
                            <?php if (session()->getFlashdata('error')) : ?>
                            <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
                            <?php endif; ?>

                            <form action="<?= base_url('profile/update') ?>" method="post">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" name="username" value="<?= esc($user['username']) ?>"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">email:</label>
                                    <input type="email" name="email" value="<?= esc($user['email']) ?>"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>