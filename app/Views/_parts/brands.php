<?php if ($showBrands == 1) { ?>
    <div class="h-line"></div>

    <h3 class="part-label"><?= lang('brands') ?></h3>

    <?php if (isset($_GET['brand_id']) && $_GET['brand_id'] != '') { ?>
        <a
            href="javascript:void(0);"
            class="clear-filter"
            data-type-clear="brand_id"
            data-toggle="tooltip"
            data-placement="right"
            title="<?= lang('clear_the_filter') ?>"
        >
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
    <?php } ?>

    <div class="brands">
        <ul class="list">
            <?php foreach ($brands as $brand) { ?>
                <li>
                    <a
                        href="javascript:void(0);"
                        data-brand-id="<?= $brand['id'] ?>"
                        class="brand <?= isset($_GET['brand_id']) && $_GET['brand_id'] == $brand['id'] ? 'selected' : '' ?>"
                    >
                        <span><?= $brand['name'] ?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
