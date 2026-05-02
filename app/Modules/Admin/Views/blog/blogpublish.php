<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('blogpublish') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>

<div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">
    <h1>
        <img src="<?= base_url('assets/imgs/blogger.png') ?>" class="header-img blogpost-header-img">
        <?= lang('publish_post') ?>
    </h1>
    <hr>

    <div class="row">
        <div class="col-sm-12 col-md-10">

            <!-- Validation Errors -->
            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session('errors') as $error): ?>
                        <?= esc($error) ?><br>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <!-- Flashdata Result -->
            <?php if (session()->getFlashdata('result_publish')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('result_publish') ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group mb-3">
                    <label for="blog_type"><?= lang('blog_type_label') ?></label>
                    <select name="blog_type" id="blog_type" class="form-control" required>
                        <?php $currentBlogType = isset($_POST['blog_type']) ? (int) $_POST['blog_type'] : 4; ?>
                        <?php foreach ($blogTypes as $typeId => $typeLabel): ?>
                            <option value="<?= (int) $typeId ?>" <?= $currentBlogType === (int) $typeId ? 'selected' : '' ?>>
                                <?= esc($typeLabel) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Hidden translations -->
                <?php foreach ($languages as $language): ?>
                    <input type="hidden" name="translations[]" value="<?= esc($language->abbr) ?>">
                <?php endforeach; ?>

                <!-- Title Inputs -->
                <?php $titleIndex = 0; foreach ($languages as $language): ?>
                    <div class="form-group mb-3">
                        <label for="title<?= $titleIndex ?>">
                            <?= lang('title') ?> (<?= esc($language->name) ?> 
                            <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                            )
                        </label>
                        <input 
                            type="text" 
                            name="title[]" 
                            id="title<?= $titleIndex ?>"
                            value="<?= $trans_load && isset($trans_load[$language->abbr]['title']) ? esc($trans_load[$language->abbr]['title']) : '' ?>" 
                            class="form-control">
                    </div>
                <?php $titleIndex++; endforeach; ?>

                <!-- Descriptions -->
                <?php $i = 0; foreach ($languages as $language): ?>
                    <div class="form-group mb-3">
                        <label for="description<?= $i ?>">
                            <?= lang('description') ?> (<?= esc($language->name) ?> 
                            <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                            )
                        </label>
                        <textarea 
                            name="description[]" 
                            id="description<?= $i ?>" 
                            rows="8" 
                            class="form-control"><?= $trans_load && isset($trans_load[$language->abbr]['description']) ? esc($trans_load[$language->abbr]['description']) : '' ?></textarea>

                        <script>
                            var elFinderPath = "<?= base_url('/assets/elFinder-2.1.38/elfinder.src.php?integration=ckeditor&uid=' . session()->get('user_id')); ?>";                   
                            CKEDITOR.replace('description<?= $i ?>', {
                                filebrowserBrowseUrl: elFinderPath,
                                filebrowserImageBrowseUrl : elFinderPath + '&type=Images',
                                removeDialogTabs : 'link:upload;image:upload',
                                height: 500,
                            });
                            CKEDITOR.config.entities = false;
                        </script>
                    </div>
                <?php $i++; endforeach; ?>

                <!-- Image Upload -->
                <div class="form-group mb-3">
                    <?php if (isset($_POST['image'])): ?>
                        <input type="hidden" name="old_image" value="<?= esc($_POST['image']) ?>">
                        <div class="mb-2">
                            <img class="img-fluid rounded shadow-sm" 
                                 src="<?= base_url('attachments/blog_images/' . esc($_POST['image'])) ?>" 
                                 alt="Post image">
                        </div>
                        <label for="userfile"><?= lang('choose_another_image') ?>:</label>
                    <?php else: ?>
                        <label for="userfile"><?= lang('upload_image') ?>:</label>
                    <?php endif; ?>
                    <input type="file" id="userfile" name="userfile" class="form-control-file">
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" name="submit" class="btn btn-primary mr-2" value="save"><?= lang('publish') ?></button>
                    <?php if ($id > 0): ?>
                        <a href="<?= base_url('admin/blog') ?>" class="btn btn-secondary"><?= lang('cancel') ?></a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
