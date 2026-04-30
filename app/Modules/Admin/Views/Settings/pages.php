<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('pages') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<h1 class="mb-2">
		<img src="<?= base_url('assets/imgs/webpages.jpg') ?>"
			class="header-img" style="margin-top: -3px;" alt=""> <?= lang('pages_manager') ?>
	</h1>

	<p class="text-muted"><?= lang('pages_manager_desc') ?></p>
	<hr>

	<div class="row">
		<div class="col-sm-6 col-md-4">

			<a href="javascript:void(0);" data-toggle="modal"
				data-target="#addPage" class="btn btn-secondary mb-2"> <i
				class="fa fa-plus mr-1" aria-hidden="true"></i> <?= lang('add_page') ?>
			</a>

    <?php if (!empty($pages)) : ?>
      <ul class="list-group">
        <?php foreach ($pages as $page): ?>
          <li
					class="list-group-item d-flex align-items-center justify-content-between"
					data-id="<?= $page['id'] ?>"><a href="javascript:void(0);"
					class="text-uppercase"
					onclick="changeTextualPageStatus(<?= $page['id'] ?>)"> <i
						class="fa fa-power-off mr-1" aria-hidden="true"></i>
              <?= htmlspecialchars($page['name']) ?>
            </a>

					<div class="ml-auto d-flex align-items-center">
						<span class="status mr-2">
                <?php $page['enabled'] == 1 ? $status = 'green' : $status = 'red'; ?>
                <i class="fa fa-circle <?= $status ?>"
							aria-hidden="true"></i>
						</span>

              <?php if ($page['name'] != 'blog'): ?>
                <a href="?delete=<?= $page['id'] ?>"
							class="btn btn-sm btn-danger confirm-delete"> <i
							class="fa fa-times" aria-hidden="true"></i>
						</a>
              <?php endif; ?>
            </div></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

  </div>
	</div>

	<!-- Modal (Bootstrap 4) -->
	<div class="modal fade" id="addPage" tabindex="-1" role="dialog"
		aria-labelledby="addPageLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<form action="" method="POST">
					<div class="modal-header">
						<h5 class="modal-title" id="addPageLabel"><?= lang('add_page_title') ?></h5>

						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="form-group">
						<label for="pname"><?= lang('page_name_label') ?></label> <input type="text"
								name="pname" class="form-control" id="pname">
						</div>

						<div class="alert alert-warning mb-0"><?= lang('page_will_be_textual') ?></div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary"
					data-dismiss="modal"><?= lang('cancel') ?></button>
				<button type="submit" class="btn btn-primary"><?= lang('add') ?></button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>