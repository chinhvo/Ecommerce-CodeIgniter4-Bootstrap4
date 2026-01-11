<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('settings') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">

	<h1>
		<img src="<?= base_url('assets/imgs/settings-page.png') ?>"
			class="header-img" style="margin-top: -3px;">Settings
	</h1>
	<hr>
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white">Site Logo</div>
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
							type="submit" value="Upload New" name="uploadimage"
							class="btn btn-secondary" />
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white">Navigation Text</div>
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
				<div class="card-header bg-success text-white">Footer Text</div>
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

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white">Contacts page</div>
				<div class="card-body">
            <?php if (session()->getFlashdata('resultContactspage')) { ?>
                <div class="alert alert-info"><?= session()->getFlashdata('resultContactspage') ?></div>
            <?php } ?>
            <form method="POST" action="">
						<div class="form-group">
							<textarea name="contactsPage" id="contacts-page"
								class="form-control"><?= $contactspage ?></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-secondary" type="submit">
								Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
				<div class="card-header bg-success text-white">Contacts footer</div>
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
				<div class="card-header bg-success text-white">Google Maps</div>
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
				<div class="card-header bg-success text-white">Footer about us</div>
				<div class="card-body">
            <?php if (session()->getFlashdata('resultFooterAboutUs')) { ?>
                <div class="alert alert-info"><?= session()->getFlashdata('resultFooterAboutUs') ?></div>
            <?php } ?>
            <form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="footerAboutUs"
								value="<?= $footerAboutUs ?>" type="text">
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
				<div class="card-header bg-success text-white">Social media links</div>
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
				<div class="card-header bg-success text-white">Send email from
					contact form to:</div>
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

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white">Free Shipping for
					order equal or more than (Final purchase amount):</div>
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
				<div class="card-header bg-success text-white">Shipping amount
					(leave 0 or empty for no shipping price):</div>
				<div class="card-body">
            <?php if (session()->getFlashdata('shippingAmount')) { ?>
                <div class="alert alert-info"><?= session()->getFlashdata('shippingAmount') ?></div>
            <?php } ?>
            <form method="POST" action="">
						<div class="input-group">
							<input class="form-control" name="shippingAmount"
								value="<?= isset($shippingAmount) ? $shippingAmount: '' ?>"
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

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white">Add google or other
					JavaScript to site</div>
				<div class="card-body">
            <?php if (session()->getFlashdata('addJs')) { ?>
                <div class="alert alert-info"><?= session()->getFlashdata('addJs') ?></div>
            <?php } ?>
            <form method="POST" action="">
						<textarea style="margin-bottom: 5px;" name="addJs"
							class="form-control"><?= $addJs ?></textarea>
						<button class="btn btn-secondary" type="submit">Add the code</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white">Public quantity
					visibility</div>
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
				<div class="card-header bg-success text-white">Public date added
					visibility</div>
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
				<div class="card-header bg-success text-white">Multi-Vendor Support</div>
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
				<div class="card-header bg-success text-white">Show in list out of
					stock products</div>
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
				<div class="card-header bg-success text-white">Hide buy button if
					product is shown but is out of stock</div>
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
				<div class="card-header bg-success text-white">Do not open shopping
					cart after add product to it</div>
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
				<div class="card-header bg-success text-white">Show 'More
					information' button in products list</div>
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
				<div class="card-header bg-success text-white">Show brands</div>
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
				<div class="card-header bg-success text-white">Show in slider
					products to list</div>
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
				<div class="card-header bg-success text-white">Cookie Law
					Notification</div>
				<div class="card-body">
            <?php if (session()->getFlashdata('cookieNotificator')) { ?>
                <div class="alert alert-info"><?= session()->getFlashdata('cookieNotificator') ?></div>
            <?php } ?>
            <form method="POST" action="">
						<input type="hidden" name="visibility"
							value="<?= isset($cookieLawInfo['cookieInfo']['visibility']) ? $cookieLawInfo['cookieInfo']['visibility'] : '0' ?>">
						<label>Enable:</label> <input
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
							<label for="message-cookie-law">Message (<?= htmlspecialchars($language->name) ?>
                            <img
								src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
								alt="">)
							</label> <input type="text" name="message[]"
								value="<?= isset($cookieLawInfo['cookieTranslate'][$language->abbr]['message']) ? $cookieLawInfo['cookieTranslate'][$language->abbr]['message'] : '' ?>"
								class="form-control" id="message-cookie-law">
						</div>
                <?php } ?>

                <?php foreach ($languages as $language) { ?>
                    <div class="form-group">
							<label for="btn-cookie-law">Button Text (<?= htmlspecialchars($language->name) ?>
                            <img
								src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
								alt="">)
							</label> <input type="text" name="button_text[]"
								value="<?= isset($cookieLawInfo['cookieTranslate'][$language->abbr]['button_text']) ? $cookieLawInfo['cookieTranslate'][$language->abbr]['button_text'] : '' ?>"
								class="form-control" id="btn-cookie-law">
						</div>
                <?php } ?>

                <?php foreach ($languages as $language) { ?>
                    <div class="form-group">
							<label for="learn_more">Learn More (<?= htmlspecialchars($language->name) ?>
                            <img
								src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>"
								alt="">):
							</label> <input type="text" name="learn_more[]"
								value="<?= isset($cookieLawInfo['cookieTranslate'][$language->abbr]['learn_more']) ? $cookieLawInfo['cookieTranslate'][$language->abbr]['learn_more'] : '' ?>"
								class="form-control" id="learn_more">
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
							<label>Theme choose:</label> <input type="hidden" name="theme"
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
							type="submit" value="saveCookieLaw">Save</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="card border-success col-h">
				<div class="card-header bg-success text-white">Virtual products</div>
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
</div>
<?= $this->endSection() ?>