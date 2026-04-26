<?= $this->extend('templates/redlabel/_parts/layout') ?>
<?= $this->section('content') ?>
<?php
?>
<div id="dynPage">
    <div class="top-bg">

    </div>
    <div class="container">
        <div class="text-content">
            <?= $content ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>