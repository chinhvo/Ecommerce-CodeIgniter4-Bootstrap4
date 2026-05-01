<?php if (session()->get('logged_in')) { ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbar" aria-controls="navbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('admin') ?>" class="nav-link">
                            <i class="fa fa-home"></i> <?= lang('home') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>" target="_blank" class="nav-link">
                            <i class="fa fa-star"></i> <?= lang('user_home_page') ?>
                        </a>
                    </li>

                    <!-- Password change dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle h-settings"
                            id="settingsDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-key"></i> <?= lang('pass_change') ?>
                        </a>
                        <div class="dropdown-menu p-3" aria-labelledby="settingsDropdown" style="min-width:300px;">
                            <div class="card border-primary mb-0">
                                <div class="card-header">
                                    <h6 class="mb-0"><?= lang('security') ?></h6>
                                </div>
                                <div class="card-body">
                                    <label><?= lang('change_my_password') ?></label>
                                    <span class="badge badge-success" id="pass_result"><?= lang('changed') ?>!</span>

                                    <form class="form-inline mt-2">
                                        <div class="input-group w-100">
                                            <input type="text" class="form-control new-pass-field"
                                                placeholder="<?= lang('new_password'); ?>" name="new_pass">
                                            <div class="input-group-append">
                                                <button type="button" onclick="changePass()" class="btn btn-primary">
                                                    <?= lang('update'); ?>
                                                </button>
                                            </div>
                                        </div>
                                        <hr class="w-100">
                                        <span><?= lang('password_strength'); ?>:</span>
                                        <div class="progress w-100 mb-2">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary generate-pwd">
                                            <?= lang('generate_password'); ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link"
                            data-toggle="modal" data-target="#modalCalculator">
                            <i class="fa fa-calculator"></i> <?= lang('calculator'); ?>
                        </a>
                    </li>
                </ul>

                <!-- Right side -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('admin/logout') ?>" class="nav-link">
                            <i class="fa fa-sign-out"></i> <?= lang('logout'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php } ?>