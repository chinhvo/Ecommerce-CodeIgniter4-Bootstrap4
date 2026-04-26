<?php if (count($sliderProducts) > 0) { ?>
    <div class="row content row-of-slider">
        <section class="col-md-8 col-sm-12 col-xs-12 border">
            <section class="sidebar-slider">
            <div id="home-slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    $i = 0;
                    while ($i < count($sliderProducts)) {
                    ?>
                        <li data-target="#home-slider" data-slide-to="<?= $i ?>" class="<?= $i == 0 ? 'active' : '' ?>"></li>
                    <?php
                        $i++;
                    }
                    ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php
                    $i = 0;
                    foreach ($sliderProducts as $article) {
                    ?>
                        <div class="item <?= $i == 0 ? 'active' : '' ?>">
                            <div class="absolute-texts">
                                <h1>
                                    <a href="<?= LANG_URL . '/' . $article['url'] ?>">
                                        <?= character_limiter($article['title'], 100) ?>
                                    </a>
                                </h1>
                                <div class="description">
                                    <?= character_limiter(strip_tags($article['basic_description']), 150) ?>
                                </div>
                            </div>
                            <?php
                            $productImage = base_url('/attachments/no-image-frontend.png');
                            if (is_file('attachments/shop_images/' . $article['image'])) {
                                $productImage = base_url('/attachments/shop_images/' . $article['image']);
                            }
                            ?>
                            <img src="<?= $productImage ?>" alt="<?= htmlentities($article['title']) ?>" class="img-responsive">
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
                <div class="controls">
                    <a class="left carousel-control" href="#home-slider" role="button" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left" aria-hidden="true"></i>
                    </a>
                    <a class="right carousel-control" href="#home-slider" role="button" data-slide="next">
                        <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            </section>
        </section>

        <aside class="sidebar-banner sidebar-banner-home col-md-4 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-6 col-xs-12 banner">
                    <a href="<?= base_url('blog') ?>">
                        <div class="banner-item icon-on-left red">
                            <h4>Khuyến mãi!</h4>
                            <p>Mua xe nhận ngay quà khủng</p>
                            <span class="button">Xem</span>
                            <i class="fa fa-star-o banner-icon" aria-hidden="true"></i>
                        </div>
                    </a>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-12 banner">
                    <a href="<?= base_url('checkout') ?>">
                        <div class="banner-item icon-on-left green">
                            <h4>MUA TRẢ GÓP</h4>
                            <p>Áp dụng cho tất cả sản phẩm</p>
                            <span class="button">Xem</span>
                            <i class="fa fa-cc-visa banner-icon" aria-hidden="true"></i>
                        </div>
                    </a>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-12 banner">
                    <?= $load::getProducts($bestSellers, '', true) ?>
                </div>
            </div>
        </aside>
    </div>
<?php } ?>
