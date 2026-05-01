<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('contact_messages') ?>
<div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
    <h1 class="mb-2">
        <img src="<?= base_url('assets/imgs/email.png') ?>" class="header-img" alt=""> <?= lang('contact_messages_title') ?>
    </h1>

    <p class="text-muted"><?= lang('contact_messages_desc') ?></p>
    <hr>

    <?php if (session()->getFlashdata('contactMessageDeleted')) { ?>
        <div class="alert alert-info"><?= session()->getFlashdata('contactMessageDeleted') ?></div>
        <hr>
    <?php } ?>

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped custab">
            <thead>
                <tr>
                    <th><?= lang('col_name') ?></th>
                    <th><?= lang('col_email') ?></th>
                    <th><?= lang('subject') ?></th>
                    <th><?= lang('message') ?></th>
                    <th><?= lang('col_ip') ?></th>
                    <th><?= lang('col_time') ?></th>
                    <th style="width: 100px;"><?= lang('col_action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)) { ?>
                    <?php foreach ($messages as $row) { ?>
                        <tr>
                            <td><?= esc($row['name']) ?></td>
                            <td><?= esc($row['email']) ?></td>
                            <td><?= esc($row['subject']) ?></td>
                            <td style="min-width: 280px;"><?= nl2br(esc($row['message'])) ?></td>
                            <td><?= esc($row['ip_address'] ?? '-') ?></td>
                            <td><?= esc((string) ($row['created_at'] ?? '')) ?></td>
                            <td>
                                <a href="<?= site_url('admin/contact-messages?delete=' . $row['id']) ?>" class="btn btn-sm btn-danger confirm-delete">
                                    <?= lang('products_delete_button') ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7" class="text-center"><?= lang('contact_messages_empty') ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?= $links_pagination ?>
</div>
<?= $this->endSection() ?>