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
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('categories/update/' . $category['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="parent_id"
                                    value="<?= isset($category['parent_id']) ? $category['parent_id'] : 0 ?>">

                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control"
                                        value="<?= $category['category_name'] ?>" required>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="<?= base_url('/categories') ?>" class="btn btn-secondary">Cancel</a>
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