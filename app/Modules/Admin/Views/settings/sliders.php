<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('sliders') ?>

<div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
  <div id="sliders-page" class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="d-flex align-items-center mb-2">
          <i class="fa fa-picture-o fa-2x mr-2 text-secondary"></i>
          <h1 class="h4 mb-0"><?= lang('sliders') ?></h1>
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

        <button type="button"
                class="btn btn-primary btn-sm float-right mb-3"
                data-toggle="modal"
                data-target="#sliderModal">
          <strong>+</strong> <?= lang('slider_add') ?>
        </button>

        <div class="clearfix"></div>

        <?php if (!empty($sliders)) : ?>
          <?php $today = date('Y-m-d'); ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th><?= lang('slider_col_image') ?></th>
                  <th><?= lang('slider_col_name') ?></th>
                  <th><?= lang('slider_col_link') ?></th>
                  <th><?= lang('slider_col_active') ?></th>
                  <th><?= lang('slider_col_daterange') ?></th>
                  <th class="text-center"><?= lang('slider_col_today') ?></th>
                  <th class="text-center"><?= lang('slider_col_actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($sliders as $slider) : ?>
                  <?php
                    $fromOk = empty($slider['active_from']) || $slider['active_from'] <= $today;
                    $toOk   = empty($slider['active_to'])   || $slider['active_to']   >= $today;
                    $liveToday = $slider['is_active'] == 1 && $fromOk && $toOk;
                  ?>
                  <tr>
                    <td><?= esc($slider['id']) ?></td>
                    <td>
                      <?php if (!empty($slider['image'])) : ?>
                        <img src="<?= base_url(esc($slider['image'])) ?>"
                             alt="<?= esc($slider['name']) ?>"
                             style="height: 48px; width: auto; object-fit: cover; border-radius: 3px;">
                      <?php else : ?>
                        <span class="text-muted">—</span>
                      <?php endif; ?>
                    </td>
                    <td><?= esc($slider['name']) ?></td>
                    <td>
                      <?php if (!empty($slider['link'])) : ?>
                        <a href="<?= esc($slider['link']) ?>" target="_blank" rel="noopener">
                          <?= esc(mb_strimwidth($slider['link'], 0, 40, '…')) ?>
                        </a>
                      <?php else : ?>
                        <span class="text-muted">—</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($slider['is_active'] == 1) : ?>
                        <span class="badge badge-success"><?= lang('slider_is_active_on') ?></span>
                      <?php else : ?>
                        <span class="badge badge-secondary"><?= lang('slider_is_active_off') ?></span>
                      <?php endif; ?>
                    </td>
                    <td class="small">
                      <?php
                        $from = !empty($slider['active_from']) ? date('d/m/Y', strtotime($slider['active_from'])) : '∞';
                        $to   = !empty($slider['active_to'])   ? date('d/m/Y', strtotime($slider['active_to']))   : '∞';
                      ?>
                      <?= esc($from) ?> → <?= esc($to) ?>
                    </td>
                    <td class="text-center">
                      <?php if ($liveToday) : ?>
                        <span class="badge badge-success"><i class="fa fa-check"></i> <?= lang('slider_status_live') ?></span>
                      <?php else : ?>
                        <span class="badge badge-warning"><i class="fa fa-clock-o"></i> <?= lang('slider_status_not') ?></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <a href="<?= base_url('admin/sliders/' . (int)$slider['id']) ?>"
                         class="btn btn-outline-secondary btn-sm mr-1">
                        Edit
                      </a>
                      <form action="<?= base_url('admin/sliders/delete/' . (int)$slider['id']) ?>"
                            method="post"
                            class="d-inline"
                            onsubmit="return confirm('<?= lang('slider_delete_confirm') ?>')">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else : ?>
          <div class="alert alert-info mb-0"><?= lang('slider_no_sliders') ?></div>
        <?php endif; ?>

        <!-- Add / Edit Modal -->
        <div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

              <form action="<?= base_url('admin/sliders/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="modal-header">
                  <h5 class="modal-title" id="sliderModalLabel">
                    <?= !empty($editSlider) ? lang('slider_edit') : lang('slider_add') ?>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <input type="hidden" name="id" value="<?= esc(old('id', $editSlider['id'] ?? 0)) ?>">

                  <div class="form-group">
                    <label for="slider_name"><?= lang('slider_name') ?> <span class="text-danger">*</span></label>
                    <input type="text"
                           name="name"
                           id="slider_name"
                           class="form-control"
                           value="<?= esc(old('name', $editSlider['name'] ?? '')) ?>"
                           required>
                  </div>

                  <div class="form-group">
                    <label for="slider_link"><?= lang('slider_link') ?></label>
                    <input type="text"
                           name="link"
                           id="slider_link"
                           class="form-control"
                           placeholder="https://..."
                           value="<?= esc(old('link', $editSlider['link'] ?? '')) ?>">
                  </div>

                  <div class="form-group">
                    <label for="slider_image">
                      <?= lang('slider_image') ?>
                      <?php if (empty($editSlider)) : ?>
                        <span class="text-danger">*</span>
                      <?php endif; ?>
                    </label>
                    <?php if (!empty($editSlider['image'])) : ?>
                      <div class="mb-2">
                        <img src="<?= base_url(esc($editSlider['image'])) ?>"
                             alt="<?= lang('slider_image_current') ?>"
                             style="height: 80px; width: auto; object-fit: cover; border-radius: 4px;">
                        <small class="d-block text-muted mt-1"><?= lang('slider_image_replace') ?></small>
                      </div>
                    <?php endif; ?>
                    <input type="file"
                           name="image"
                           id="slider_image"
                           class="form-control-file"
                           accept="image/*"
                           <?= empty($editSlider) ? 'required' : '' ?>>
                    <small class="text-muted"><?= lang('slider_image_hint') ?></small>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="slider_from"><?= lang('slider_active_from') ?></label>
                      <input type="text"
                             name="active_from"
                             id="slider_from"
                             class="form-control datepicker"
                             placeholder="YYYY-MM-DD"
                             value="<?= esc(old('active_from', $editSlider['active_from'] ?? '')) ?>">
                      <small class="text-muted"><?= lang('slider_from_hint') ?></small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="slider_to"><?= lang('slider_active_to') ?></label>
                      <input type="text"
                             name="active_to"
                             id="slider_to"
                             class="form-control datepicker"
                             placeholder="YYYY-MM-DD"
                             value="<?= esc(old('active_to', $editSlider['active_to'] ?? '')) ?>">
                      <small class="text-muted"><?= lang('slider_to_hint') ?></small>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="slider_position"><?= lang('slider_position') ?></label>
                      <input type="number"
                             name="position"
                             id="slider_position"
                             class="form-control"
                             min="0"
                             value="<?= esc(old('position', $editSlider['position'] ?? 0)) ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label><?= lang('slider_is_active') ?></label>
                      <div>
                        <input type="checkbox"
                               name="is_active"
                               id="slider_is_active"
                               value="1"
                               data-toggle="toggle"
                               data-on="<?= lang('slider_is_active_on') ?>"
                               data-off="<?= lang('slider_is_active_off') ?>"
                               data-onstyle="success"
                               data-offstyle="secondary"
                               <?= (int)(old('is_active', $editSlider['is_active'] ?? 1)) === 1 ? 'checked' : '' ?>>
                        <input type="hidden" name="is_active" value="0" id="slider_is_active_hidden">
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
        <!-- /Modal -->

      </div>
    </div>
  </div>

  <script>
    // Date pickers
    $(function () {
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
      });

      // Fix checkbox toggle — uncheck the hidden field when checked
      $('#slider_is_active').on('change', function () {
        $('#slider_is_active_hidden').prop('disabled', this.checked);
      }).trigger('change');

      <?php if (!empty($openModal) || !empty(old('name'))) : ?>
        $('#sliderModal').modal('show');
      <?php endif; ?>
    });
  </script>
</div>

<?= $this->endSection() ?>
