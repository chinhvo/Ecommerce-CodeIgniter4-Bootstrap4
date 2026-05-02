<?= $this->extend('_parts/layout') ?>
<?= $this->section('blog') ?>
<div class="container blog-inner">
    <div class="body">
        <div class="row bottom-30">
            <div class="col-12 col-md-3 left-col-archive mb-3 mb-md-0">
                <?= $archives ?>
                <a href="<?= LANG_URL . '/blog' ?>" class="btn btn-secondary"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> <?= lang('go_back') ?></a>
            </div>
            <div class="col-12 col-md-9">
                <h1><?= $article['title'] ?></h1>
                <span class="blog-preview-time">
                    <i class="fa fa-clock-o"></i>
                    <?= date('M d, y', $article['time']) ?>
                </span>
                <figure class="blog-detail-thumb mb-3">
                    <img class="img-fluid w-100" src="<?= base_url('attachments/blog_images/' . $article['image']) ?>" alt="<?= $article['title'] ?>">
                </figure>
                <div class="blog-description">
                    <?= $article['description'] ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>