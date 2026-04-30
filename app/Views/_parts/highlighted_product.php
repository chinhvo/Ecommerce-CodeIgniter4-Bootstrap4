<section class="main-content col-md-8 col-12">
    <div class="padding-add p-0 highlighted-products-wrap">
        <h4 class="part-label mb-1"><?= lang('highlighted_products') ?></h4>
        <div class="row products highlighted-products-grid">
            <?php if (!empty($highlightedProducts)) { ?>
                <?php $load::getProducts($highlightedProducts, 'col-md-3 col-sm-6 col-12', false); ?>
            <?php } else { ?>
                <div class="col-12">
                    <div class="alert alert-danger"><?= lang('no_products') ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
