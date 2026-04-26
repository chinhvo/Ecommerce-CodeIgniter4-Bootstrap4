<header>
<?php if (!empty($multiVendor) && $multiVendor == 1): ?>
		<div id="top-user-panel">
		<div class="container">
			<a href="<?= LANG_URL . '/vendor/register' ?>"
				class="btn btn-secondary"><?= lang('register_me') ?></a>
			<form class="form-inline" method="POST"
				action="<?= LANG_URL . '/vendor/login' ?>">
				<div class="form-group">
					<input type="email" name="u_email" class="form-control"
						placeholder="<?= lang('email') ?>">
				</div>
				<div class="form-group">
					<input type="password" name="u_password" class="form-control"
						placeholder="<?= lang('password') ?>">
				</div>
				<div class="checkbox">
					<label> <input type="checkbox" name="remember_me"><?= lang('remember_me') ?>
						</label>
				</div>
				<button type="submit" name="login" class="btn btn-secondary"><?= lang('u_login') ?></button>
			</form>
		</div>
	</div>
<?php endif; ?>
	<div class="languages-bar">
		<div class="container">
            <?php
            $num_langs = count($allLanguages);
            if ($num_langs > 0) {
                ?>
                <ul class="float-left">
                    <?php
                $i = 1;
                $lang_last = '';
                foreach ($allLanguages as $key_lang => $lang) {
                    ?>
						<li <?= $i == $num_langs ? 'class="last-item"' : '' ?>><img
					src="<?= base_url('attachments/lang_flags/' . $lang['flag']) ?>"
					alt="Language-<?= MY_LANGUAGE_ABBR ?>"> <a
					href="<?= base_url($key_lang) ?>"><?= $lang['name'] ?></a></li>
                        <?php
                    $i ++;
                }
                ?>
                </ul>
            <?php } ?>
        </div>
	</div>
	<div class="container">
		<div class="row logo-and-search">
			<div class="col-sm-5 logo-col">
				<a href="<?= base_url() ?>"> <img
					src="<?= base_url('attachments/site_logo/' . $sitelogo) ?>"
					class="site-logo" alt="<?= $_SERVER['HTTP_HOST'] ?>">
				</a>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<div class="col-sm-5">
						<div class="bag-info">
							<img src="<?= base_url('template/imgs/white-bag.png') ?>"
								alt="Search"> <a class="my-basket dropdown-toggle"
								data-toggle="dropdown" role="button" aria-expanded="false">
                                        <?= lang('your_basket') ?>
								<span class="sum-scope"> (<span class="sumOfItems"><?php echo !is_array($cartItems) || (!isset($cartItems['array']) || count($cartItems['array'])) < 1 ? lang('empty') : $sumOfItems ?></span>)
							</span> <i class="fa fa-angle-double-down" aria-hidden="true"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right dropdown-cart"
								role="menu">
								<?= $load::getCartItems(is_array($cartItems) ? $cartItems : []) ?>							</ul>
						</div>
					</div>
					<div class="col-sm-7">
						<form method="GET" id="bigger-search" class="search"
							action="<?= LANG_URL ?>">
							<div class="input-group">
								<input type="text" id="search_in_title"
									value="<?= isset($_GET['search_in_title']) ? htmlspecialchars($_GET['search_in_title']) : '' ?>"
									class="form-control" placeholder="<?= lang('search_for') ?>...">
								<span class="input-group-btn">
									<button class="btn btn-red cloth-bg-color"
										onclick="submitForm()" type="button">
										<i class="fa fa-search" aria-hidden="true"></i>
									</button>
								</span>
								<div class="dropdown">
									<a class="advanced-search-btn dropdown-toggle"
										href="javascript:void(0);" id="dropdownsearch"
										data-toggle="dropdown"> <i
										class="fa fa-2x fa-caret-down cloth-color" aria-hidden="true"></i>
									</a>
									<div
										class="dropdown-menu dropdown-menu-right advanced-search-menu"
										role="menu" aria-labelledby="dropdownsearch">
										<input type="hidden" name="category"
											value="<?= isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '' ?>">
										<input type="hidden" name="in_stock"
											value="<?= isset($_GET['in_stock']) ? htmlspecialchars($_GET['in_stock']) : '' ?>">
										<input type="hidden" name="search_in_title"
											value="<?= isset($_GET['search_in_title']) ? htmlspecialchars($_GET['search_in_title']) : '' ?>">
										<input type="hidden" name="order_new"
											value="<?= isset($_GET['order_new']) ? htmlspecialchars($_GET['order_new']) : '' ?>">
										<input type="hidden" name="order_price"
											value="<?= isset($_GET['order_price']) ? htmlspecialchars($_GET['order_price']) : '' ?>">
										<input type="hidden" name="order_procurement"
											value="<?= isset($_GET['order_procurement']) ? htmlspecialchars($_GET['order_procurement']) : '' ?>">
										<input type="hidden" name="brand_id"
											value="<?= isset($_GET['brand_id']) ? htmlspecialchars($_GET['brand_id']) : '' ?>">

										<div class="form-group">
											<label for="quantity_more"><?= lang('quantity_more_than') ?></label>
											<input type="number"
												value="<?= isset($_GET['quantity_more']) ? htmlspecialchars($_GET['quantity_more']) : '' ?>"
												name="quantity_more" id="quantity_more"
												placeholder="<?= lang('type_a_number') ?>"
												class="form-control">
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="added_after"><?= lang('added_after') ?></label>
													<div class="input-group date">
														<input type="text"
															value="<?= isset($_GET['added_after']) ? htmlspecialchars($_GET['added_after']) : '' ?>"
															name="added_after" id="added_after" class="form-control">
														<span class="input-group-text"> <i class="fa fa-calendar"
															aria-hidden="true"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="added_before"><?= lang('added_before') ?></label>
													<div class="input-group date">
														<input type="text"
															value="<?= isset($_GET['added_before']) ? htmlspecialchars($_GET['added_before']) : '' ?>"
															name="added_before" id="added_before"
															class="form-control"> <span class="input-group-text"> <i
															class="fa fa-calendar" aria-hidden="true"></i>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="search_in_body"><?= lang('search_by_keyword_body') ?></label>
											<input class="form-control"
												value="<?= isset($_GET['search_in_body']) ? htmlspecialchars($_GET['search_in_body']) : '' ?>"
												name="search_in_body" id="search_in_body" type="text">
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="price_from"><?= lang('price_from') ?></label> <input
														type="text"
														value="<?= isset($_GET['price_from']) ? htmlspecialchars($_GET['price_from']) : '' ?>"
														name="price_from" id="price_from" class="form-control"
														placeholder="<?= lang('type_a_number') ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="price_to"><?= lang('price_to') ?></label> <input
														type="text" name="price_to"
														value="<?= isset($_GET['price_to']) ? htmlspecialchars($_GET['price_to']) : '' ?>"
														id="price_to" class="form-control"
														placeholder="<?= lang('type_a_number') ?>">
												</div>
											</div>
										</div>

										<button type="submit"
											class="btn btn-inner-search cloth-bg-color">
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>
										<a class="btn btn-secondary" id="clear-form"
											href="javascript:void(0);">
											<?= lang('clear_form') ?>
										</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>