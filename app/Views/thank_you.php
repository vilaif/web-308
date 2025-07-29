<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<style>
#thank_you {
    margin-top: 100px;
    padding-top: 100px;
    padding-bottom: 100px;
    /* Atau padding-top */
}
</style>

<section id="thank_you">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Terima Kasih</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <p class="card-text">Transaksi Anda telah berhasil diproses.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <a href="<?= base_url('home') ?>" class="btn btn-primary">Kembali ke Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>