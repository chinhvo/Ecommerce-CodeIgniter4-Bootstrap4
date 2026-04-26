<!DOCTYPE html>
<html lang="<?= MY_LANGUAGE_ABBR ?>">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?= $description ?>">
        <meta name="keywords" content="<?= $keywords ?>" />
        <meta property="og:title" content="<?= $title ?>" />
        <meta property="og:description" content="<?= $description ?>" />
        <meta property="og:url" content="<?= LANG_URL ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?= isset($image) && !is_null($image) ? $image : base_url('assets/img/site-overview.png') ?>" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
        <link href="<?= base_url('assets/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('templatecss/custom.css?v1') ?>" rel="stylesheet" />
        <link href="<?= base_url('cssloader/theme.css') ?>" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url('assets/templates/onepage/css/animate.css') ?>" />
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?= base_url('loadlanguage/all.js') ?>"></script>
        <?php if ($cookieLaw != false) { ?>
            <script type="text/javascript">
                window.cookieconsent_options = {"message": "<?= $cookieLaw['message'] ?>", "dismiss": "<?= $cookieLaw['button_text'] ?>", "learnMore": "<?= $cookieLaw['learn_more'] ?>", "link": "<?= $cookieLaw['link'] ?>", "theme": "<?= $cookieLaw['theme'] ?>"};
            </script>
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
        <?php } ?>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <a style="display:none !important;" id="kk-refer-gh" href="https://github.com/kirilkirkov">Kiril Kirkov</a>
        <?= $this->include('templates/onepage/_parts/header') ?>
        <?= $this->include('templates/onepage/_parts/topMenu') ?>

        <?= $this->renderSection('content') ?>

        <div id="notificator" class="alert"></div>
        <?= $this->include('templates/onepage/_parts/footer') ?>

        <?php if (session()->getFlashdata('emailAdded')) { ?>
        <script>
            $(document).ready(function () {
                ShowNotificator('alert-info', '<?= lang('email_added') ?>');
            });
        </script>
        <?php
        }
        echo $addJs ?? '';
        ?>
        <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/placeholders.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
        <script>
        var variable = {
            clearShoppingCartUrl: "<?= base_url('clearShoppingCart') ?>",
            manageShoppingCartUrl: "<?= base_url('manageShoppingCart') ?>",
            discountCodeChecker: "<?= base_url('discountCodeChecker') ?>"
        };
        </script>
        <script src="<?= base_url('assets/js/system.js') ?>"></script>
        <script src="<?= base_url('templatejs/jquery.visible.min.js') ?>"></script>
        <script src="<?= base_url('templatejs/mine.js') ?>"></script>
    </body>
</html>