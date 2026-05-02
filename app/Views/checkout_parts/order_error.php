<?= $this->extend('_parts/layout') ?>
<?= $this->section('checkout') ?>
<div class="container">
    <div class="body">
        <div class="alert alert-danger"><?= lang('there_is_payment_error') ?></div>
    </div>
</div>
<?= $this->endSection() ?>