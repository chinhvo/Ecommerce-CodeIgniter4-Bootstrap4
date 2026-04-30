<?php
$renderTopCategories = function (array $categories) {
    foreach ($categories as $category) {
        $children = $category['children'] ?? [];
        $hasChildren = ! empty($children);
        $categorySlug = rawurlencode((string) ($category['slug'] ?? $category['id']));
        $link = base_url('?category=' . $categorySlug);
        $name = esc($category['name'] ?? '');
        $icon = ! empty($category['icon']) ? esc($category['icon']) : null;
?>
        <li class="nav-item <?= $hasChildren ? 'dropdown' : '' ?>">
            <a
                class="nav-link <?= $hasChildren ? 'dropdown-toggle' : '' ?>"
                href="<?= $link ?>"
                <?= $hasChildren ? 'id="category_' . (int) $category['id'] . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '' ?>>
                <?php if ($icon !== null) { ?>
                    <i class="<?= $icon ?>" aria-hidden="true"></i>
                <?php } ?>
                <?= $name ?>
            </a>

            <?php if ($hasChildren) { ?>
                <div class="dropdown-menu grouped-dropdown" aria-labelledby="category_<?= (int) $category['id'] ?>">
                    <div class="grouped-grid">
                        <?php foreach ($children as $childGroup) { ?>
                            <?php
                            $groupName = esc($childGroup['name'] ?? '');
                            $groupSlug = rawurlencode((string) ($childGroup['slug'] ?? $childGroup['id']));
                            $groupLink = base_url('?category=' . $groupSlug);
                            $groupChildren = $childGroup['children'] ?? [];
                            $groupIcon = ! empty($childGroup['icon']) ? esc($childGroup['icon']) : 'fa fa-folder-open-o';
                            ?>
                            <div class="menu-group">
                                <a class="dropdown-item menu-group-title" href="<?= $groupLink ?>">
                                    <i class="<?= $groupIcon ?>" aria-hidden="true"></i>
                                    <?= $groupName ?>
                                </a>

                                <?php if (! empty($groupChildren)) { ?>
                                    <?php foreach ($groupChildren as $leaf) { ?>
                                        <a class="dropdown-item menu-leaf" href="<?= base_url('?category=' . rawurlencode((string) ($leaf['slug'] ?? $leaf['id']))) ?>">
                                            <?= esc($leaf['name'] ?? '') ?>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </li>
<?php
    }
};
?>

<link href="<?= base_url('templatecss/top-menu.css') ?>" rel="stylesheet">

<div class="col-12 px-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom top-shop-menu">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#shopTopMenu" aria-controls="shopTopMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="shopTopMenu">
                <ul class="navbar-nav mr-auto w-100">
                    <li class="nav-item <?= uri_string() === '' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url() ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <?= lang('home') ?>
                        </a>
                    </li>

                    <?php if (! empty($nav_categories)) {
                        $renderTopCategories($nav_categories);
                    } ?>

                    <?php if (in_array('blog', $nonDynPages ?? [], true)) { ?>
                        <li class="nav-item <?= strpos(uri_string(), 'blog') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('blog') ?>">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                <?= lang('blog') ?>
                            </a>
                        </li>
                    <?php } ?>

                    <li class="nav-item <?= strpos(uri_string(), 'contacts') !== false ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('contacts') ?>">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <?= lang('contacts') ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>