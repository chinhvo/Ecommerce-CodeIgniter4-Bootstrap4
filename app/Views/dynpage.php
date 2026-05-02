<?= $this->extend('_parts/layout') ?>
<?= $this->section('dyn-page') ?>
<div class="container">
    <div class="body">
        <div class="dynPage bottom-30">
            <div class="text-content">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>