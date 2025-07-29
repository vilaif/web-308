<?= $this->include('admin/partial/header'); ?>
<?= $this->include('admin/partial/top_menu'); ?>
<?= $this->include('admin/partial/side_menu'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Products</h3>
                        </div>
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
                            <!-- <pre><php print_r($categories); ?></pre> -->
                            <form action="<?= base_url('/d_products/store') ?>" method="post"
                                enctype="multipart/form-data">

                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id']; ?>"><?= esc($category['category_name']); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sub_category">Sub Category</label>
                                    <select id="sub_category" name="sub_category_id" class="form-control">
                                        <option value="">-- Select Sub Category --</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"
                                        rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image" class="form-control-file" required>

                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a href="<?= base_url('/d_products') ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#category_id').change(function() {
        let category_id = $(this).val();
        console.log("Category ID terpilih:", category_id);

        if (category_id !== "") {
            $.ajax({
                url: "<?= base_url('d_products/getSubCategories'); ?>",
                type: "GET",
                data: {
                    category_id: category_id
                },
                dataType: "json",
                success: function(response) {
                    console.log("Response:", response);
                    $('#sub_category').html(
                        '<option value="">-- Select Sub Category --</option>');

                    if (response.length > 0) {
                        $.each(response, function(key, value) {
                            $('#sub_category').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    } else {
                        $('#sub_category').html(
                            '<option value="">No sub categories available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", xhr.responseText);
                }
            });
        } else {
            $('#sub_category').html('<option value="">-- Select Sub Category --</option>');
        }
    });
});
</script>


<?= $this->include('admin/partial/footer'); ?>