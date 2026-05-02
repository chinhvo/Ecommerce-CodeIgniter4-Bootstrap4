<?= $this->extend('_parts/layout') ?>
<?= $this->section('blog') ?>
<div id="blog" class="body">
    <div class="row bottom-30 eqHeight">
        <div class="col-sm-4 col-md-2">
            <div class="blog-home-left-categ">
                <?= $archives ?>
            </div>
            <div id="search-input-blog">
                <div class="w-100">
                    <form method="POST" action="<?= LANG_URL . '/blog' ?>" class="mb-3">
                        <?= csrf_field() ?>
                        <?php
                        $fromVal = request()->getPost('from') ?? request()->getGet('from') ?? '';
                        $toVal   = request()->getPost('to')   ?? request()->getGet('to')   ?? '';
                        ?>
                        <?php if ($fromVal !== '' && $toVal !== ''): ?>
                            <input type="hidden" name="from" value="<?= (int) $fromVal ?>" />
                            <input type="hidden" name="to" value="<?= (int) $toVal ?>" />
                        <?php endif; ?>
                        <div class="form-group mb-2">
                            <select class="search-query form-control" name="type" onchange="this.form.submit()">
                                <option value=""><?= lang('all_blog_types') ?></option>
                                <?php foreach ($blogTypes as $typeId => $typeLabel): ?>
                                    <option value="<?= (int) $typeId ?>" <?= isset($selectedBlogType) && (int) $selectedBlogType === (int) $typeId ? 'selected' : '' ?>>
                                        <?= esc($typeLabel) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" class="search-query form-control" value="<?= esc(request()->getPost('find') ?? request()->getGet('find') ?? '') ?>" name="find" placeholder="<?= lang('search') ?>" />
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?= $this->include('_parts/blog_best_sellers') ?>
        </div>
        <div class="col-sm-8 col-md-10">
            <div class="alone title cloth-bg-color">
                <span><?= lang('latest_blog') ?></span>
            </div>
            <div class="row blog-posts-grid">
                <?php
                if (!empty($posts)) {
                    foreach ($posts as $post) {
                ?>
                        <div class="blog-col mb-4 d-flex">
                            <div class="card blog-list blog-card h-100 shadow-sm w-100 mx-auto">
                                <a href="<?= LANG_URL . '/blog/' . $post['url'] ?>" class="d-block">
                                    <img src="<?= base_url('attachments/blog_images/' . $post['image']) ?>" class="card-img-top blog-card-img" alt="<?= $post['title'] ?>">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">
                                        <?= character_limiter($post['title'], 60) ?>
                                    </h6>
                                    <small class="text-muted d-block mb-1">
                                        <span>
                                            <i class="fa fa-clock-o"></i>
                                            <?= date('M d, y', $post['time']) ?>
                                        </span>
                                    </small>
                                    <p class="card-text description mb-1"><?= character_limiter(strip_tags($post['description']), 120) ?></p>
                                    <div class="mt-auto text-right">
                                        <a href="<?= LANG_URL . '/blog/' . $post['url'] ?>">
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