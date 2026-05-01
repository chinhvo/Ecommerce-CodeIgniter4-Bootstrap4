<?= $this->extend('_parts/layout') ?>
<?= $this->section('blog') ?>
<div id="blog" class="body">
    <div class="row bottom-30 eqHeight">
        <div class="col-sm-4 col-md-3">
            <div class="blog-home-left-categ">
                <?= $archives ?>
            </div>
            <div id="search-input-blog">
                <div class="w-100">
                    <form method="GET" action="" class="mb-3">
                        <?php if (isset($_GET['from'], $_GET['to'])): ?>
                            <input type="hidden" name="from" value="<?= (int) $_GET['from'] ?>" />
                            <input type="hidden" name="to" value="<?= (int) $_GET['to'] ?>" />
                        <?php endif; ?>
                        <div class="form-group mb-2">
                            <select class="search-query form-control" name="type">
                                <option value=""><?= lang('all_blog_types') ?></option>
                                <?php foreach ($blogTypes as $typeId => $typeLabel): ?>
                                    <option value="<?= (int) $typeId ?>" <?= isset($selectedBlogType) && (int) $selectedBlogType === (int) $typeId ? 'selected' : '' ?>>
                                        <?= esc($typeLabel) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" class="search-query form-control" value="<?= isset($_GET['find']) ? htmlspecialchars($_GET['find']) : '' ?>" name="find" placeholder="<?= lang('search') ?>" />
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="filter-sidebar">
                <div class="title cloth-bg-color">
                    <span><?= lang('best_sellers') ?></span>
                </div>
                <?= $load::getProducts($bestSellers, '', true) ?>
            </div>
        </div>
        <div class="col-sm-8 col-md-9">
            <div class="alone title cloth-bg-color">
                <span><?= lang('latest_blog') ?></span>
            </div>
            <div class="row">
                <?php
                if (!empty($posts)) {
                    foreach ($posts as $post) {
                ?>
                        <div class="col-sm-6 col-md-6 col-lg-4 blog-col mb-4 d-flex">
                            <div class="card blog-list blog-card h-100 shadow-sm w-100 mx-auto">
                                <a href="<?= LANG_URL . '/blog/' . $post['url'] ?>" class="d-block">
                                    <img src="<?= base_url('attachments/blog_images/' . $post['image']) ?>" class="card-img-top blog-card-img" alt="<?= $post['title'] ?>">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        <?= character_limiter($post['title'], 60) ?>
                                    </h5>
                                    <small class="text-muted d-block mb-2">
                                        <span>
                                            <i class="fa fa-clock-o"></i>
                                            <?= date('M d, y', $post['time']) ?>
                                        </span>
                                    </small>
                                    <p class="card-text description mb-2"><?= character_limiter(strip_tags($post['description']), 120) ?></p>
                                    <div class="mt-auto text-right">
                                        <a class="btn btn-primary" href="<?= LANG_URL . '/blog/' . $post['url'] ?>">
                                            <i class="fa fa-long-arrow-right"></i>
                                            <?= lang('read_mode') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="col-12">
                        <div class="alert alert-info mb-0"><?= lang('no_posts') ?></div>
                    </div>
                <?php } ?>
            </div>
            <?= $links_pagination ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>