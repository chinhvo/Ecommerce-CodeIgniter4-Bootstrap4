<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('languages') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<div id="languages">
		<div class="d-flex align-items-center justify-content-between mb-2">
			<h1 class="h3 mb-0">
				<img src="<?= base_url('assets/imgs/small-globe.png') ?>"
					class="header-img" style="margin-top: -3px;" alt=""> <?= lang('languages') ?>
			</h1>

        <?php if (!isset($writable)) { ?>
            <a href="javascript:void(0);" data-toggle="modal"
				data-target="#addLanguage" class="btn btn-primary btn-sm"> <strong>+</strong>
				<?= lang('add_new_language') ?>
			</a>
        <?php } ?>
    </div>

		<hr>

    <?php if (isset($writable)) { ?>
        <div class="alert alert-danger"><?= $writable ?></div>
    <?php } ?>

    <?php if (isset($validation) && count($validation->getErrors()) > 0) { ?>
        <div class="alert alert-danger mb-3"><?= $validation->getErrors() ?></div>
    <?php } ?>

    <?php if (session()->getFlashdata('result_add')) { ?>
        <div class="alert alert-success mb-3"><?= session()->getFlashdata('result_add') ?></div>
    <?php } ?>

    <?php if (session()->getFlashdata('result_delete')) { ?>
        <div class="alert alert-success mb-3"><?= session()->getFlashdata('result_delete') ?></div>
    <?php } ?>

    <?php if ($languages) { ?>
        <div class="table-responsive">
			<table class="table table-striped custab mb-0">
				<thead class="thead-light">
					<tr>
						<th>#ID</th>
						<th><?= lang('col_image') ?></th>
						<th><?= lang('col_abbr') ?></th>
						<th><?= lang('col_name') ?></th>
						<th><?= lang('col_currency') ?></th>
						<th class="text-center"><?= lang('col_action') ?></th>
					</tr>
				</thead>

				<tbody>
                <?php foreach ($languages as $language) { ?>
                    <tr>
						<td><?= $language->id ?></td>
						<td><img
							src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
							alt="No country flag" style="width: 16px; height: 11px;"></td>
						<td><?= htmlspecialchars(strtoupper($language->abbr)) ?></td>
						<td><?= htmlspecialchars(ucfirst($language->name)) ?></td>
						<td><?= htmlspecialchars($language->currency) ?></td>

						<td class="text-center">
                            <?php if (MY_DEFAULT_LANGUAGE_ABBR != $language->abbr) { ?>
                                <a
							href="<?= base_url('admin/languages/?delete=' . $language->id) ?>"
								class="btn btn-danger btn-sm confirm-delete"><?= lang('delete') ?>
						</a>
                            <?php } else { ?>
                            <span class="text-muted"><?= lang('its_default') ?></span>
                            <?php } ?>

                            <a
							href="<?= base_url('admin/languages/?editLang=' . $language->name) ?>"
								class="btn btn-info btn-sm ml-1"><?= lang('edit') ?>
						</a>
						</td>
					</tr>
                <?php } ?>
                </tbody>
			</table>
		</div>
    <?php } else { ?>
        <hr>
		<div class="alert alert-info mb-0"><?= lang('no_languages_found') ?></div>
    <?php } ?>

    <div class="alert alert-warning mt-3">
			<strong><?= lang('language_help_title') ?></strong>
			<ul class="mb-0">
				<li><?= lang('language_step_1') ?></li>
				<li><?= lang('language_step_2') ?></li>
		</div>

    <?php if (isset($_GET['editLang'])) { ?>
        <form method="POST" id="saveLang">
            <?= csrf_field() ?>        
			<input type="hidden" name="goDaddyGo" value="">

			<div class="alert alert-info">
				<?= lang('now_editing_language') ?> <strong><?= ucfirst(htmlspecialchars($_GET['editLang'])) ?></strong>
			</div>

            <?php
        $o = 1;
        $countValuesForEdit = 0;
        foreach ($arrPhpFiles as $phpFile => $langFinal) {
            if (! empty($langFinal)) {
                foreach ($langFinal as $key => $val) {
                    ?>
                        <div class="divLangs mb-3">
				<div class="mb-1">
					<strong><?= $o ?>.</strong> <?= $val ?>
                            </div>

				<input type="hidden" name="php_files[]" value="<?= $phpFile ?>"> <input
					type="hidden" name="php_keys[]" value="<?= $key ?>"> <input
					type="text" value="<?= $val ?>" class="form-control"
					name="php_values[]">
			</div>
                        <?php
                    $o ++;
                    $countValuesForEdit ++;
                }
            }
        }

        foreach ($arrJsFiles as $jsFile => $langFinal) {
            $i = 0;
            foreach ($langFinal[1] as $aaIam) {
                ?>
                    <div class="divLangs mb-3">
				<div class="mb-1">
					<strong><?= $o ?>.</strong> <?= $langFinal[2][$i] ?>
                        </div>

				<input type="hidden" name="js_files[]" value="<?= $jsFile ?>"> <input
					type="hidden" name="js_keys[]"
					value="<?= trim(str_replace(':', '', $aaIam)) ?>"> <input
					type="text" class="form-control" value="<?= $langFinal[2][$i] ?>"
					name="js_values[]">
			</div>
                    <?php
                $i ++;
                $o ++;
                $countValuesForEdit ++;
            }
        }
        ?>

            <?php if ($countValuesForEdit * 6 > $max_input_vars) { ?>
                <div class="alert alert-danger">
				You can't edit this language because the server have restriction for
				<strong>max_input_vars</strong>. It must be more than <strong><?= $countValuesForEdit * 6 ?></strong>
				and now is <strong><?= $max_input_vars ?></strong>.<br> Please
				contact your system administrator.
			</div>
            <?php } else { ?>
                <a href="javascript:void(0);" data-form-id="saveLang"
				class="btn btn-info btn-lg confirm-save"> <?= lang('save_me') ?> </a>
            <?php } ?>

            <a href="<?= base_url('admin/languages') ?>"
				class="btn btn-secondary btn-lg ml-2">Cancel</a>
		</form>
    <?php } ?>

    <!-- Add language modal -->
		<div class="modal fade" id="addLanguage" tabindex="-1" role="dialog"
			aria-labelledby="addLanguageLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<!-- optional: modal-dialog-centered -->
				<div class="modal-content">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-header">
							<h5 class="modal-title" id="addLanguageLabel"><?= lang('add_language_title') ?></h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<div class="form-group">
						<label for="abbr"><?= lang('abbreviation_label') ?></label> <input type="text"
									name="abbr" class="form-control" id="abbr">
							</div>

							<div class="form-group">
						<label for="name"><?= lang('col_name') ?></label> <input type="text" name="name"
									class="form-control" id="name">
							</div>

							<div class="form-group">
						<label for="currency"><?= lang('col_currency') ?></label> <input type="text"
									name="currency" class="form-control" id="currency">
							</div>

							<div class="form-group">
								<label for="currencyKey"><?= lang('currency_key_label') ?></label>
								<!-- If you still use bootstrap-select, keep class="selectpicker" and its JS/CSS.
                                 If not, remove selectpicker + data-live-search, and keep form-control/custom-select. -->
								<select class="form-control" name="currencyKey" id="currencyKey">
                                <?php
                                $curr = currencies();
                                foreach ($curr as $key => $val) {
                                    ?>
                                    <option value="<?= $key ?>"><?= $key ?></option>
                                <?php } ?>
                            </select>
							</div>

							<div class="form-group">
						<label for="userfile"><?= lang('flag_image_label') ?></label> <input type="file"
									class="form-control-file" id="userfile" name="userfile">
							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
							data-dismiss="modal"><?= lang('cancel') ?></button>
						<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>