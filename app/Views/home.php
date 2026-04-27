<?= $this->extend('_parts/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid body">
    <?= $this->include('_parts/top_slider') ?>
    <div class="row content">
        <?= $this->include('_parts/highlighted_product') ?>
        <?= $this->include('_parts/news') ?>
    </div>
    <?= $this->include('_parts/product_grid') ?>
    <?= $this->include('_parts/categories') ?>
    <?= $this->include('_parts/brands') ?> 
    <?= $this->include('_parts/bodyFooter') ?>
</div>

<?= $this->endSection() ?>
