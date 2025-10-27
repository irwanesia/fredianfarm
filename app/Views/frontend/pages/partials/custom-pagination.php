<!-- custom_pagination_view.php -->
<?php 
// Set surround count
$pager->setSurroundCount(2);
?>

<div class="row">
    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg justify-content-center m-0">
            <!-- Previous Link - FIXED -->
            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <a class="page-link rounded-0" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                        <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                    </a>
                </li>
            <?php else : ?>
                <li class="page-item disabled">
                    <a class="page-link rounded-0" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Page Links -->
            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>

            <!-- Next Link - FIXED -->
            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <a class="page-link rounded-0" href="<?= $pager->getNext() ?>" aria-label="Next">
                        <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                    </a>
                </li>
            <?php else : ?>
                <li class="page-item disabled">
                    <a class="page-link rounded-0" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>