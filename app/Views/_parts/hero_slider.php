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
                <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($sliderProducts as $article) {
                    ?>
                        <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
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
                            <img src="<?= $productImage ?>" alt="<?= htmlentities($article['title']) ?>" class="d-block w-100">
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#home-slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#home-slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            </section>
        </section>
    </div>
<?php } ?>
