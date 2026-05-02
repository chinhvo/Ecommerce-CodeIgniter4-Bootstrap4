<?= $this->extend('_parts/layout') ?>
<?= $this->section('checkout') ?>
<div class="container">
    <div class="body">
        <?= purchase_steps(1, 2, 3) ?>
        <div class="alert alert-success"><?= lang('paypal_success_msg') ?></div>
    </div>
</div>
<?= $this->endSection() ?>