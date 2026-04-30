<!DOCTYPE html>
<html lang="<?= MY_LANGUAGE_ABBR ?>">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?= $description ?>" />
    <meta name="keywords" content="<?= $keywords ?>" />
    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:url" content="<?= LANG_URL ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?= isset($image) && !is_null($image) ? $image : base_url('assets/img/site-overview.png') ?>" />
    <title><?= $title ?></title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-select/css/bootstrap-select.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap4-toggle.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/flexslider.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('templatecss/custom.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/products.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('cssloader/theme.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/back-to-top.css') ?>" rel="stylesheet" />

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('loadlanguage/all.js') ?>"></script>

    <!-- <?php if ($cookieLaw != false) { ?>
        <script type="text/javascript">
            window.cookieconsent_options = {
                "message": "<?= $cookieLaw['message'] ?>",
                "dismiss": "<?= $cookieLaw['button_text'] ?>",
                "learnMore": "<?= $cookieLaw['learn_more'] ?>",
                "link": "<?= $cookieLaw['link'] ?>",
                "theme": "<?= $cookieLaw['theme'] ?>"
            };
        </script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
    <?php } ?> -->

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Mobile off-canvas drawer -->
    <div id="mobile-overlay" class="mobile-overlay"></div>
    <nav id="mobile-drawer" class="mobile-drawer">
        <button id="mobile-drawer-close" class="mobile-drawer-close" aria-label="Đóng">&times;</button>
        <ul class="mobile-drawer-nav">
            <li><a href="<?= base_url() ?>">Trang chủ</a></li>
            <?php if (!empty($nav_categories)) { ?>
                <?php foreach ($nav_categories as $category) { ?>
                    <li><a href="<?= base_url('?category=' . rawurlencode((string) ($category['slug'] ?? $category['id']))) ?>"><?php if (! empty($category['icon'])) { ?><i class="<?= esc($category['icon']) ?>" aria-hidden="true"></i> <?php } ?><?= esc($category['name']) ?></a></li>
                <?php } ?>
            <?php } ?>
            <li><a href="<?= base_url('blog') ?>">Blog</a></li>
            <li><a href="<?= base_url('contacts') ?>">Liên hệ</a></li>
        </ul>
    </nav>

    <div id="wrapper">
        <div id="content">
            <?= $this->include('_parts/header') ?>
            <div class="container-fluid">
                <div class="row">
                    <?= $this->include('_parts/topMenu') ?>
                    <?php $currentUri = trim(uri_string(), '/'); ?>
                    <?php if (strpos($currentUri, 'home') !== false || $currentUri === '') { ?>
                        <?= $this->renderSection('home') ?>
                    <?php } ?>
                    <?php if (strpos($currentUri, 'shopping-cart') !== false) { ?>
                        <?= $this->renderSection('shopping-cart') ?>
                    <?php } ?>
                    <?php if (strpos($currentUri, 'product') !== false) { ?>
                        <?= $this->renderSection('product-detail') ?>
                    <?php } ?>
                    <?php if (strpos($currentUri, 'checkout') !== false) { ?>
                        <?= $this->renderSection('checkout') ?>
                    <?php } ?>
                    <?php if (strpos($currentUri, 'blog') !== false) { ?>
                        <?= $this->renderSection('blog') ?>
                    <?php } ?>
                    <?php if (strpos($currentUri, 'contacts') !== false) { ?>
                        <?= $this->renderSection('contacts') ?>
                    <?php } ?>
                    <?= $this->include('_parts/brands') ?>
                </div>
                <div class="row">
                    <?= $this->include('_parts/categories') ?>
                </div>
                <div class="row">
                    <?= $this->include('_parts/bodyFooter') ?>
                </div>
            </div>
        </div>
        <?= $this->include('_parts/footer') ?>
    </div>

    <?php if (session()->getFlashdata('emailAdded')) { ?>
        <script>
            $(document).ready(function() {
                ShowNotificator('alert-info', '<?= lang('email_added') ?>');
            });
        </script>
    <?php } ?>

    <?= $addJs ?>

    <div id="notificator" class="alert"></div>
    <div id="back-to-top" class="scrollup" title="Lên đầu trang">
        <i class="fa fa-chevron-up"></i>
    </div>

    <script src="<?= base_url('assets/bootstrap-select/js/bootstrap-select.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap4-toggle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootbox.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/flexslider.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/zxcvbn.js') ?>"></script>
    <script src="<?= base_url('assets/js/zxcvbn_bootstrap3.js') ?>"></script>
    <script src="<?= base_url('assets/js/pGenerator.jquery.js') ?>"></script>
    <script src="<?= base_url('assets/js/back-to-top.js') ?>"></script>

    <script>
        var variable = {
            clearShoppingCartUrl: "<?= base_url('clearShoppingCart') ?>",
            manageShoppingCartUrl: "<?= base_url('manageShoppingCart') ?>",
            discountCodeChecker: "<?= base_url('discountCodeChecker') ?>"
        };
    </script>
    <script src="<?= base_url('assets/js/system.js') ?>"></script>
    <script src="<?= base_url('templatejs/mine.js') ?>"></script>
    <script>
        $(document).on('click', '#m-nav', function(e) {
            e.preventDefault();
            $('#mobile-drawer').addClass('open');
            $('#mobile-overlay').addClass('open');
            $('body').css('overflow', 'hidden');
        });

        $(document).on('click', '#mobile-drawer-close, #mobile-overlay', function() {
            $('#mobile-drawer').removeClass('open');
            $('#mobile-overlay').removeClass('open');
            $('body').css('overflow', '');
        });
    </script>
</body>

</html>