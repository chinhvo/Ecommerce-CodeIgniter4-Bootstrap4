<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('filemanager') ?>
    <link rel="stylesheet" href="<?= base_url('assets/js/jquery-ui.css'); ?>">
    <script src="<?= base_url('assets/js/jquery-ui.min.js'); ?>"></script>    
    <link rel="stylesheet" href="<?= base_url('assets/elFinder-2.1.38/css/elfinder.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/elFinder-2.1.38/css/theme.css'); ?>">
    <script src="<?= base_url('assets/elFinder-2.1.38/js/elfinder.min.js') ?>"></script>
    
    <script type="text/javascript">
      $(function () {
        $('#elfinder').elfinder({
          url: '<?= base_url('assets/elFinder-2.1.38/php/connector.minimal.php'); ?>'
        });
      });
    </script>
    
    <div class="container-fluid">
      <div class="row">
        <!-- If your layout already includes a sidebar, you can remove this column wrapper
             and keep only the "main" column below. -->
    
        <main role="main"
              class="col-12 col-sm-9 col-md-9 col-lg-10 ml-sm-auto ml-md-auto ml-lg-auto
                     pt-3 px-3">
    
          <div class="d-flex align-items-center mb-2">
            <img src="<?= base_url('assets/imgs/filemanager.png') ?>"
                 alt="File Manager"
                 class="mr-2"
                 style="height:32px;width:auto;">
            <h1 class="h3 mb-0">File Manager</h1>
          </div>
    
          <p class="text-muted mb-3">Here you can list all site files</p>
    
          <hr class="my-3">
    
          <div class="alert alert-danger" role="alert">
            <strong>Danger zone!</strong> Do not touch if you're not sure!
          </div>
    
          <div id="elfinder" class="mt-3"></div>
    
        </main>
      </div>
    </div>

<?= $this->endSection() ?>
