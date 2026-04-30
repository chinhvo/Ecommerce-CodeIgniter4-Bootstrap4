<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('history') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<h1 class="mb-3">
		<img src="<?= base_url('assets/imgs/timer.png') ?>" class="header-img"
			style="margin-top: -3px;" alt=""> <?= lang('history') ?>
	</h1>

	<hr>

<?php if ($history === false): ?>
  <div class="alert alert-danger mb-3">
		History is stopped! Go to <b>config.php</b> and set <b>admin_history</b>
		to <b>TRUE</b>
	</div>
<?php endif; ?>

<div class="table-responsive">
		<table class="table table-sm table-bordered table-striped custab">
			<thead>
				<tr>
					<th><?= lang('col_user') ?></th>
					<th><?= lang('col_action') ?></th>
					<th><?= lang('col_time') ?></th>
				</tr>
			</thead>

			<tbody>
      <?php if (!empty($actions)): ?>
        <?php foreach ($actions as $action): ?>
          <tr>
					<td><?= $action['username'] ?></td>
					<td><?= $action['activity'] ?></td>
					<td><?= date('Y.m.d / H.m.s', $action['time']) ?></td>
				</tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
					<td colspan="3" class="text-center"><?= lang('no_history_found') ?></td>
				</tr>
      <?php endif; ?>
    </tbody>
		</table>
	</div>

<?= $links_pagination ?>
	
</div>
<?= $this->endSection() ?>