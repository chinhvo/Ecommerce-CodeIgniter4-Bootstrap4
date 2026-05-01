<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('products') ?>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<div class="container-fluid my-4" id="products">
		<!-- Header -->
		<?php if (session()->getFlashdata('result_delete')): ?>
			<hr>
			<div class="alert alert-success"><?= session()->getFlashdata('result_delete') ?></div>
			<hr>
		<?php endif; ?>

		<?php if (session()->getFlashdata('result_publish')): ?>
			<hr>
			<div class="alert alert-success"><?= session()->getFlashdata('result_publish') ?></div>
			<hr>
		<?php endif; ?>

		<div class="d-flex justify-content-between align-items-center flex-wrap">
			<h1 class="mb-2 mb-sm-0">
				<img src="<?= base_url('assets/imgs/products-img.png') ?>"
					class="header-img" style="margin-top: -2px;"> <?= lang('products_page_title') ?>
			</h1>
			<a href="<?= base_url('admin/publish') ?>" class="btn btn-primary btn-sm">
				<i class="fa fa-plus"></i> <?= lang('create_product') ?>
			</a>
		</div>
		<hr>
		<div class="row">
			<div
				class="container-fluid justify-content-between align-items-center mb-4">
				<form method="get" id="searchProductsForm"
					action="<?= base_url('admin/products') ?>">
					<div class="form-row">
						<!-- Order -->
						<div class="form-group col-sm-4">
							<label for="order_by"><?= lang('products_order_label') ?>:</label> <select id="order_by"
								name="order_by" class="form-control change-products-form">
								<option value="id=desc"
									<?= (service('request')->getGet('order_by') === 'id=desc') ? 'selected' : '' ?>><?= lang('products_order_newest') ?></option>
								<option value="id=asc"
									<?= (service('request')->getGet('order_by') === 'id=asc') ? 'selected' : '' ?>><?= lang('products_order_oldest') ?></option>
								<option value="quantity=asc"
									<?= (service('request')->getGet('order_by') === 'quantity=asc') ? 'selected' : '' ?>><?= lang('products_order_low_quantity') ?></option>
								<option value="quantity=desc"
									<?= (service('request')->getGet('order_by') === 'quantity=desc') ? 'selected' : '' ?>><?= lang('products_order_high_quantity') ?></option>
							</select>
						</div>

						<!-- Title -->
						<div class="form-group col-sm-4">
							<label for="search_title"><?= lang('col_title') ?>:</label>
							<div class="input-group">
								<input id="search_title" class="form-control"
									placeholder="<?= lang('products_search_title_placeholder') ?>" type="text" name="search_title"
									value="<?= esc(service('request')->getGet('search_title')) ?>">
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="submit">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>

						<!-- Category -->
						<div class="form-group col-sm-4">
							<label for="category"><?= lang('products_category_label') ?>:</label> <select id="category"
								name="category" class="form-control change-products-form">
								<option value=""><?= lang('none') ?></option>
								<?php foreach ($shop_categories as $key_cat => $shop_categorie): ?>
									<option value="<?= esc($key_cat) ?>"
										<?= (service('request')->getGet('category') == $key_cat) ? 'selected' : '' ?>>
										<?php foreach ($shop_categorie['info'] as $nameAbbr): ?>
											<?php if ($nameAbbr['abbr'] === config('App')->defaultLocale): ?>
												<?= esc($nameAbbr['name']) ?>
											<?php endif; ?>
										<?php endforeach; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</form>

			</div>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<?php if (!empty($products)): ?>
				<table class="table table-bordered table-hover">
					<thead class="thead-light">
						<tr>
							<th><?= lang('col_image') ?></th>
							<th><?= lang('col_title') ?></th>
							<th><?= lang('products_col_price') ?></th>
							<th><?= lang('products_col_quantity') ?></th>
							<th><?= lang('products_col_vendor') ?></th>
							<th><?= lang('position') ?></th>
							<th class="text-right"><?= lang('col_action') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($products as $row): ?>
							<?php
							$u_path = 'attachments/shop_images/';
							$image = (! empty($row->image) && file_exists($u_path . $row->image)) ? base_url($u_path . $row->image) : base_url('attachments/no-image.png');

							if ($row->quantity == 0) {
								$color = 'text-danger font-weight-bold';
							} elseif ($row->quantity <= 5) {
								$color = 'text-warning font-weight-bold';
							} else {
								$color = 'text-success font-weight-bold';
							}
							?>
							<tr>
								<td><img src="<?= $image ?>" alt="<?= lang('products_image_alt') ?>" class="img-thumbnail"
										style="height: 100px;"></td>
								<td><?= esc($row->title) ?></td>
								<td><?= esc($row->price) ?></td>
								<td><span class="<?= $color ?>" style="font-size: 12px;">
										<?= esc($row->quantity) ?>
									</span></td>
								<td>
									<?= ($row->vendor_id > 0) ? '<a href="?show_vendor=' . esc($row->vendor_id) . '">' . esc($row->vendor_name) . '</a>' : lang('products_no_vendor') ?>
								</td>
								<td><?= esc($row->position) ?></td>
								<td class="text-right"><a
										href="<?= base_url('admin/publish/' . $row->id) ?>"
										class="btn btn-info btn-sm"> <?= lang('products_edit_button') ?> </a> <a
										href="<?= base_url('admin/products?delete=' . $row->id) ?>"
										class="btn btn-danger btn-sm confirm-delete"> <?= lang('products_delete_button') ?> </a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<!-- Pagination -->
				<?= $links_pagination ?>
			<?php else: ?>
				<div class="alert alert-info"><?= lang('products_empty_message') ?></div>
			<?php endif; ?>
		</div>

	</div>
</div>
<?= $this->endSection() ?>