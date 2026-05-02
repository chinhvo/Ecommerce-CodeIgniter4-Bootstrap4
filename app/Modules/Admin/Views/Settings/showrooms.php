<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('showrooms') ?>

<div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
    <div id="showrooms-page" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center mb-2">
                    <i class="fa fa-building fa-2x mr-2 text-secondary"></i>
                    <h1 class="h4 mb-0"><?= lang('showrooms') ?></h1>
                </div>

                <hr class="my-3">

                <?php if (isset($validation) && $validation && $validation->getErrors()) : ?>
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            <?php foreach ($validation->getErrors() as $err) : ?>
                                <li><?= esc($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('result')) : ?>
                    <div class="alert alert-success mb-3">
                        <?= esc(session()->getFlashdata('result')) ?>
                    </div>
                <?php endif; ?>

                <button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal" data-target="#showroomModal">
                    <strong>+</strong> <?= lang('showroom_add') ?>
                </button>

                <div class="clearfix"></div>

                <?php if (!empty($showrooms)) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('showroom_col_image') ?></th>
                                    <th><?= lang('showroom_col_name') ?></th>
                                    <th><?= lang('showroom_col_address') ?></th>
                                    <th><?= lang('showroom_col_phone') ?></th>
                                    <th><?= lang('showroom_col_email') ?></th>
                                    <th><?= lang('showroom_col_representative') ?></th>
                                    <th><?= lang('showroom_col_active') ?></th>
                                    <th class="text-center"><?= lang('showroom_col_actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($showrooms as $showroom) : ?>
                                    <tr>
                                        <td><?= (int) $showroom['id'] ?></td>
                                        <td>
                                            <?php if (!empty($showroom['main_image'])) : ?>
                                                <img src="<?= base_url(esc($showroom['main_image'])) ?>"
                                                    alt="<?= esc($showroom['name']) ?>"
                                                    style="height:48px;width:auto;object-fit:cover;border-radius:3px;">
                                            <?php else : ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($showroom['name']) ?></td>
                                        <td><?= esc($showroom['address']) ?></td>
                                        <td><?= esc($showroom['contact_phone'] ?? '-') ?></td>
                                        <td><?= esc($showroom['email'] ?? '-') ?></td>
                                        <td><?= esc($showroom['representative_person'] ?? '-') ?></td>
                                        <td>
                                            <?php if ((int) $showroom['is_active'] === 1) : ?>
                                                <span class="badge badge-success"><?= lang('showroom_is_active_on') ?></span>
                                            <?php else : ?>
                                                <span class="badge badge-secondary"><?= lang('showroom_is_active_off') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('admin/showrooms/' . (int) $showroom['id']) ?>" class="btn btn-outline-secondary btn-sm mr-1">
                                                <?= lang('edit') ?>
                                            </a>
                                            <form action="<?= base_url('admin/showrooms/delete/' . (int) $showroom['id']) ?>"
                                                method="post"
                                                class="d-inline"
                                                onsubmit="return confirm('<?= lang('showroom_delete_confirm') ?>')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-outline-danger btn-sm"><?= lang('delete') ?></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info mb-0"><?= lang('showroom_no_showrooms') ?></div>
                <?php endif; ?>

                <div class="modal fade" id="showroomModal" tabindex="-1" role="dialog" aria-labelledby="showroomModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="<?= base_url('admin/showrooms/save') ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="modal-header">
                                    <h5 class="modal-title" id="showroomModalLabel">
                                        <?= !empty($editShowroom) ? lang('showroom_edit') : lang('showroom_add') ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= esc(old('id', $editShowroom['id'] ?? 0)) ?>">

                                    <div class="form-group">
                                        <label for="showroom_name"><?= lang('showroom_name') ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="showroom_name" class="form-control" required
                                            value="<?= esc(old('name', $editShowroom['name'] ?? '')) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="showroom_address"><?= lang('showroom_address') ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="showroom_address" class="form-control" required
                                            value="<?= esc(old('address', $editShowroom['address'] ?? '')) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="showroom_google_map"><?= lang('showroom_google_map_location') ?></label>
                                        <input type="text" name="google_map_location" id="showroom_google_map" class="form-control" placeholder="https://maps.google.com/..."
                                            value="<?= esc(old('google_map_location', $editShowroom['google_map_location'] ?? '')) ?>">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="showroom_phone"><?= lang('showroom_contact_phone') ?></label>
                                            <input type="text" name="contact_phone" id="showroom_phone" class="form-control"
                                                value="<?= esc(old('contact_phone', $editShowroom['contact_phone'] ?? '')) ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="showroom_email"><?= lang('showroom_email') ?></label>
                                            <input type="email" name="email" id="showroom_email" class="form-control"
                                                value="<?= esc(old('email', $editShowroom['email'] ?? '')) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="showroom_representative"><?= lang('showroom_representative_person') ?></label>
                                        <input type="text" name="representative_person" id="showroom_representative" class="form-control"
                                            value="<?= esc(old('representative_person', $editShowroom['representative_person'] ?? '')) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="showroom_main_image"><?= lang('showroom_main_image') ?></label>
                                        <?php if (!empty($editShowroom['main_image'])) : ?>
                                            <div class="mb-2">
                                                <img src="<?= base_url(esc($editShowroom['main_image'])) ?>"
                                                    alt="<?= lang('showroom_image_current') ?>"
                                                    style="height:80px;width:auto;object-fit:cover;border-radius:4px;">
                                                <small class="d-block text-muted mt-1"><?= lang('showroom_image_replace') ?></small>
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" name="main_image" id="showroom_main_image" class="form-control-file" accept="image/*">
                                        <small class="text-muted"><?= lang('showroom_image_hint') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="showroom_additional"><?= lang('showroom_additional_information') ?></label>
                                        <textarea name="additional_information" id="showroom_additional" class="form-control" rows="4"><?= esc(old('additional_information', $editShowroom['additional_information'] ?? '')) ?></textarea>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="showroom_position"><?= lang('showroom_position') ?></label>
                                            <input type="number" min="0" name="position" id="showroom_position" class="form-control"
                                                value="<?= esc(old('position', $editShowroom['position'] ?? 0)) ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?= lang('showroom_is_active') ?></label>
                                            <div>
                                                <input type="checkbox"
                                                    name="is_active"
                                                    id="showroom_is_active"
                                                    value="1"
                                                    data-toggle="toggle"
                                                    data-on="<?= lang('showroom_is_active_on') ?>"
                                                    data-off="<?= lang('showroom_is_active_off') ?>"
                                                    data-onstyle="success"
                                                    data-offstyle="secondary"
                                                    <?= (int) old('is_active', $editShowroom['is_active'] ?? 1) === 1 ? 'checked' : '' ?>>
                                                <input type="hidden" name="is_active" value="0" id="showroom_is_active_hidden">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('cancel') ?></button>
                                    <button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#showroom_is_active').on('change', function() {
                $('#showroom_is_active_hidden').prop('disabled', this.checked);
            }).trigger('change');

            <?php if (!empty($openModal) || !empty(old('name')) || !empty(old('address'))) : ?>
                $('#showroomModal').modal('show');
            <?php endif; ?>
        });
    </script>
</div>

<?= $this->endSection() ?>