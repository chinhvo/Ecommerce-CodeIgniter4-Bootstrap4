<style>
    body {
        background-image:url('<?php echo base_url('assets/imgs/login-bg.png') ?>');
        background-position: bottom  right;
        background-repeat: no-repeat;
        background-color:#548fd0;
    }
    .avatar {background-image:url('<?php echo base_url('assets/imgs/login-cover.png') ?>')}
</style>
<div class="container">
    <div class="login-container">
        <div id="output">       
            <?php
            if (session()->getFlashdata('err_login')) {
                ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('err_login') ?></div>
                <?php
            }
            ?></div>
        <div class="avatar"></div>
        <div class="form-box">
            <form action="<?= base_url() ?>admin/login" method="POST">
                <input type="text" name="username" placeholder="<?= lang('username') ?>">
                <input type="password" name="password" placeholder="<?= lang('password') ?>">
                <button class="btn btn-info btn-block login" type="submit"><?= lang('login') ?></button>
            </form>
        </div>
    </div>
</div>