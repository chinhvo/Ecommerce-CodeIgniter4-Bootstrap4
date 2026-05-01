<?php

use App\Core\BlogType; ?>
<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('blogposts') ?>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
	<div class="d-flex justify-content-between align-items-center flex-wrap">
		<h1 class="mb-2 mb-sm-0">
			<img src="<?= base_url('assets/imgs/blogger.png') ?>"
				class="header-img blogpost-header-img"> <?= lang('blog_posts') ?>
		</h1>
		<a href="<?= base_url('admin/blogpublish') ?>" class="btn btn-primary btn-sm">
			<i class="fa fa-plus"></i> <?= lang('create_blog_post') ?>
		</a>
	</div>
	<hr>

	<!-- Flashdata -->
	<?php if (session()->getFlashdata('result_publish')): ?>
		<div class="alert alert-info">
			<?= session()->getFlashdata('result_publish') ?>
		</div>
	<?php endif; ?>

	<div class="row mb-3">
		<div class="col-sm-6">
			<form method="GET">
				<div class="input-group">
					<select class="form-control" name="blog_type">
						<option value=""><?= lang('all_types') ?></option>
						<?php foreach ($blogTypes as $typeId => $typeLabel): ?>
							<option value="<?= (int) $typeId ?>" <?= isset($selectedBlogType) && (int) $selectedBlogType === (int) $typeId ? 'selected' : '' ?>>
								<?= esc($typeLabel) ?>
							</option>
						<?php endforeach; ?>
					</select>
					<input type="text" class="form-control" name="search"
						value="<?= esc(service('request')->getGet('search')) ?>"
						placeholder="<?= lang('find_here') ?>">
					<div class="input-group-append">
						<button class="btn btn-secondary" type="submit"><?= lang('search') ?></button>
					</div>
				</div>
				<?php if (service('request')->getGet('search') || service('request')->getGet('blog_type')): ?>
					<a href="<?= base_url('admin/blog') ?>"><?= lang('clear_search') ?></a>
				<?php endif; ?>
			</form>
		</div>
	</div>

	<hr>

	<?php if (!empty($posts)): ?>
		<h1>
			<?= !service('request')->getGet('search') ? ($page == 0 ? '' : lang('page_label') . ': ' . floor($page / $num_rows + 1)) : '' ?>
		</h1>

		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="thead-light">
					<tr>
						<th class="blogpost-th-image"><?= lang('col_image') ?></th>
						<th><?= lang('col_title') ?></th>
						<th class="blogpost-th-type"><?= lang('col_type') ?></th>
						<th class="blogpost-th-action"><?= lang('col_action') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($posts as $row): ?>
						<?php $typeId = isset($row['blog_type']) ? (int) $row['blog_type'] : BlogType::GENERAL_NEWS; ?>
						<?php $typeLabel = $blogTypes[$typeId] ?? $blogTypes[BlogType::GENERAL_NEWS]; ?>
						<tr>
							<td>
								<img src="<?= base_url('attachments/blog_images/' . $row['image']) ?>"
									alt="image" class="img-thumbnail blogpost-thumb">
							</td>
							<td>
								<a href="<?= base_url('blog/' . $row['url']) ?>" target="_blank">
									<?= esc($row['title']) ?>
								</a>
							</td>
							<td>
								<span class="badge badge-info"><?= esc($typeLabel) ?></span>
							</td>
							<td class="blogpost-td-action">
								<a href="<?= base_url('admin/blogpublish/' . $row['id']) ?>"
									class="btn btn-primary btn-sm"><?= lang('edit') ?></a>
								<a href="<?= base_url('admin/blog/?delete=' . $row['id']) ?>"
									class="btn btn-danger btn-sm confirm-delete"><?= lang('delete') ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php else: ?>
		<div class="alert alert-danger" role="alert"><?= lang('no_posts') ?></div>
	<?php endif; ?>

	<?= $links_pagination ?>
</div>
<?= $this->endSection() ?>