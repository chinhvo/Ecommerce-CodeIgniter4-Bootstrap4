<?php
$categoryId = trim((string) (request()->getGet('category') ?? ''));
$categoryTree = $home_categories ?? [];

if (empty($categoryTree) && !empty($all_categories)) {
    $indexedCategories = [];

    foreach ($all_categories as $category) {
        $category['children'] = [];
        $indexedCategories[(int) $category['id']] = $category;
    }

    foreach ($indexedCategories as $id => $category) {
        $parentId = (int) $category['sub_for'];

        if ($parentId !== 0 && isset($indexedCategories[$parentId])) {
            $indexedCategories[$parentId]['children'][] = $category;
            unset($indexedCategories[$id]);
        }
    }

    $categoryTree = array_values($indexedCategories);
}

$renderCategories = static function (array $categories, int $level = 1) use (&$renderCategories, $categoryId): void {
    if (empty($categories) || $level > 2) {
        return;
    }
?>
    <ul class="list<?= $level > 1 ? ' pl-3' : '' ?>">
        <?php foreach ($categories as $category) {
            $hasChildren = !empty($category['children']) && $level < 2;
        ?>
            <li>
                <a
                    href="<?= base_url('?category=' . esc($category['slug'] ?? (string) $category['id'])) ?>"
                    class="go-category left-side">
                    <?php if (!empty($category['icon']) && $level === 1) { ?>
                        <i class="<?= esc($category['icon']) ?>" aria-hidden="true"></i>
                    <?php } ?>
                    <span><?= esc($category['name'], 'html') ?></span>
                    <?php if ($hasChildren) { ?>
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    <?php } ?>
                </a>
                <?php if ($hasChildren) {
                    $renderCategories($category['children'], $level + 1);
                } ?>
            </li>
        <?php } ?>
    </ul>
<?php
};
?>

<div class="h-line"></div>
<h3 class="part-label"><?= lang('main_category') ?></h3>

<!-- <?php if ($categoryId !== '') { ?>
    <a
        href="<?= base_url('/') ?>"
        class="clear-filter"
        title="<?= lang('clear_the_filter') ?>"
    >
        <span class="d-none d-sm-inline">
            <?= lang('clear_the_filter') ?>
        </span>
        <i class="fa fa-times" aria-hidden="true"></i>
    </a>
<?php } ?> -->

<a href="javascript:void(0)" id="show-xs-nav" class="d-block d-sm-none">
    <span class="show-sp">
        <?= lang('showXsNav') ?><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
    </span>
    <span class="hidde-sp">
        <?= lang('hideXsNav') ?><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
    </span>
</a>

<div class="categories">
    <?php if (!empty($categoryTree)) { ?>
        <?php $renderCategories($categoryTree); ?>
    <?php } else { ?>
        <div class="alert alert-info"><?= lang('no_sub_categories') ?></div>
    <?php } ?>
</div>