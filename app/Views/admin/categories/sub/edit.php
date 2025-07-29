<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Sub Kategori</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('sub-categories/update/' . esc($subCategory['id'])) ?>"
                                method="post">
                                <?= csrf_field() ?>

                                <input type="hidden" name="category_id" value="<?= esc($subCategory['category_id']) ?>">

                                <div class="form-group">
                                    <label for="name">Nama Sub Kategori</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="<?= esc($subCategory['name']) ?>" required>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="<?= base_url('/sub-categories/' . esc($subCategory['category_id'])) ?>"
                                        class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->include('admin/partial/footer'); ?>