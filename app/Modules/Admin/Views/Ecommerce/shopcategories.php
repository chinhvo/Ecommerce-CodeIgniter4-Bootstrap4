<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('shop-categories') ?>

<div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
	<div id="languages">
		<h1>
			<img src="<?= base_url('assets/imgs/categories.jpg') ?>"
				class="header-img" style="margin-top: -2px;">
			<?= lang('shop_categories') ?>
		</h1>
		<hr>

		<?php if (isset($validation) && count($validation->getErrors()) > 0): ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<?= $validation->listErrors() ?>
				<?= $this->include('\App\Views\templates\close_alert') ?>
			</div>
		<hr>
		<?php endif; ?>

		<?php if (session()->getFlashdata('result_add')): ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<?= session()->getFlashdata('result_add') ?>
				<?= $this->include('\App\Views\templates\close_alert') ?>
			</div>
		<hr>
		<?php endif; ?>

		<?php if (session()->getFlashdata('result_delete')): ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<?= session()->getFlashdata('result_delete') ?>
				<?= $this->include('\App\Views\templates\close_alert') ?>
			</div>
		<hr>
		<?php endif; ?>

		<a href="javascript:void(0);" data-toggle="modal"
			data-target="#add_edit_articles"
			class="btn btn-primary btn-sm float-right mb-2">
			<b>+</b> <?= lang('add_shop_category') ?>
		</a>

		<div class="clearfix"></div>

		<?php if (! empty($shop_categories)): ?>
			<div class="table-responsive">
			<table class="table table-striped custab">
				<thead>
					<tr>
						<th>#<?= lang('col_id') ?></th>
						<th><?= lang('col_name') ?></th>
						<th><?= lang('icon') ?></th>
						<th><?= lang('col_subcategory_for') ?></th>
						<th><?= lang('position') ?></th>
						<th class="text-center"><?= lang('col_action') ?></th>
					</tr>
				</thead>
				<?php
				$i = 1;
				foreach ($shop_categories as $key_cat => $shop_categorie):
					$catName = '';
					foreach ($shop_categorie['info'] as $ff) {
						$catName .= '<div>' . '<a href="javascript:void(0);" class="editCategorie" data-indic="' . $i . '" data-parent_id"' . $ff['sub_for'] . '" data-for-id="' . $key_cat . '"  data-abbr="' . $ff['abbr'] . '" data-toggle="tooltip" data-placement="top" title="' . lang('edit') . '">' . '<i class="fa fa-pencil"></i>' . '</a> ' . '[' . $ff['abbr'] . ']<span id="indic-' . $i . '">' . $ff['name'] . '</span>' . '</div>';
						$i++;
					}
					?>
					<tr>
					<td><?= $key_cat ?></td>
					<td><?= $catName ?></td>
					<td>
						<?php if (! empty($shop_categorie['icon'])): ?>
							<i class="<?= esc($shop_categorie['icon']) ?>" aria-hidden="true"></i>
							<small class="text-muted d-block"><?= esc($shop_categorie['icon']) ?></small>
						<?php else: ?>
							<span class="text-muted">-</span>
						<?php endif; ?>
					</td>
					<td>
						<a href="javascript:void(0);" class="editCategorieSub"
							data-sub-for="<?= $shop_categorie['sub_for'] ?>"
							data-sub-for-id="<?= $key_cat ?>">
							<i class="fa fa-pencil"></i>
						</a>
						<?php foreach ($shop_categorie['sub'] as $sub): ?>
							<div><?= $sub ?></div>
						<?php endforeach; ?>
					</td>
					<td>
						<a href="javascript:void(0);" class="editPosition"
						data-position-for-id="<?= $key_cat ?>"
						data-my-position="<?= $shop_categorie['position'] ?>">
							<i class="fa fa-pencil"></i>
						</a>
						<span id="position-<?= $key_cat ?>"><?= $shop_categorie['position'] ?></span>
					</td>
					<td class="text-center">
						<a
						href="<?= base_url('admin/shopcategories/?delete=' . $key_cat) ?>"
						class="btn btn-danger btn-sm confirm-delete">
							<i class="fa fa-trash"></i> <?= lang('delete') ?>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
			<?= $links_pagination ?>
		<?php else: ?>
			<div class="clearfix"></div>
		<hr>
		<div class="alert alert-info"><?= lang('no_shop_categories_found') ?></div>
		<?php endif; ?>

        <!-- add/edit category modal -->
		<div class="modal fade" id="add_edit_articles" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="<?= base_url() ?>admin/shopcategories" method="POST">
						<div class="modal-header">
							<h5 class="modal-title" id="myModalLabel"><?= lang('add_category') ?></h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<?php foreach ($languages as $language): ?>
							<input type="hidden" name="translations[]"
								value="<?= esc($language->abbr) ?>">
						<?php endforeach; ?>

						<?php foreach ($languages as $language): ?>
							<div class="form-group">
								<label for="categorie_name_<?= esc($language->abbr) ?>"><?= lang('col_name') ?> (<?= esc($language->name) ?> <img
									src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
									alt="">)
								</label> <input type="text" name="categorie_name[]"
									class="form-control" id="categorie_name_<?= esc($language->abbr) ?>">
							</div>
						<?php endforeach; ?>

						<div class="form-group">
								<label for="icon"><?= lang('icon_class_font_awesome') ?></label>
								<input type="text" name="icon" class="form-control" id="icon"
									placeholder="fa fa-leaf">
						</div>

						<div class="form-group">
								<label for="sub_for"><?= lang('parent') ?> <small class="text-muted"><?= lang('subcategory_of_parent') ?></small>:
								</label>
								<select class="form-control" name="sub_for" id="sub_for">
									<option value="0"><?= lang('none') ?></option>
									<?php
									foreach ($shop_categories as $key_cat => $shop_categorie):
										$aa = '';
										foreach ($shop_categorie['info'] as $ff) {
											$aa .= '[' . $ff['abbr'] . ']' . $ff['name'] . '/';
										}
										?>
										<option value="<?= $key_cat ?>"><?= $aa ?></option>
									<?php endforeach; ?>
								</select>
						</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal"><?= lang('cancel') ?></button>
							<button type="submit" name="submit" class="btn btn-primary"
								value="save"><?= lang('save') ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Inline editors -->
	<div id="categorieEditor">
		<input type="text" name="new_value" class="form-control" value="">
		<button type="button" class="btn btn-secondary saveEditCategorie float-right">
			<i class="fa fa-save noSaveEdit"></i> <i
				class="fa fa-spinner fa-spin fa-fw yesSaveEdit"></i>
		</button>
		<button type="button" class="btn btn-secondary closeEditCategorie float-right">
			<i class="fa fa-times"></i>
		</button>
	</div>

	<div id="categorieSubEdit">
		<form method="POST" id="categorieEditSubChanger">
			<input type="hidden" name="editSubId" value="">
			<select
				class="form-control" name="newSubIs">
				<option value=""></option>
				<option value="0"><?= lang('none') ?></option>
				<?php

				foreach ($shop_categories as $key_cat => $shop_categorie):
					$aa = '';
					foreach ($shop_categorie['info'] as $ff) {
						$aa .= '[' . $ff['abbr'] . ']' . $ff['name'] . '/';
					}
					?>
					<option value="<?= $key_cat ?>"><?= $aa ?></option>
				<?php endforeach; ?>
			</select>
		</form>
	</div>

	<div id="positionEditor">
		<input type="hidden" name="positionEditId" value="">
		<input type="text" name="new_position" class="form-control" value="">
		<button type="button" class="btn btn-secondary savePositionCategorie">
			<i class="fa fa-save noSavePosition"></i> <i
				class="fa fa-spinner fa-spin fa-fw yesSavePosition"></i>
		</button>
		<button type="button" class="btn btn-secondary closePositionCategorie">
			<i class="fa fa-times"></i>
		</button>
	</div>
</div>

<?= $this->endSection() ?>
