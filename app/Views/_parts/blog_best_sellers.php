<div class="filter-sidebar">
    <div class="title cloth-bg-color">
        <span><?= lang('best_sellers') ?></span>
    </div>
    <?= isset($load, $bestSellers) ? $load::getProducts($bestSellers, '', true) : '' ?>
</div>