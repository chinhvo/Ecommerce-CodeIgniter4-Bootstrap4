<div class="row">
    <div class="main-content col-lg-12 col-md-12 col-sm-12">
        <div class="row" style="margin-top:10px;">
            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                <div class="padding-add no-padding">
                    <h3 class="part-label mb-4\"><?= lang('products') ?></h3>
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
