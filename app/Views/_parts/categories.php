<?php
$arrCategories = array();
foreach ($all_categories as $categorie) {
    if (isset($_GET['category']) && is_numeric($_GET['category']) && $_GET['category'] == $categorie['sub_for']) {
        $arrCategories[] = $categorie;
    }

    if (! isset($_GET['category']) || $_GET['category'] == '') {
        if ($categorie['sub_for'] == 0) {
            $arrCategories[] = $categorie;
        }
    }
}
?>

<div class="h-line"></div>
<h3 class="part-label"><?= lang('categories') ?></h3>

<?php if (isset($_GET['category']) && $_GET['category'] != '') { ?>
    <a
        href="javascript:void(0);"
        class="clear-filter"
        data-type-clear="category"
        data-toggle="tooltip"
        data-placement="top"
        title="<?= lang('clear_the_filter') ?>"
    >
        <span class="d-none d-sm-inline">
            <?= lang('clear_the_filter') ?>
        </span>
        <i class="fa fa-times" aria-hidden="true"></i>
    </a>
<?php } ?>

<a href="javascript:void(0)" id="show-xs-nav" class="d-block d-sm-none">
    <span class="show-sp">
        <?= lang('showXsNav') ?><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
    </span>
    <span class="hidde-sp">
        <?= lang('hideXsNav') ?><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
    </span>
</a>

<div class="categories">
    <?php if (! empty($arrCategories)) { ?>
        <ul class="list">
            <?php foreach ($arrCategories as $categorie) { ?>
                <li>
                    <a
                        href="javascript:void(0);"
                        data-categorie-id="<?= $categorie['id'] ?>"
                        class="go-category left-side <?= isset($_GET['category']) && $_GET['category'] == $categorie['id'] ? 'selected' : '' ?>"
                    >
                        <?php if (! empty($categorie['icon'])) { ?>
                            <i class="<?= esc($categorie['icon']) ?>" aria-hidden="true"></i>
                        <?php } ?>
                        <span><?= htmlspecialchars($categorie['name'], ENT_QUOTES, 'UTF-8') ?></span>
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <div class="alert alert-info"><?= lang('no_sub_categories') ?></div>
    <?php } ?>
</div>
