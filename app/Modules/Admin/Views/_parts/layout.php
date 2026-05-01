<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= $description ?>">
	<title><?= $title ?></title>
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>"
		rel="stylesheet">
	<link
		href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>"
		rel="stylesheet">
	<link rel="stylesheet"
		href="<?= base_url('assets/bootstrap-select/css/bootstrap-select.min.css') ?>">
	<link href="<?= base_url('assets/css/bootstrap4-toggle.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/custom-admin.css') ?>"
		rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Inconsolata'
		rel='stylesheet' type='text/css'>
	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
</head>

<body>
	<div id="wrapper">
		<div id="content">
			<?= $this->include('\App\Modules\Admin\Views\_parts\header') ?>
			<div class="container-fluid">
				<div class="row">
					<?= $this->include('\App\Modules\Admin\Views\_parts\leftSidebar') ?>
					<?php if (!session()->get('logged_in')) { ?>
						<?= $this->include('\App\Modules\Admin\Views\Home\login') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "home")) { ?>
						<?= $this->renderSection('home') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "publish")) { ?>
						<?= $this->renderSection('publish-product') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "shopcategories")) { ?>
						<?= $this->renderSection('shop-categories') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "products")) { ?>
						<?= $this->renderSection('products') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "orders")) { ?>
						<?= $this->renderSection('orders') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "discounts")) { ?>
						<?= $this->renderSection('discounts') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "blogpublish")) { ?>
						<?= $this->renderSection('blogpublish') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "blog")) { ?>
						<?= $this->renderSection('blogposts') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "settings")) { ?>
						<?= $this->renderSection('settings') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "styling")) { ?>
						<?= $this->renderSection('styling') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "templates")) { ?>
						<?= $this->renderSection('templates') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "titles")) { ?>
						<?= $this->renderSection('titles') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "pages")) { ?>
						<?= $this->renderSection('pages') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "emails")) { ?>
						<?= $this->renderSection('emails') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "contact-messages")) { ?>
						<?= $this->renderSection('contact_messages') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "history")) { ?>
						<?= $this->renderSection('history') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "languages")) { ?>
						<?= $this->renderSection('languages') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "filemanager")) { ?>
						<?= $this->renderSection('filemanager') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "adminusers")) { ?>
						<?= $this->renderSection('adminusers') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "listvendors")) { ?>
						<?= $this->renderSection('listvendors') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "sliders")) { ?>
						<?= $this->renderSection('sliders') ?>
					<?php } ?>
					<?php if (session()->get('logged_in') && strpos(uri_string(), "showrooms")) { ?>
						<?= $this->renderSection('showrooms') ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<?= $this->include('\App\Modules\Admin\Views\_parts\footer') ?>
	</div>
	<script
		src="<?= base_url('assets/bootstrap-select/js/bootstrap-select.js') ?>"></script>
	<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap4-toggle.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootbox.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/zxcvbn.js') ?>"></script>
	<script src="<?= base_url('assets/js/zxcvbn_bootstrap3.js') ?>"></script>
	<script src="<?= base_url('assets/js/pGenerator.jquery.js') ?>"></script>
	<script>
		var urls = {
			changePass: '<?= base_url('admin/changePass') ?>',
			editShopCategorie: '<?= base_url('admin/editshopcategorie') ?>',
			changeTextualPageStatus: '<?= base_url('admin/changePageStatus') ?>',
			removeSecondaryImage: '<?= base_url('admin/removeSecondaryImage') ?>',
			productstatusChange: '<?= base_url('admin/productstatusChange') ?>',
			productsOrderBy: '<?= base_url('admin/products?orderby=') ?>',
			productStatusChange: '<?= base_url('admin/productStatusChange') ?>',
			changeOrdersOrderStatus: '<?= base_url('admin/changeOrdersOrderStatus') ?>',
			ordersOrderBy: '<?= base_url('admin/orders?order_by=') ?>',
			uploadOthersImages: '<?= base_url('admin/uploadOthersImages') ?>',
			loadOthersImages: '<?= base_url('admin/loadOthersImages') ?>',
			editPositionCategorie: '<?= base_url('admin/changePosition') ?>'
		};
	</script>
	<script src="<?= base_url('assets/js/mine_admin.js') ?>"></script>
</body>

</html>