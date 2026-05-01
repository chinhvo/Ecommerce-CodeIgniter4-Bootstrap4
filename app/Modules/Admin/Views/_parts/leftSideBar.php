<?php if (session()->get('logged_in')) { ?>
    <!-- Sidebar -->
    <div class="col-12 col-sm-3 col-lg-2 bg-light border-right left-side">

        <div class="show-menu mb-3">
            <a id="show-xs-nav" class="d-sm-none" href="javascript:void(0)">
                <span class="show-sp">
                    <?= lang('show_menu') ?> <i class="fa fa-arrow-circle-o-down"></i>
                </span>
                <span class="hidde-sp">
                    <?= lang('hide_menu') ?> <i class="fa fa-arrow-circle-o-up"></i>
                </span>
            </a>
        </div>

        <!-- Sidebar menu -->
        <ul class="list-unstyled sidebar-menu">

            <!-- Search -->
            <li class="sidebar-search mb-3">
                <form method="GET" action="<?= base_url('admin/products') ?>">
                    <div class="input-group">
                        <input
                            class="form-control"
                            name="search_title"
                            type="text"
                            value="<?= isset($_GET['search_title']) ? htmlspecialchars($_GET['search_title']) : '' ?>"
                            placeholder="<?= lang('search_in_products') ?>...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </li>

            <!-- Ecommerce -->
            <li class="font-weight-bold text-uppercase small text-muted"><?= lang('ECOMMERCE') ?></li>

            <li>
                <a href="<?= base_url('admin/products') ?>" class="<?= urldecode(uri_string()) == 'admin/products' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-files-o"></i> <?= lang('products') ?>
                </a>
            </li>

            <?php if ($showBrands == 1) { ?>
                <li>
                    <a href="<?= base_url('admin/brands') ?>" class="<?= urldecode(uri_string()) == 'admin/brands' ? 'active font-weight-bold' : '' ?>">
                        <i class="fa fa-registered"></i> <?= lang('brands') ?>
                    </a>
                </li>
            <?php } ?>

            <li>
                <a href="<?= base_url('admin/shopcategories') ?>" class="<?= urldecode(uri_string()) == 'admin/shopcategories' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-list-alt"></i> <?= lang('shop_categories') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/orders') ?>" class="<?= urldecode(uri_string()) == 'admin/orders' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-money"></i> <?= lang('orders') ?>
                    <?php if ($numNotPreviewOrders > 0) { ?>
                        <img src="<?= base_url('assets/imgs/exlamation-hi.png') ?>" style="position: absolute; right: 10px; top: 7px;" alt="">
                    <?php } ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/discounts') ?>" class="<?= urldecode(uri_string()) == 'admin/discounts' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-percent"></i> <?= lang('discount_codes') ?>
                </a>
            </li>

            <!-- Blog -->
            <?php if (in_array('blog', $activePages)) { ?>
                <li class="font-weight-bold text-uppercase small text-muted mt-3"><?= lang('blog') ?></li>

                <li>
                    <a href="<?= base_url('admin/blog') ?>" class="<?= urldecode(uri_string()) == 'admin/blog' ? 'active font-weight-bold' : '' ?>">
                        <i class="fa fa-th"></i> <?= lang('posts') ?>
                    </a>
                </li>
            <?php } ?>

            <!-- Textual Pages -->
            <?php
            if (! empty($textualPages)) {
                foreach ($nonDynPages as $nonDynPage) {
                    if (($key = array_search($nonDynPage, $textualPages)) !== false) {
                        unset($textualPages[$key]);
                    }
                }
            ?>
                <li class="font-weight-bold text-uppercase small text-muted mt-3"><?= lang('TEXTUAL_PAGES') ?></li>

                <?php foreach ($textualPages as $textualPage) { ?>
                    <li>
                        <a href="<?= base_url('admin/pageedit/' . $textualPage) ?>" class="<?= strpos(urldecode(uri_string()), $textualPage) ? 'active font-weight-bold' : '' ?>">
                            <i class="fa fa-edit"></i> <?= strtoupper($textualPage) ?>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>

            <!-- Settings -->
            <li class="font-weight-bold text-uppercase small text-muted mt-3"><?= lang('SETTINGS') ?></li>

            <li>
                <a href="<?= base_url('admin/settings') ?>" class="<?= urldecode(uri_string()) == 'admin/settings' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-wrench"></i> <?= lang('SETTINGS') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/sliders') ?>" class="<?= strpos(urldecode(uri_string()), 'admin/sliders') !== false ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-picture-o"></i> <?= lang('sliders') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/showrooms') ?>" class="<?= strpos(urldecode(uri_string()), 'admin/showrooms') !== false ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-building"></i> <?= lang('showrooms') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/styling') ?>" class="<?= urldecode(uri_string()) == 'admin/styling' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-laptop"></i> <?= lang('styling') ?>
                </a>
            </li>

            <!-- <li>
                <a href="<?= base_url('admin/templates') ?>" class="<?= urldecode(uri_string()) == 'admin/templates' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-binoculars"></i> <?= lang('templates') ?>
                </a>
            </li> -->

            <li>
                <a href="<?= base_url('admin/titles') ?>" class="<?= urldecode(uri_string()) == 'admin/titles' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-font"></i> <?= lang('titles_/_descriptions') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/pages') ?>" class="<?= urldecode(uri_string()) == 'admin/pages' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-file"></i> <?= lang('active_pages') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/emails') ?>" class="<?= urldecode(uri_string()) == 'admin/emails' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-envelope-o"></i> <?= lang('subscribed_emails') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/history') ?>" class="<?= urldecode(uri_string()) == 'admin/history' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-history"></i> <?= lang('activity_history') ?>
                </a>
            </li>

            <!-- Advanced Settings -->
            <li class="font-weight-bold text-uppercase small text-muted mt-3"><?= lang('ADVANCED_SETTINGS') ?></li>

            <li>
                <a href="<?= base_url('admin/languages') ?>" class="<?= urldecode(uri_string()) == 'admin/languages' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-globe"></i> <?= lang('languages') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/filemanager') ?>" class="<?= urldecode(uri_string()) == 'admin/filemanager' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-file-code-o"></i> <?= lang('file_manager') ?>
                </a>
            </li>

            <li>
                <a href="<?= base_url('admin/adminusers') ?>" class="<?= urldecode(uri_string()) == 'admin/adminusers' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-user"></i> <?= lang('admin_users') ?>
                </a>
            </li>

            <!-- Vendors -->
            <li class="font-weight-bold text-uppercase small text-muted mt-3"><?= lang('VENDORS') ?></li>

            <li>
                <a href="<?= base_url('admin/listvendors') ?>" class="<?= urldecode(uri_string()) == 'admin/listvendors' ? 'active font-weight-bold' : '' ?>">
                    <i class="fa fa-user"></i> <?= lang('list_vendors') ?>
                </a>
            </li>

        </ul>
    </div>

    <!-- Main content -->
    <div class="col-12 col-sm-9 col-lg-10">
        <?php if ($warnings != null) { ?>
            <div class="alert alert-danger mt-3">
                <i class="fa fa-exclamation-triangle"></i>
                <?= lang('there_are_some_errors_that_you_must_fix') ?>!
                <ol>
                    <?php foreach ($warnings as $warning) { ?>
                        <li><?= $warning ?></li>
                    <?php } ?>
                </ol>
            </div>
        <?php } ?>
    </div>
<?php } ?>