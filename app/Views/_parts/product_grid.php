<div class="row">
    <div class="main-content col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                <div class="section-box section-box-no-padding">
                    <h4 class="part-label mb-4"><?= lang('best_sellers') ?></h4>
                    <div class="row products">
                        <?php
                        if (! empty($products)) {
                            $load::getProducts($products, 'col-md-2 col-sm-4 col-xs-6', false);
                        } else {
                        ?>
                            <div class="col-12">
                                <div class="alert alert-danger"><?= lang('no_products') ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $links_pagination ?>
