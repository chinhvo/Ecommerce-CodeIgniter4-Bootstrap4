<?= $this->extend('_parts/layout') ?>
<?= $this->section('home') ?>

<div class="container-fluid body">
    <?= $this->include('_parts/top_slider') ?>
    <div class="row content border rounded">
        <?= $this->include('_parts/highlighted_product') ?>
        <?= $this->include('_parts/news') ?>
    </div>
    <?= $this->include('_parts/product_grid') ?>
</div>

<?= $this->endSection() ?>
