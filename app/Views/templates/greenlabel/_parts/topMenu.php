<div class="container">
    <div class="row">
        <div class="col-md-7 offset-md-4 col-sm-10 col-10">
            <div class="bottom mainmenu">
                <nav>
                    <div class="navbar-header">
                        <span class="d-block d-sm-none menu-text-xs"><?= lang('menu') ?></span>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li<?= uri_string() == '' || uri_string() == MY_LANGUAGE_ABBR ? ' class="active"' : '' ?>><a href="<?= LANG_URL ?>"><?= lang('home') ?></a></li>
                            <li<?= uri_string() == 'shop' || uri_string() == MY_LANGUAGE_ABBR . '/shop' ? ' class="active"' : '' ?>><a href="<?= LANG_URL . '/shop' ?>"><?= lang('shop') ?> <i class="fa fa-chevron-down"></i></a>
                                <div class="megamenu">
                                    <?php

                                    function loop_tree_nav($nav_categories, $is_recursion = false)
                                    {
                                        if ($is_recursion == false) {
                                            ?>
                                            <span>
                                                <?php
                                            }
                                            foreach ($nav_categories as $nav_category) {
                                                $children = false;
                                                if (isset($nav_category['children']) && !empty($nav_category['children'])) {
                                                    $children = true;
                                                }
                                                ?> 
                                                <a href="javascript:void(0);" data-categorie-id="<?= $nav_category['id'] ?>" class="go-category <?= $children == true ? 'mega-title' : '' ?>"><?= htmlspecialchars($nav_category['name'], ENT_QUOTES, 'UTF-8') ?></a>
                                                <?php
                                                if ($children === true) {
                                                    loop_tree_nav($nav_category['children'], true);
                                                }
                                            }
                                            if ($is_recursion == false) {
                                                ?>
                                            </span>
                                            <?php
                                        }
                                    }

                                    loop_tree_nav($nav_categories);
                                    ?>
                                </div>
                            </li>
                            <?php
                            if (!empty($nonDynPages)) {
                                foreach ($nonDynPages as $addonPage) {
                                    ?>
                                    <li<?= uri_string() == $addonPage || uri_string() == MY_LANGUAGE_ABBR . '/' . $addonPage ? ' class="active"' : '' ?>><a href="<?= LANG_URL . '/' . $addonPage ?>"><?= mb_ucfirst(lang($addonPage)) ?></a></li>
                                    <?php
                                }
                            }
                            if (!empty($dynPages)) {
                                foreach ($dynPages as $addonPage) {
                                    ?>
                                    <li<?= urldecode(uri_string()) == 'page/' . $addonPage['pname'] || uri_string() == MY_LANGUAGE_ABBR . '/' . 'page/' . $addonPage['pname'] ? ' class="active"' : ''
                                    ?>><a href="<?= LANG_URL . '/page/' . $addonPage['pname'] ?>"><?= mb_ucfirst($addonPage['lname']) ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            <li<?= uri_string() == 'checkout' || uri_string() == MY_LANGUAGE_ABBR . '/checkout' ? ' class="active"' : '' ?>><a href="<?= LANG_URL . '/checkout' ?>"><?= lang('checkout') ?></a></li>
                            <li<?= uri_string() == 'shopping-cart' || uri_string() == MY_LANGUAGE_ABBR . '/shopping-cart' ? ' class="active"' : '' ?>><a href="<?= LANG_URL . '/shopping-cart' ?>"><?= lang('shopping_cart') ?></a></li>
                            <li<?= uri_string() == 'contacts' || uri_string() == MY_LANGUAGE_ABBR . '/contacts' ? ' class="active"' : '' ?>><a href="<?= LANG_URL . '/contacts' ?>"><?= lang('contacts') ?></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>