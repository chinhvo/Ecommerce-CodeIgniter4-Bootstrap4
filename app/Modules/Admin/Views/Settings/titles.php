<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('titles') ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2 pt-2">

      <h1 class="mb-3">
        <img
          src="<?= base_url('assets/imgs/seo_titles_descript.png') ?>"
          class="header-img"
          style="margin-top: -3px;"
          alt=""
        >
        Titles / Descriptions
      </h1>

      <hr>

      <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-6">
          <?php if (session()->getFlashdata('result_publish')): ?>
            <div class="alert alert-success mb-3">
              <?= session()->getFlashdata('result_publish') ?>
            </div>
            <hr>
          <?php endif; ?>

          <form action="" method="POST">
            <?php foreach ($languages as $language): ?>
              <input type="hidden" name="translations[]" value="<?= $language->abbr ?>">
            <?php endforeach; ?>

            <?php foreach ($seo_pages as $page): ?>
              <input type="hidden" name="pages[]" value="<?= $page['name'] ?>">
            <?php endforeach; ?>

            <?php foreach ($seo_pages as $page): ?>
              <div class="card mb-3">
                <div class="card-header bg-info text-white py-2">
                  <strong><?= $page['name'] ?></strong>
                </div>
                <div class="card-body">
                  <?php foreach ($languages as $language): ?>
                    <?php $titleId = 'seo_title_' . md5($page['name'] . '_' . $language->abbr); ?>
                    <div class="form-group">
                      <label class="d-block" for="<?= $titleId ?>">
                        Title (<?= htmlspecialchars($language->name) ?>
                        <img
                          src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
                          alt=""
                          style="height: 14px; margin-left: 4px;"
                        >)
                      </label>

                      <input
                        type="text"
                        id="<?= $titleId ?>"
                        name="title[]"
                        value="<?= @$seo_trans[$page['name']][$language->abbr]['title'] ?>"
                        class="form-control"
                      >
                    </div>
                  <?php endforeach; ?>

                  <?php foreach ($languages as $language): ?>
                    <?php $descriptionId = 'seo_description_' . md5($page['name'] . '_' . $language->abbr); ?>
                    <div class="form-group">
                      <label class="d-block" for="<?= $descriptionId ?>">
                        Description (<?= htmlspecialchars($language->name) ?>
                        <img
                          src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
                          alt=""
                          style="height: 14px; margin-left: 4px;"
                        >)
                      </label>

                      <input
                        type="text"
                        id="<?= $descriptionId ?>"
                        name="description[]"
                        value="<?= @$seo_trans[$page['name']][$language->abbr]['description'] ?>"
                        class="form-control"
                      >
                    </div>
                  <?php endforeach; ?>

                </div>
              </div>

            <?php endforeach; ?>

            <button type="submit" name="save" class="btn btn-secondary mb-2" value ="save" >
              Save
            </button>
          </form>

          <div class="alert alert-warning mt-3 mb-0">
            If you add new page with controller or in controller method.. insert
            her name in table <b>seo_pages</b>!
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
