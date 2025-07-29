<style>
.pagination a {
    padding: 6px 12px;
    margin: 2px;
    background-color: #f2f2f2;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
    border: 1px solid #007bff;
}

.pagination a:hover {
    background-color: #ddd;
}
</style>

<?php
// Jika $group belum ada, set default
$group = isset($group) ? $group : 'default';
?>

<div class="pagination">
    <?php if ($pager->hasPreviousPage($group)): ?>
    <a href="<?= $pager->getPreviousPage($group) ?>">&laquo; Prev</a>
    <?php endif; ?>

    <?php foreach ($pager->links($group) as $link): ?>
    <a href="<?= $link['uri'] ?>" class="<?= $link['active'] ? 'active' : '' ?>">
        <?= $link['title'] ?>
    </a>
    <?php endforeach; ?>

    <?php if ($pager->hasNextPage($group)): ?>
    <a href="<?= $pager->getNextPage($group) ?>">Next &raquo;</a>
    <?php endif; ?>
</div