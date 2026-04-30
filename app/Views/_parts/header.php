<header>
    <?php if (!empty($multiVendor) && $multiVendor == 1): ?>
        <div id="top-user-panel">
            <div class="container">
                <a href="<?= LANG_URL . '/vendor/register' ?>" class="btn btn-secondary"><?= lang('register_me') ?></a>
                <form class="form-inline" method="POST" action="<?= LANG_URL . '/vendor/login' ?>">
                    <div class="form-group">
                        <input type="email" name="u_email" class="form-control" placeholder="<?= lang('email') ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" name="u_password" class="form-control" placeholder="<?= lang('password') ?>">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember_me"> <?= lang('remember_me') ?></label>
                    </div>
                    <button type="submit" name="login" class="btn btn-secondary"><?= lang('u_login') ?></button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="container-fluid">
        <div id="menuHeader" class="row menu-header-row align-items-center">
            <div class="col-12 col-md-3 logo-col d-flex align-items-center">
                <a href="#" id="m-nav" class="btn-mobile-menu d-md-none" aria-label="Menu">
                    <span class="fa fa-bars"></span>
                </a>
                <a title="<?= esc($title ?? $_SERVER['HTTP_HOST']) ?>" href="<?= base_url() ?>" class="logo">
                    <img src="<?= base_url('attachments/site_logo/' . $sitelogo) ?>" class="site-logo" alt="<?= $_SERVER['HTTP_HOST'] ?>">
                </a>
            </div>

            <div class="col-12 col-md-5">
                <div class="search-box">
                    <?php
                    $selectedCategory = trim((string) (request()->getGet('category') ?? ''));
                    $selectedCategoryName = '';

                    if ($selectedCategory !== '' && !empty($all_categories)) {
                        foreach ($all_categories as $category) {
                            $categorySlug = (string) ($category['slug'] ?? $category['id']);
                            if ((string) $category['id'] === $selectedCategory || $categorySlug === $selectedCategory) {
                                $selectedCategoryName = (string) $category['name'];
                                break;
                            }
                        }
                    }
                    ?>
                    <form method="GET" id="bigger-search" class="search" action="<?= LANG_URL ?>">
                        <?php if ($selectedCategory !== '') { ?>
                            <input type="hidden" name="category" value="<?= esc($selectedCategory) ?>">
                        <?php } ?>
                        <div class="input-group">
                            <label for="search_in_title" class="sr-only"><?= lang('search_for') ?></label>
                            <input type="text" id="search_in_title" name="search_in_title" value="<?= isset($_GET['search_in_title']) ? htmlspecialchars($_GET['search_in_title']) : '' ?>" class="form-control search-text-box" placeholder="<?= lang('search_for') ?>...">
                            <span class="input-group-btn">
                                <button class="btn btn-red cloth-bg-color search-button-btn" onclick="submitForm()" type="button">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                        <?php if ($selectedCategory !== '') { ?>
                            <div class="alert alert-info mt-2 mb-0 py-2 d-flex justify-content-between align-items-center" role="alert">
                                <span>
                                    <strong><?= lang('selected_category') ?>:</strong>
                                    <?= esc($selectedCategoryName !== '' ? $selectedCategoryName : $selectedCategory, 'html') ?>
                                </span>
                                <a href="<?= base_url('/') ?>" class="btn btn-sm btn-outline-secondary">
                                    <?= lang('clear_the_filter') ?>
                                </a>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="header-hotline">
                    <a href="tel:18006726">
                        <p class="mb-0">Hotline miễn phí</p>
                        <p class="mb-0"><strong>1800 6726</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-2 text-md-right">
                <a href="tel:18006726" class="btn btn-fodp cloth-bg-color">Đặt mua giá tốt</a>
                <div class="bag-info mt-2">
                    <a class="my-basket dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?= lang('your_basket') ?>
                        <span class="sum-scope">(<span class="sumOfItems"><?php echo !is_array($cartItems) || (!isset($cartItems['array']) || count($cartItems['array'])) < 1 ? lang('empty') : $sumOfItems ?></span>)</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-cart" role="menu">
                        <?= $load::getCartItems(is_array($cartItems) ? $cartItems : []) ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>