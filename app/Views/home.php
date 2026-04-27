<?= $this->extend('_parts/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid body">
    <?= $this->include('_parts/hero_slider') ?>
    <?= $this->include('_parts/product_grid') ?>
    <?= $this->include('_parts/categories') ?>
    <?= $this->include('_parts/brands') ?> 
    <?= $this->include('_parts/bodyFooter') ?>
</div>

<?= $this->endSection() ?>
