<?= $this->extend('_parts/layout') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="body">
        <div class="alert alert-success"><?= lang('paypal_cancel_msg') ?></div>
    </div>
</div>
<?= $this->endSection() ?>