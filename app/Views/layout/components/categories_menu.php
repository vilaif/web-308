<?php foreach ($categories as $category): ?>
<li><a href="<?= base_url('category/' . $category['id']) ?>">
        <?= esc($category['category_name']); ?>
    </a></li>
<?php endforeach; ?>