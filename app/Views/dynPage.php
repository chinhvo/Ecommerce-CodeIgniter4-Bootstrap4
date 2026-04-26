<?= $this->extend('_parts/layout') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="body">
        <div class="dynPage bottom-30">
            <div class="text-content">
                <?= $content ?>
            </div>
        </div>
        <?php include 'bodyFooter.php' ?>
    </div>
</div>
<?= $this->endSection() ?>