<?php
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">

        <!-- Previous -->
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('pagination.previous') ?>">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only"><?= lang('pagination.previous') ?></span>
                </a>
            </li>
        <?php endif ?>

        <!-- Pages -->
        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <!-- Next -->
       
        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('pagination.next') ?>">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only"><?= lang('pagination.next') ?></span>
                </a>
            </li>
        <?php endif ?>

    </ul>
</nav>
