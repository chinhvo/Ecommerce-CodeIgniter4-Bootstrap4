<nav class="navbar gradient-color">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if ($navitext != null) { ?>
                <a class="navbar-brand" href="<?= base_url() ?>"><?= $navitext ?></a>
            <?php } ?>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav" style="<?= $navitext == null ? 'margin-left:-15px;' : '' ?>">
                <li<?= uri_string() == '' || uri_string() == MY_LANGUAGE_ABBR ? ' class="active"' : '' ?>><a href="<?= LANG_URL ?>"><?= lang('home') ?></a></li>
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
    </div>
</nav>