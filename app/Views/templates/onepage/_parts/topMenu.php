<nav class="navbar navbar-onepoge navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="<?= LANG_URL ?>">
                        <img src="<?= base_url('template/imgs/logo.png') ?>" class="animated bounce" alt="">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse"> 
                    <ul class="nav navbar-nav navbar-right animated fadeInRight">
                        <li><a href="<?= LANG_URL ?>"><?= lang('home') ?></a></li>
                        <li><a href="<?= LANG_URL . '/checkout' ?>"><?= lang('checkout') ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
