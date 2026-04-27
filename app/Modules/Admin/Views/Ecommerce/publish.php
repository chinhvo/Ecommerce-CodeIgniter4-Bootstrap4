<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('publish-product') ?>
<div class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
	<h1>
		<img src="<?= base_url('assets/imgs/shop-cart-add-icon.png') ?>" class="header-img" style="margin-top: -3px;"> 
        Publish product
	</h1>
	<hr>
<?php
$timeNow = time();
$uri = service('uri');
if (isset($validation) && count($validation->getErrors()) > 0 ) {
    ?>
    <hr>aaada
	<div class="alert alert-danger"><?= $validation->getErrors() ?></div>
	<hr>
    <?php
}
if (session()->getFlashdata('result_publish')) {
    ?>
    <hr>aaa
	<div class="alert alert-success"><?= session()->getFlashdata('result_publish') ?></div>
	<hr>
    <?php
}
?>
<form method="POST" action="<?= base_url() ?>admin/publish" enctype="multipart/form-data">
		<input type="hidden"
			value="<?= isset($_POST['folder']) ? htmlspecialchars($_POST['folder']) : $timeNow ?>"
			name="folder">
		<div class="form-group available-translations">
			<b>Languages</b>
        <?php foreach ($languages as $language) { ?>
            <button type="button"
				data-locale-change="<?= htmlspecialchars($language->abbr) ?>"
				class="btn btn-light locale-change text-uppercase <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'active' : '' ?>">
				<img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                <?= htmlspecialchars($language->abbr) ?>
            </button>
        <?php } ?>
    </div>
    <?php
    $i = 0;
    foreach ($languages as $language) {
        ?>
        <div class="locale-container locale-container-<?= htmlspecialchars($language->abbr) ?>" <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'style="display:block;"' : '' ?>>
			<input type="hidden" name="translations[]" value="<?= htmlspecialchars($language->abbr) ?>">
			<div class="form-group">
				<label for="title<?= $i ?>">Title (<?= htmlspecialchars($language->name) ?>
					<img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)
				</label> 
				<input type="text" id="title<?= $i ?>" name="title[]" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['title']) ? $trans_load[$language->abbr]['title'] : '' ?>" class="form-control">
			</div>

			<div class="form-group">
				<a href="javascript:void(0);" class="btn btn-secondary showSliderDescrption" data-descr="<?= $i ?>">
					Show Slider Description <i class="fa fa-arrow-circle-down"></i>
				</a>
			</div>
			<div class="theSliderDescrption" id="theSliderDescrption-<?= $i ?>" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 1 ? 'style="display:block;"' : '' ?>>
				<div class="form-group">
					<label for="basic_description<?= $i ?>">Slider Description (<?= htmlspecialchars($language->name) ?><img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)
					</label>
					<textarea name="basic_description[]" id="basic_description<?= $i ?>" rows="50" class="form-control"><?= $trans_load != null && isset($trans_load[$language->abbr]['basic_description']) ? $trans_load[$language->abbr]['basic_description'] : '' ?></textarea>
					<script>
                        CKEDITOR.replace('basic_description<?= $i ?>');
                        CKEDITOR.config.entities = false;
                    </script>
				</div>
			</div>
			<div class="form-group">
				<label for="description<?= $i ?>">Description (<?= htmlspecialchars($language->name) ?><img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)
				</label>
				<textarea name="description[]" id="description<?= $i ?>" rows="50" class="form-control"><?= $trans_load != null && isset($trans_load[$language->abbr]['description']) ? $trans_load[$language->abbr]['description'] : '' ?></textarea>
				<script>
                    CKEDITOR.replace('description<?= $i ?>');
                    CKEDITOR.config.entities = false;
                </script>
			</div>
			<div class="form-group for-shop">
				<label for="price<?= $i ?>">Price (<?= htmlspecialchars($language->name) ?><img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)
				</label> 
				<input type="text" id="price<?= $i ?>" name="price[]" placeholder="without currency at the end"
					value="<?= $trans_load != null && isset($trans_load[$language->abbr]['price']) ? $trans_load[$language->abbr]['price'] : '' ?>" class="form-control">
			</div>
			<div class="form-group for-shop">
				<label for="old_price<?= $i ?>">Old Price (<?= htmlspecialchars($language->name) ?><img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)
				</label> 
				<input type="text" id="old_price<?= $i ?>" name="old_price[]" placeholder="without currency at the end"
					value="<?= $trans_load != null && isset($trans_load[$language->abbr]['old_price']) ? $trans_load[$language->abbr]['old_price'] : '' ?>" class="form-control">
			</div>
		</div>
        <?php
        $i ++;
    }
    ?>
    <div class="form-group bordered-group">
        <?php
        if (isset($_POST['image']) && $_POST['image'] != null) {
            $image = 'attachments/shop_images/' . htmlspecialchars($_POST['image']);
            if (! file_exists($image)) {
                $image = 'attachments/no-image.png';
            }
            ?>
            <p>Current image:</p>
			<div>
				<img src="<?= base_url($image) ?>" class="img-fluid img-thumbnail" style="max-width: 300px; margin-bottom: 5px;">
			</div>
			<input type="hidden" name="old_image" value="<?= htmlspecialchars($_POST['image']) ?>">
            <?php if (isset($_GET['to_lang'])) { ?>
                <input type="hidden" name="image" value="<?= htmlspecialchars($_POST['image']) ?>">
                <?php
            }
        }
        ?>
        <label for="userfile">Cover Image</label> <input type="file" id="userfile" name="userfile">
		</div>
		<div class="form-group bordered-group">
			<div class="others-images-container">
            <?= $otherImgs ?>
        </div>
			<a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-secondary">Upload more images</a>
		</div>
		<div class="form-group for-shop">
			<label for="shop_categorie">Shop Categories</label> 
			<select class="selectpicker form-control show-tick show-menu-arrow" name="shop_categorie" id="shop_categorie">
            <?php foreach ($shop_categories as $key_cat => $shop_categorie) { ?>
                <option <?= isset($_POST['shop_categorie']) && $_POST['shop_categorie'] == $key_cat ? 'selected=""' : '' ?> value="<?= $key_cat ?>">
                    <?php
                foreach ($shop_categorie['info'] as $nameAbbr) {
                    if ($nameAbbr['abbr'] == config('App')->languageAbbr) {
                        echo $nameAbbr['name'];
                    }
                }
                ?>
                </option>
            <?php } ?>
        </select>
		</div>
		<div class="form-group for-shop">
			<label>Quantity</label> 
            <input type="number" placeholder="number" name="quantity"
				value="<?= isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '' ?>"
				class="form-control" id="quantity">
		</div>
    <?php if ($showBrands == 1) { ?>
        <div class="form-group for-shop">
			<label for="brand_id">Brand</label> 
			<select class="selectpicker" name="brand_id" id="brand_id">
                <?php foreach ($brands as $brand) { ?>
                    <option <?= isset($_POST['brand_id']) && $_POST['brand_id'] == $brand['id'] ? 'selected' : '' ?> value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                <?php } ?>
            </select>
		</div>
    <?php } if ($virtualProducts == 1) { ?>
        <div class="form-group for-shop">
			<label for="virtual_products">Virtual Products 
                <a href="javascript:void(0);" data-toggle="modal" data-target="#virtualProductsHelp">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                </a>
            </label>
			<textarea class="form-control" name="virtual_products" id="virtual_products"><?= isset($_POST['virtual_products']) ? htmlspecialchars($_POST['virtual_products']) : '' ?></textarea>
		</div>
    <?php } ?>
    <div class="form-group for-shop">
			<label for="in_slider">In Slider</label> 
			<select class="selectpicker" name="in_slider" id="in_slider">
				<option value="1" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 1 ? 'selected' : '' ?>>Yes</option>
				<option value="0" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 0 || !isset($_POST['in_slider']) ? 'selected' : '' ?>>No</option>
			</select>
		</div>
		<div class="form-group for-shop">
			<label for="highlighted">Highlighted</label>
			<select class="selectpicker" name="highlighted" id="highlighted">
				<option value="1" <?= isset($_POST['highlighted']) && $_POST['highlighted'] == 1 ? 'selected' : '' ?>>Yes</option>
				<option value="0" <?= isset($_POST['highlighted']) && $_POST['highlighted'] == 0 || !isset($_POST['highlighted']) ? 'selected' : '' ?>>No</option>
			</select>
		</div>
		<div class="form-group for-shop">
			<label for="position">Position</label> 
			<input type="number" placeholder="Position number" name="position" id="position"
				value="<?= isset($_POST['position']) ? htmlspecialchars($_POST['position']) : '' ?>" class="form-control">
		</div>
		<button type="submit" name="submit" class="btn btn-lg btn-secondary btn-publish" value="save">Publish</button>
    <?php if ($uri->getSegment(3) !== null) { ?>
        <a href="<?= base_url('admin/products') ?>" class="btn btn-lg btn-secondary">Cancel</a>
    <?php } ?>
  
    <input type="hidden" name="item_id" value="<?= $id ?>" name="item_id">
</form>
	<!-- Modal Upload More Images -->
	<div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Upload more images</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="uploadImagesForm">
						<input type="hidden" value="<?= isset($_POST['folder']) ? htmlspecialchars($_POST['folder']) : $timeNow ?>" name="folder"> 
                        <label for="others">Select images</label> 
                        <input type="file" name="others[]" id="others" multiple />
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary finish-upload">
						<span class="finish-text">Finish</span> 
                        <img src="<?= base_url('assets/imgs/load.gif') ?>" class="loadUploadOthers" alt="">
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- virtualProductsHelp -->
	<div class="modal fade" id="virtualProductsHelp" tabindex="-1" role="dialog" aria-labelledby="virtualProductsHelp" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5 class="modal-title">What are virtual products?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
                    Sometimes we want to sell products that are for electronic use such as books. 
                    In the box below, you can enter links to products that can be downloaded after 
                    you confirm the order as "Processed" through the "Orders" tab, an email will be 
                    sent to the customer entered with the entire text entered in the "virtual products" 
                    field. We have left only the possibility to add links in this field because sometimes 
                    it is necessary that the electronic stuff you provide for downloading will be uploaded 
                    to other servers. If you want, you can add your files to "file manager" and take the 
                    links to them to add to the "virtual products"
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
