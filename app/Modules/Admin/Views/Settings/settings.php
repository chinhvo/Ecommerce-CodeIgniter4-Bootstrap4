<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('settings') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">

	<h1>
		<img src="<?= base_url('assets/imgs/settings-page.png') ?>"
			class="header-img" style="margin-top: -3px;"><?= lang('settings_page_title') ?>
	</h1>
	<hr>
	<!-- ===================== GROUP: General ===================== -->
	<h5 class="mt-4 mb-2"><i class="fa fa-cog"></i> <?= lang('settings_group_general') ?></h5>
	<hr class="mt-0">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('site_logo') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultSiteLogoPublish')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultSiteLogoPublish') ?></div>
					<?php } ?>
					<img
						src="<?= base_url('attachments/site_logo/' . $sitelogo) ?>"
						alt="Logo is deleted. Upload new!" class="img-fluid">
					<hr>
					<form accept-charset="utf-8" method="post"
						enctype="multipart/form-data" action="">
						<input type="file" name="sitelogo" class="form-control mb-2" /> <input
							type="submit" value="<?= lang('upload_new') ?>" name="uploadimage"
							class="btn btn-secondary" />
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('navigation_text') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultNaviText')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultNaviText') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="naviText"
								value="<?= $navitext ?>" type="text">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('footer_text') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultFooterCopyright')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultFooterCopyright') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="footerCopyright"
								value="<?= $footercopyright ?>" type="text">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>

	<!-- ===================== GROUP: Contacts & Pages ===================== -->
	<h5 class="mt-4 mb-2"><i class="fa fa-envelope"></i> <?= lang('settings_group_contacts') ?></h5>
	<hr class="mt-0">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('contacts_page_header') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultContactspage')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultContactspage') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="form-group">
							<label for="contacts-page"><?= lang('contacts_page_content_label') ?></label>
							<textarea name="contactsPage" id="contacts-page"
								class="form-control"><?= $contactspage ?></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-secondary" type="submit">
								<?= lang('update') ?> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
			<script>
				CKEDITOR.replace('contacts-page');
				CKEDITOR.config.entities = false;
			</script>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('contacts_footer') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultfooterContacts')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultfooterContacts') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="form-group position-relative">
							<i class="fa fa-map-marker"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4" name="footerContactAddr"
								value="<?= $footerContactAddr ?>">
						</div>
						<div class="form-group position-relative">
							<i class="fa fa-phone"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4" name="footerContactPhone"
								value="<?= $footerContactPhone ?>">
						</div>
						<div class="form-group position-relative">
							<i class="fa fa-envelope"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4" name="footerContactEmail"
								value="<?= $footerContactEmail ?>">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-secondary"
								name="footerContacts" value="Update">
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('google_maps_header') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultGoogleMaps')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultGoogleMaps') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input class="form-control mb-2"
							placeholder="Direction: 42.676250, 23.371063" name="googleMaps"
							value="<?= $googleMaps ?>" type="text"> <input
							class="form-control mb-2" placeholder="Api key" name="googleApi"
							value="<?= $googleApi ?>" type="text">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('footer_about_us') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultFooterAboutUs')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultFooterAboutUs') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="form-group">
							<textarea name="footerAboutUs" id="footer-about-us"
								class="form-control"><?= $footerAboutUs ?></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-secondary" type="submit">
								<?= lang('update') ?> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			CKEDITOR.replace('footer-about-us');
			CKEDITOR.config.entities = false;
		</script>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('social_media_links') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultfooterSocial')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultfooterSocial') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="form-group position-relative">
							<i class="fa fa-facebook"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4"
								name="footerSocialFacebook" value="<?= $footerSocialFacebook ?>">
						</div>
						<div class="form-group position-relative">
							<i class="fa fa-twitter"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4" name="footerSocialTwitter"
								value="<?= $footerSocialTwitter ?>">
						</div>
						<div class="form-group position-relative">
							<i class="fa fa-google-plus"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4"
								name="footerSocialGooglePlus"
								value="<?= $footerSocialGooglePlus ?>">
						</div>
						<div class="form-group position-relative">
							<i class="fa fa-pinterest"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4"
								name="footerSocialPinterest"
								value="<?= $footerSocialPinterest ?>">
						</div>
						<div class="form-group position-relative">
							<i class="fa fa-youtube"
								style="position: absolute; top: 10px; left: 10px;"></i> <input
								type="text" class="form-control pl-4" name="footerSocialYoutube"
								value="<?= $footerSocialYoutube ?>">
						</div>
						<div class="form-group position-relative">
							<img src="/attachments/site_logo/zalo.png" alt="Zalo"
								style="position: absolute; top: 8px; left: 8px; width:18px; height:18px; object-fit:contain;">
							<input type="text" class="form-control pl-4" name="footerSocialZalo"
								placeholder="https://zalo.me/..."
								value="<?= esc($footerSocialZalo ?? '') ?>">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-secondary"
								name="footerSocial" value="Update">
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('email_contact_form_to') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('resultEmailTo')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('resultEmailTo') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="contactsEmailTo"
								value="<?= $contactsEmailTo ?>" type="text">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>

	<!-- ===================== GROUP: Shipping ===================== -->
	<h5 class="mt-4 mb-2"><i class="fa fa-truck"></i> <?= lang('settings_group_shipping') ?></h5>
	<hr class="mt-0">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('free_shipping_setting') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('shippingOrder')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('shippingOrder') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="shippingOrder"
								value="<?= $shippingOrder ?>" type="text">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('shipping_amount_setting') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('shippingAmount')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('shippingAmount') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="shippingAmount"
								value="<?= isset($shippingAmount) ? $shippingAmount : '' ?>"
								type="text">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>

	<!-- ===================== GROUP: Advanced ===================== -->
	<h5 class="mt-4 mb-2"><i class="fa fa-code"></i> <?= lang('settings_group_advanced') ?></h5>
	<hr class="mt-0">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('add_js_to_site') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('addJs')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('addJs') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<textarea style="margin-bottom: 5px;" name="addJs"
							class="form-control"><?= $addJs ?></textarea>
						<button class="btn btn-secondary" type="submit"><?= lang('add_the_code') ?></button>
					</form>
				</div>
			</div>
		</div>

	</div>

	<!-- ===================== GROUP: Products ===================== -->
	<h5 class="mt-4 mb-2"><i class="fa fa-shopping-bag"></i> <?= lang('settings_group_products') ?></h5>
	<hr class="mt-0">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('public_quantity_visibility') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('publicQuantity')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('publicQuantity') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="publicQuantity"
							value="<?= $publicQuantity ?>"> <input
							<?= $publicQuantity == 1 ? 'checked' : '' ?> data-toggle="toggle"
							data-for-field="publicQuantity" class="toggle-changer"
							type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('public_date_added_visibility') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('publicDateAdded')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('publicDateAdded') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="publicDateAdded"
							value="<?= $publicDateAdded ?>"> <input
							<?= $publicDateAdded == 1 ? 'checked' : '' ?>
							data-toggle="toggle" data-for-field="publicDateAdded"
							class="toggle-changer" type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('multi_vendor_support') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('multiVendor')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('multiVendor') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="multiVendor"
							value="<?= $multiVendor ?>"> <input
							<?= $multiVendor == 1 ? 'checked' : '' ?> data-toggle="toggle"
							data-for-field="multiVendor" class="toggle-changer"
							type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('show_out_of_stock') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('outOfStock')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('outOfStock') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="outOfStock" value="<?= $outOfStock ?>">
						<input <?= $outOfStock == 1 ? 'checked' : '' ?>
							data-toggle="toggle" data-for-field="outOfStock"
							class="toggle-changer" type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('hide_buy_out_of_stock') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('hideBuyButtonsOfOutOfStock')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('hideBuyButtonsOfOutOfStock') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="hideBuyButtonsOfOutOfStock"
							value="<?= $hideBuyButtonsOfOutOfStock ?>"> <input
							<?= $hideBuyButtonsOfOutOfStock == 1 ? 'checked' : '' ?>
							data-toggle="toggle" data-for-field="hideBuyButtonsOfOutOfStock"
							class="toggle-changer" type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('no_cart_after_add') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('refreshAfterAddToCart')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('refreshAfterAddToCart') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="refreshAfterAddToCart"
							value="<?= $refreshAfterAddToCart ?>"> <input
							<?= $refreshAfterAddToCart == 1 ? 'checked' : '' ?>
							data-toggle="toggle" data-for-field="refreshAfterAddToCart"
							class="toggle-changer" type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('show_more_info_btn') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('moreInfoBtn')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('moreInfoBtn') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="moreInfoBtn"
							value="<?= $moreInfoBtn ?>"> <input
							<?= $moreInfoBtn == 1 ? 'checked' : '' ?> data-toggle="toggle"
							data-for-field="moreInfoBtn" class="toggle-changer"
							type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('show_brands_setting') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('showBrands')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('showBrands') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="showBrands" value="<?= $showBrands ?>">
						<input <?= $showBrands == 1 ? 'checked' : '' ?>
							data-toggle="toggle" data-for-field="showBrands"
							class="toggle-changer" type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('show_in_slider_setting') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('showInSlider')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('showInSlider') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="showInSlider"
							value="<?= $showInSlider ?>"> <input
							<?= $showInSlider == 1 ? 'checked' : '' ?> data-toggle="toggle"
							data-for-field="showInSlider" class="toggle-changer"
							type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('virtual_products_setting') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('virtualProducts')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('virtualProducts') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="virtualProducts"
							value="<?= $virtualProducts ?>"> <input
							<?= $virtualProducts == 1 ? 'checked' : '' ?>
							data-toggle="toggle" data-for-field="virtualProducts"
							class="toggle-changer" type="checkbox">
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- ===================== GROUP: Homepage ===================== -->
	<h5 class="mt-4 mb-2"><i class="fa fa-home"></i> <?= lang('settings_group_homepage') ?></h5>
	<hr class="mt-0">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('new_products_limit') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('newProductsLimit')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('newProductsLimit') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="newProductsLimit" type="number" min="1"
								value="<?= isset($newProductsLimit) ? (int)$newProductsLimit : 5 ?>">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('last_blogs_limit') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('lastBlogsLimit')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('lastBlogsLimit') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="lastBlogsLimit" type="number" min="1"
								value="<?= isset($lastBlogsLimit) ? (int)$lastBlogsLimit : 6 ?>">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- ===================== GROUP: Legal ===================== -->
	<h5 class="mt-4 mb-2"><i class="fa fa-balance-scale"></i> <?= lang('orthers_settings') ?></h5>
	<hr class="mt-0">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white"><?= lang('cookie_law_notification') ?></div>
				<div class="card-body">
					<?php if (session()->getFlashdata('cookieNotificator')) { ?>
						<div class="alert alert-info"><?= session()->getFlashdata('cookieNotificator') ?></div>
					<?php } ?>
					<form method="POST" action="">
						<input type="hidden" name="visibility"
							value="<?= isset($cookieLawInfo['cookieInfo']['visibility']) ? $cookieLawInfo['cookieInfo']['visibility'] : '0' ?>">
						<label for="cookie_law_visibility"><?= lang('enable_label') ?></label> <input id="cookie_law_visibility"
							<?= isset($cookieLawInfo['cookieInfo']['visibility']) && $cookieLawInfo['cookieInfo']['visibility'] == 1 ? 'checked' : '' ?>
							data-toggle="toggle" data-for-field="visibility"
							class="toggle-changer" type="checkbox">
						<hr>

						<?php foreach ($languages as $language) { ?>
							<input type="hidden" name="translations[]"
								value="<?= $language->abbr ?>">
						<?php } ?>

						<?php foreach ($languages as $language) { ?>
							<div class="form-group">
								<label for="message-cookie-law-<?= htmlspecialchars($language->abbr) ?>">Message (<?= htmlspecialchars($language->name) ?>
									<img
										src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
										alt="">)
								</label> <input type="text" name="message[]"
									value="<?= isset($cookieLawInfo['cookieTranslate'][$language->abbr]['message']) ? $cookieLawInfo['cookieTranslate'][$language->abbr]['message'] : '' ?>"
									class="form-control" id="message-cookie-law-<?= htmlspecialchars($language->abbr) ?>">
							</div>
						<?php } ?>

						<?php foreach ($languages as $language) { ?>
							<div class="form-group">
								<label for="btn-cookie-law-<?= htmlspecialchars($language->abbr) ?>">Button Text (<?= htmlspecialchars($language->name) ?>
									<img
										src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
										alt="">)
								</label> <input type="text" name="button_text[]"
									value="<?= isset($cookieLawInfo['cookieTranslate'][$language->abbr]['button_text']) ? $cookieLawInfo['cookieTranslate'][$language->abbr]['button_text'] : '' ?>"
									class="form-control" id="btn-cookie-law-<?= htmlspecialchars($language->abbr) ?>">
							</div>
						<?php } ?>

						<?php foreach ($languages as $language) { ?>
							<div class="form-group">
								<label for="learn_more_<?= htmlspecialchars($language->abbr) ?>">Learn More (<?= htmlspecialchars($language->name) ?>
									<img
										src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
										alt="">):
								</label> <input type="text" name="learn_more[]"
									value="<?= isset($cookieLawInfo['cookieTranslate'][$language->abbr]['learn_more']) ? $cookieLawInfo['cookieTranslate'][$language->abbr]['learn_more'] : '' ?>"
									class="form-control" id="learn_more_<?= htmlspecialchars($language->abbr) ?>">
							</div>
						<?php } ?>

						<div class="form-group">
							<label for="link-cookie-law"><i class="fa fa-link"
									aria-hidden="true"></i> Link to learn more (the law):</label> <input
								type="text" name="link"
								value="<?= isset($cookieLawInfo['cookieInfo']['link']) ? $cookieLawInfo['cookieInfo']['link'] : '' ?>"
								class="form-control" id="link-cookie-law">
						</div>

						<div class="form-group">
							<label for="cookie_theme">Theme choose:</label> <input type="hidden" id="cookie_theme" name="theme"
								value="<?= isset($cookieLawInfo['cookieInfo']['theme']) ? $cookieLawInfo['cookieInfo']['theme'] : '' ?>">
							<div class="row cookie-law-themes bg-info p-2 rounded">
								<?php foreach ($law_themes as $theme) { ?>
									<div class="col-sm-6 mb-3">
										<a href="javascript:void(0);" class="select-law-theme"
											data-law-theme="<?= str_replace('.png', '', $theme) ?>"> <img
												src="<?= base_url('assets/imgs/cookie-law-themes/' . $theme) ?>"
												class="img-fluid theme" alt="<?= $theme ?>"> <img
												src="<?= base_url('assets/imgs/ok-themes.png') ?>"
												<?= isset($cookieLawInfo['cookieInfo']['theme']) && $cookieLawInfo['cookieInfo']['theme'] == str_replace('.png', '', $theme) ? 'style="display:block;"' : '' ?>
												class="ok" alt="CHOSEN">
										</a>
									</div>
								<?php } ?>
							</div>
						</div>

						<button class="btn btn-secondary" name="setCookieLaw"
							type="submit" value="saveCookieLaw"><?= lang('save') ?></button>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>
<?= $this->endSection() ?>