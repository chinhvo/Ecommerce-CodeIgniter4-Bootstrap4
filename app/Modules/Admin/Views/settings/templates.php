<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('templates') ?>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<h1>
		<img src="<?= base_url('assets/imgs/template-admin-logo.png') ?>"
			class="header-img align-middle mr-2" style="margin-top: -2px;">
		Templates
	</h1>
	<hr>

	<form id="saveTemplate" method="POST" action="">
    <?= csrf_field() ?>
    <input type="hidden" name="template" class="template-name" value="">
	</form>

	<div class="row">
        <?php foreach ($templates as $template): ?>
            <div class="col-sm-6 col-md-4 mb-4">
    			<div class="card h-100 text-center">
    				<div class="card-body">
    					<h5 class="card-title"><?= esc($template) ?></h5>
    					<a href="javascript:void(0);" data-form-id="saveTemplate"
    						data-template-name="<?= esc($template) ?>"
    						class="confirm-save choose-template d-block position-relative"> <img
    						src="<?= base_url('assets/templates/' . $template . '/imgs/screenshot.png' ) ?>"
    						alt="Template Name: <?= esc($template) ?>"
    						class="img-fluid img-thumbnail">
    
                            <?php if ($seleced_template == $template): ?>
                                <img
    						class="selected-template position-absolute" alt="CHOSEN"
    						src="<?= base_url('assets/imgs/ok-themes.png') ?>"
    						style="top: 10px; right: 10px; width: 40px;">
                            <?php endif; ?>
                        </a>
    				</div>
    			</div>
    		</div>
        <?php endforeach; ?>
	</div>
</div>
<?= $this->endSection() ?>