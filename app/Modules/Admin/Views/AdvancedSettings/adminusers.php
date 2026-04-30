<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('adminusers') ?>

<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>

<div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
  <div id="users" class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="d-flex align-items-center mb-2">
          <img src="<?= base_url('assets/imgs/admin-user.png') ?>" alt="Admin Users" class="mr-2" style="height: 32px; width: auto;">
          <h1 class="h4 mb-0"><?= lang('admin_users') ?></h1>
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

        <?php if (session()->getFlashdata('result_add')) : ?>
          <div class="alert alert-success mb-3">
            <?= esc(session()->getFlashdata('result_add')) ?>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('result_delete')) : ?>
          <div class="alert alert-success mb-3">
            <?= esc(session()->getFlashdata('result_delete')) ?>
          </div>
        <?php endif; ?>

        <button type="button"
                class="btn btn-primary btn-sm float-right mb-3"
                data-toggle="modal"
                data-target="#add_edit_users">
          <strong>+</strong> <?= lang('add_new_user') ?>
        </button>

        <div class="clearfix"></div>

        <?php if (!empty($users)) : ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#ID</th>
                  <th scope="col"><?= lang('col_username') ?></th>
                  <th scope="col"><?= lang('password') ?></th>
                  <th scope="col"><?= lang('col_email') ?></th>
                  <th scope="col"><?= lang('col_notifications') ?></th>
                  <th scope="col"><?= lang('col_last_login') ?></th>
                  <th scope="col" class="text-center"><?= lang('col_action') ?></th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($users as $user) : ?>
                  <tr>
                    <td><?= esc($user['id']) ?></td>
                    <td><?= esc($user['username']) ?></td>
                    <td><b>hidden ;)</b></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['notify']) ?></td>
                    <td>
                      <?= !empty($user['last_login'])
                        ? esc(date('d.m.Y - H:i:s', (int)$user['last_login']))
                        : '-' ?>
                    </td>

                    <td class="text-center">
                      <a href="<?= base_url('admin/adminusers?edit=' . (int)$user['id']) ?>"
                         class="btn btn-outline-secondary btn-sm mr-1">
                        <?= lang('edit') ?>
                      </a>

                      <form action="<?= base_url('admin/adminusers/delete/' . (int)$user['id']) ?>"
                            method="post"
                            class="d-inline"
                            onsubmit="return confirm('<?= lang('delete_user_confirm') ?>')">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                          <?= lang('delete') ?>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else : ?>
          <hr class="my-3">
          <div class="alert alert-info mb-0"><?= lang('no_users_found') ?></div>
        <?php endif; ?>

        <!-- Add/Edit Users Modal -->
        <div class="modal fade" id="add_edit_users" tabindex="-1" role="dialog" aria-labelledby="addEditUsersLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <form action="<?= base_url('admin/adminusers/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="modal-header">
                  <h5 class="modal-title" id="addEditUsersLabel">
                    <?= !empty($editUser) ? lang('edit_administrator') : lang('add_administrator') ?>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <input type="hidden" name="id" value="<?= esc(old('id', $editUser['id'] ?? 0)) ?>">

                  <div class="form-group">
                    <label for="username"><?= lang('col_username') ?></label>
                    <input type="text"
                           name="username"
                           id="username"
                           class="form-control"
                           value="<?= esc(old('username', $editUser['username'] ?? '')) ?>">
                  </div>

                  <div class="form-group">
                    <label for="password"><?= lang('password') ?></label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           value="">
                    <?php if (!empty($editUser)) : ?>
                      <small class="text-muted"><?= lang('keep_current_password') ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <label for="email"><?= lang('col_email') ?></label>
                    <input type="text"
                           name="email"
                           id="email"
                           class="form-control"
                           value="<?= esc(old('email', $editUser['email'] ?? '')) ?>">
                  </div>

                  <div class="form-group">
                    <label for="notify"><?= lang('col_notifications') ?></label>
                    <input type="text"
                           name="notify"
                           id="notify"
                           class="form-control"
                           placeholder="<?= lang('notifications_placeholder') ?>"
                           value="<?= esc(old('notify', $editUser['notify'] ?? '0')) ?>">
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
    <?php if (!empty($openModal) || !empty(old('username')) || !empty(old('email'))) : ?>
      $(function () {
        $('#add_edit_users').modal('show');
      });
    <?php endif; ?>
  </script>
</div>

<?= $this->endSection() ?>
