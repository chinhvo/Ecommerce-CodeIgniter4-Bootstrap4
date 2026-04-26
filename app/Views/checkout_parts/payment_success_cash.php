<?= $this->extend('_parts/layout') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="body">
        <?= purchase_steps(1, 2, 3) ?>
        <div class="alert alert-success"><?= lang('c_o_d_order_completed') ?></div>
    </div>
</div>
<?= $this->endSection() ?>