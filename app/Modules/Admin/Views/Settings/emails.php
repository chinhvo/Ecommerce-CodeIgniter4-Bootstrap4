<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('emails') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<h1 class="mb-2">
		<img src="<?= base_url('assets/imgs/email.png') ?>" class="header-img"
			style="margin-top: -3px;" alt=""> <?= lang('subscribed_title') ?>
	</h1>

	<p class="text-muted"><?= lang('subscribed_desc') ?></p>
	<hr>

<?php if (session()->getFlashdata('emailDeleted')): ?>
  <div class="alert alert-info">
    <?= session()->getFlashdata('emailDeleted') ?>
  </div>
	<hr>
<?php endif; ?>

<div class="table-responsive">
		<table class="table table-sm table-bordered table-striped custab">
			<thead>
				<tr>
					<th><?= lang('col_email') ?></th>
					<th><?= lang('col_browser') ?></th>
					<th><?= lang('col_ip') ?></th>
					<th><?= lang('col_time') ?></th>
					<th style="width: 100px;"><?= lang('col_action') ?></th>
				</tr>
			</thead>	
			<tbody>
                <?php if (!empty($emails)): ?>
                  <?php foreach ($emails as $email): ?>
                    <tr>
                					<td><?= esc($email['email']) ?></td>
                					<td><?= esc($email['browser']) ?></td>
                					<td><?= esc($email['ip']) ?></td>
                					<td><?= esc(date('Y.m.d / H:i:s', $email['time'])) ?></td>
                					<td><a
                						href="<?= site_url('admin/emails?delete=' . $email['id']) ?>"
                						class="btn btn-sm btn-danger confirm-delete"> Delete </a></td>
                				</tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                					<td colspan="5" class="text-center"><?= lang('no_emails_found') ?></td>
                				</tr>
                <?php endif; ?>
                </tbody>

		</table>
	</div>

<?php if (!empty($emails)): ?>
  <form method="POST" class="mt-2">
		<button type="submit" name="export" class="btn btn-secondary"><?= lang('export') ?></button>
	</form>
<?php endif; ?>

<?= $links_pagination ?>
	
</div>
<?= $this->endSection() ?>