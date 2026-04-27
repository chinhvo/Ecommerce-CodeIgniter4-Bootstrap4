<?php if (!empty($highlightedProducts)) { ?>
    <section class="main-content col-md-8 col-12 border">
        <div class="padding-add p-0 highlighted-products-wrap">
            <h4 class="part-label mb-4"><?= lang('highlighted_products') ?></h4>
            <div class="row products highlighted-products-grid">
                <?php $load::getProducts($highlightedProducts, 'col-md-3 col-sm-6 col-12', false); ?>
            </div>
        </div>
    </section>
<?php } ?>
