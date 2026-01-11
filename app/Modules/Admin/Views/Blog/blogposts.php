<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('blogposts') ?>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
	<h1>
		<img src="<?= base_url('assets/imgs/blogger.png') ?>"
			class="header-img" style="margin-top: -2px;"> Blog Posts
	</h1>
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
					<input type="text" class="form-control" name="search"
						value="<?= esc(service('request')->getGet('search')) ?>"
						placeholder="Find here">
					<div class="input-group-append">
						<button class="btn btn-secondary" type="submit">Search</button>
					</div>
				</div>
            <?php if (service('request')->getGet('search')): ?>
                <a href="<?= base_url('admin/blog') ?>">Clear search</a>
            <?php endif; ?>
        </form>
		</div>
	</div>

	<hr>

<?php if (!empty($posts)): ?>
    <h1>
        <?= !service('request')->getGet('search') ? ($page == 0 ? '' : 'Page: ' . floor($page / 20 + 1)) : '' ?>
    </h1>

	<div class="row">
        <?php foreach ($posts as $row): ?>
            <div class="col-sm-6 col-md-4 mb-4">
			<div class="card h-100 shadow-sm">
				<img
					src="<?= base_url('attachments/blog_images/' . $row['image']) ?>"
					class="card-img-top view_all_img" alt="image">

				<div class="card-body d-flex flex-column">
					<h5 class="card-title" style="height: 113px; overflow: hidden;">
						<a href="<?= base_url($row['url']) ?>" target="_blank">
                                <?= character_limiter($row['title'], 90) ?>
                            </a>
					</h5>

					<div class="mt-auto">
						<a href="<?= base_url('admin/blogpublish/' . $row['id']) ?>"
							class="btn btn-primary btn-sm">Edit</a> <a
							href="<?= base_url('admin/blog/?delete=' . $row['id']) ?>"
							class="btn btn-danger btn-sm confirm-delete">Delete</a>
					</div>
				</div>
			</div>
		</div> 
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">No Posts</div>
<?php endif; ?>

<?= $links_pagination ?>
</div>
<?= $this->endSection() ?>
