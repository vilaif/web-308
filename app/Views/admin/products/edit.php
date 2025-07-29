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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('d_products/update/' . $product['id']) ?>" method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="PUT">

                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        value="<?= old('product_name', $product['product_name']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-control"
                                        value="<?= old('stok', $product['stok']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Select Category --</option>
                                        <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>"
                                            <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                            <?= $category['category_name'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Sub Kategori Produk -->
                                <div class="form-group">
                                    <label for="sub_category">Sub Category</label>
                                    <select name="sub_category_id" id="sub_category" class="form-control" required>
                                        <option value="">-- Select Sub Category --</option>
                                        <?php foreach ($sub_categories as $sub_category): ?>
                                        <option value="<?= $sub_category['id']; ?>"
                                            <?= ($sub_category['id'] == ($selected_sub_category ?? '')) ? 'selected' : ''; ?>>
                                            <?= $sub_category['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        value="<?= old('price', $product['price']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"
                                        required><?= old('description', $product['description']) ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <small>Leave empty if you don't want to change the image.</small>
                                    <br>
                                    <?php if (!empty($product['image'])): ?>
                                    <img src="<?= base_url('uploads/products/' . $product['image']) ?>" width="100">
                                    <?php endif; ?>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Update</button>

                                    <a href="<?= base_url('/d_products') ?>" class="btn btn-secondary">Cancel</a>

                                </div>
                            </form>


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
    let categoryDropdown = $('#category_id');
    let subCategoryDropdown = $('#sub_category');
    let selectedCategory = categoryDropdown.val(); // Ambil kategori yang sedang dipilih

    function loadSubCategories(category_id, selected_sub_category = null) {
        if (category_id !== "") {
            $.ajax({
                url: "<?= base_url('d_products/getSubCategories'); ?>",
                type: "GET",
                data: {
                    category_id: category_id
                },
                dataType: "json",
                success: function(response) {
                    subCategoryDropdown.html('<option value="">-- Select Sub Category --</option>');

                    if (response.length > 0) {
                        $.each(response, function(key, value) {
                            let isSelected = selected_sub_category == value.id ?
                                'selected' : '';
                            subCategoryDropdown.append(
                                `<option value="${value.id}" ${isSelected}>${value.name}</option>`
                            );
                        });
                    } else {
                        subCategoryDropdown.html(
                            '<option value="">No sub categories available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", xhr.responseText);
                }
            });
        } else {
            subCategoryDropdown.html('<option value="">-- Select Sub Category --</option>');
        }
    }

    // Panggil fungsi saat halaman edit dimuat
    let selectedSubCategory = subCategoryDropdown.data('selected'); // Ambil sub kategori yang tersimpan
    loadSubCategories(selectedCategory, selectedSubCategory);

    // Panggil fungsi saat kategori berubah
    categoryDropdown.change(function() {
        loadSubCategories($(this).val());
    });
});
</script>

<?= $this->include('admin/partial/footer'); ?>