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
                    <h1 class="m-0">Data Transaction</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Transaction</li>
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

                            <div class="col-12 mb-4">
                                <a href="<?= base_url('/admin/laporan/pemasukan') ?>" class="btn btn-success mb-1">Cetak
                                    Laporan
                                    Pemasukan</a>
                            </div>

                            <form method="get" action="<?= base_url('/admin/transactions') ?>">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="Cari kode/username/penerima/status..."
                                        value="<?= esc($_GET['search'] ?? '') ?>">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Kode</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Penerima</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transactions) && is_array($transactions) || is_object($transactions)): ?>
                                    <?php foreach ($transactions as $index => $trans): ?>


                                    <tr>
                                        <td><?= (int) $index + 1; ?>.</td>
                                        <td><?= $trans['transaction_code'] ?></td>
                                        <td><?= $trans['username'] ?></td>
                                        <td><?= $trans['email'] ?></td>
                                        <td><?= $trans['recipient_name'] ?></td>
                                        <td><span
                                                class="badge bg-<?= $trans['status'] == 'paid' ? 'success' : 'warning' ?>"><?= esc($trans['status']) ?></span>
                                        </td>

                                        <td><?= date('d M Y H:i', strtotime($trans['created_at'])) ?></td>
                                        <td style="text-align: center">
                                            <div class="d-grid gap-2 d-md-block">
                                                <a href="<?= base_url('admin/transactions/edit/' . $trans['id']) ?>"
                                                    class="btn btn-warning btn-sm"><strong>Ubah Status</strong></a>
                                                <?php if ($trans['status'] == 'paid'): ?>
                                                <a href="<?= base_url('admin/transactions/invoice/' . $trans['id']) ?>"
                                                    target="_blank" class="btn btn-info btn-sm"><strong>Cetak
                                                        Invoice</strong></a>
                                                <?php else: ?>
                                                <button class="btn btn-secondary btn-sm" disabled><strong>Cetak
                                                        Invoice</strong></button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No products found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>

                            </table>

                            <!-- ✅ Pagination -->
                            <div class="pagination-wrapper d-flex justify-content-center" style="margin-top: 20px;">
                                <?= $pager->links('transactions', 'custom_pagination') ?>
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