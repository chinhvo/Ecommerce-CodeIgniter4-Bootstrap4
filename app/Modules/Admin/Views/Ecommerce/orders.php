<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('orders') ?>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<div class="d-flex justify-content-between align-items-center">
		<h1>
			<img src="<?= base_url('assets/imgs/orders.png') ?>"
				class="header-img" style="margin-top: -2px;">
        Orders <?= service('request')->getGet('settings') ? ' / Settings' : '' ?>
    </h1>
    <?php if (!service('request')->getGet('settings')): ?>
        <a href="?settings=true" class="btn btn-link orders-settings"> <i
			class="fa fa-cog"></i> Settings
		</a>
    <?php else: ?>
        <a href="<?= base_url('admin/orders') ?>"
			class="btn btn-link orders-settings"> <i class="fa fa-angle-left"></i>
			Back
		</a>
    <?php endif; ?>
    </div>
	<hr>
<?php
$request = service('request');
$currency = config('App')->currency; // or create your own Config class for shop settings

if (! $request->getGet('settings')) :
    if (! empty($orders)) :
        ?>
        <div class="mb-2">
		<select class="selectpicker changeOrder">
			<option <?= $request->getGet('order_by') == 'id' ? 'selected' : '' ?>
				value="id">Order by new</option>
			<option
				<?= ($request->getGet('order_by') == 'processed') || !$request->getGet('order_by') ? 'selected' : '' ?>
				value="processed">Order by not processed</option>
		</select>
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-striped">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Date</th>
					<th>Name</th>
					<th>Phone</th>
					<th class="text-center">Status</th>
					<th class="text-center">Preview</th>
				</tr>
			</thead>
			<tbody>
                    <?php

        foreach ($orders as $tr) :
            if ($tr['processed'] == 0) {
                $class = 'bg-danger';
                $type = 'No processed';
            } elseif ($tr['processed'] == 1) {
                $class = 'bg-success';
                $type = 'Processed';
            } else {
                $class = 'bg-warning';
                $type = 'Rejected';
            }
            ?>
                        <tr>
					<td class="relative" id="order_id-id-<?= esc($tr['order_id']) ?>">
                                # <?= esc($tr['order_id']) ?>
                                <?php if ($tr['viewed'] == 0) : ?>
                                    <div
							id="new-order-alert-<?= esc($tr['id']) ?>">
							<img src="<?= base_url('assets/imgs/new-blinking.gif') ?>"
								style="width: 100px;" alt="blinking">
						</div>
                                <?php endif; ?>
                                <div class="confirm-result">
                                    <?php if ($tr['confirmed'] == '1') : ?>
                                        <span
								class="badge badge-success">Confirmed by email</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Not
								Confirmed</span>
                                    <?php endif; ?>
                                </div>
					</td>
					<td><?= date('d.M.Y / H:i:s', $tr['date']); ?></td>
					<td><i class="fa fa-user"></i> <?= esc($tr['first_name'] . ' ' . $tr['last_name']) ?></td>
					<td><i class="fa fa-phone"></i> <?= esc($tr['phone']) ?></td>
					<td class="<?= $class ?> text-center"
						data-action-id="<?= esc($tr['id']) ?>">
						<div class="status py-1" style="font-size: 16px;">
							-- <b><?= esc($type) ?></b> --
						</div>
						<div class="mb-1">
							<a href="javascript:void(0);"
								onclick="changeOrdersOrderStatus(<?= $tr['id'] ?>, 1, '<?= esc($tr['products']) ?>', '<?= esc($tr['email']) ?>')"
								class="btn btn-success btn-sm">Processed</a>
						</div>
						<div class="mb-1">
							<a href="javascript:void(0);"
								onclick="changeOrdersOrderStatus(<?= $tr['id'] ?>, 0)"
								class="btn btn-danger btn-sm">No processed</a>
						</div>
						<div class="mb-1">
							<a href="javascript:void(0);"
								onclick="changeOrdersOrderStatus(<?= $tr['id'] ?>, 2)"
								class="btn btn-warning btn-sm">Rejected</a>
						</div>
					</td>
					<td class="text-center"><a href="javascript:void(0);"
						class="btn btn-secondary more-info" data-toggle="modal"
						data-target="#modalPreviewMoreInfo" style="margin-top: 10%;"
						data-more-info="<?= esc($tr['order_id']) ?>"> More Info <i
							class="fa fa-info-circle"></i>
					</a> <a href="<?= base_url('/admin/orders/delete/'. $tr['id']) ?>"
						onclick="return confirm('Are you sure want to delete this order?')"
						class="btn btn-danger mt-2"> Delete <i class="fa fa-remove"></i>
					</a></td>
					<td class="d-none" id="order-id-<?= esc($tr['order_id']) ?>">
						<div class="table-responsive">
							<table class="table more-info-purchase">
								<tbody>
									<tr>
										<td><b>Email</b></td>
										<td><a href="mailto:<?= esc($tr['email']) ?>"><?= esc($tr['email']) ?></a></td>
									</tr>
									<tr>
										<td><b>City</b></td>
										<td><?= esc($tr['city']) ?></td>
									</tr>
									<tr>
										<td><b>Address</b></td>
										<td><?= esc($tr['address']) ?></td>
									</tr>
									<tr>
										<td><b>Postcode</b></td>
										<td><?= esc($tr['post_code']) ?></td>
									</tr>
									<tr>
										<td><b>Notes</b></td>
										<td><?= esc($tr['notes']) ?></td>
									</tr>
									<tr>
										<td><b>Come from site</b></td>
										<td>
                                                    <?php if ($tr['referrer'] != 'Direct') : ?>
                                                        <a
											target="_blank" href="<?= esc($tr['referrer']) ?>"
											class="orders-referral"><?= esc($tr['referrer']) ?></a>
                                                    <?php else : ?>
                                                        Direct traffic or referrer is not visible
                                                    <?php endif; ?>
                                                </td>
									</tr>
									<tr>
										<td><b>Payment Type</b></td>
										<td><?= esc($tr['payment_type']) ?></td>
									</tr>
									<tr>
										<td><b>Discount</b></td>
										<td><?= $tr['discount_type'] == 'float' ? '-'.$tr['discount_amount'] : '-'.$tr['discount_amount'].'%' ?></td>
									</tr>
                                            <?php if ($tr['payment_type'] == 'PayPal') : ?>
                                                <tr>
										<td><b>PayPal Status</b></td>
										<td><?= esc($tr['paypal_status']) ?></td>
									</tr>
                                            <?php endif; ?>
                                            <tr>
										<td colspan="2"><b>Products</b></td>
									</tr>
									<tr>
										<td colspan="2">
                                                    <?php
            $arr_products = unserialize($tr['products']);
            foreach ($arr_products as $product) :
                $total_amount = (float) str_replace([
                    ' ',
                    ','
                ], [
                    '',
                    '.'
                ], $product['product_info']['price']);
                ?>
                                                        <div
												style="word-break: break-all;">
												<div>
													<img
														src="<?= base_url('attachments/shop_images/' . $product['product_info']['image']) ?>"
														alt="Product" style="width: 100px; margin-right: 10px;"
														class="img-fluid">
												</div>
												<a data-toggle="tooltip" title="Click to preview"
													target="_blank"
													href="<?= base_url($product['product_info']['url']) ?>">
                                                                <?= base_url($product['product_info']['url']) ?>
                                                                <div
														class="bg-light rounded px-2 py-1">
														<b>Quantity:</b> <?= esc($product['product_quantity']) ?> /
                                                                    <b>Price: <?= esc($product['product_info']['price']).' '.$currency ?></b>
													</div>
												</a>
												<div>
													<b>Vendor:</b> <a
														href="<?= base_url('admin/listvendors?id=' . $product['product_info']['vendor_id']) ?>">
                                                                    <?= $product['product_info']['vendor_name'] ?? '-Vendor name is missing-' ?>
                                                                </a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="pt-2" style="font-size: 16px;">Total amount of products: <?= $total_amount.' '.$currency ?></div>
											<hr>
                                                    <?php endforeach; ?>
                                                </td>
									</tr>
                                            <?php
            $total_parsed = (int) str_replace([
                ' ',
                ','
            ], '', $total_amount);
            if ((int) $shippingAmount > 0 && ((int) $shippingOrder > $total_parsed)) :
                ?>
                                                <tr>
										<td><b>Shipping amount is</b></td>
										<td><?= (int)$shippingAmount.' '.$currency ?></td>
									</tr>
                                            <?php endif; ?>
                                        </tbody>
							</table>
						</div>
					</td>
				</tr>
                    <?php endforeach; ?>
                </tbody>
		</table>
	</div>
        <?= $links_pagination ?>
    <?php else : ?>
        <div class="alert alert-info">No orders to the moment!</div>
    <?php endif; ?>
    <hr>
<?php endif; ?>

<?php if (service('request')->getGet('settings')): ?>
    <h3>Cash On Delivery</h3>
	<div class="row">
		<div class="col-sm-4">
			<div class="card">
				<div class="card-header">Change visibility of this purchase option</div>
				<div class="card-body">
                    <?php if (session()->getFlashdata('cashondelivery_visibility')): ?>
                        <div class="alert alert-info">
                            <?= esc(session()->getFlashdata('cashondelivery_visibility')) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">  
                     	<?= csrf_field() ?>                
                        <input type="hidden" name="cashondelivery_visibility" value="<?= htmlspecialchars($cashondelivery_visibility) ?>">
												<label for="cashondelivery_visibility_switch" class="sr-only">Cash on delivery visibility</label>
                        <input id="cashondelivery_visibility_switch" <?= $cashondelivery_visibility == 1 ? 'checked' : '' ?> data-toggle="toggle" data-for-field="cashondelivery_visibility" class="toggle-changer" type="checkbox" >
                        <button class="btn btn-secondary" value="" type="submit">
                            Save
                        </button>
                    </form>
				</div>
			</div>
		</div>
	</div>
	<hr>

	<h3>Paypal Account Settings</h3>
	<div class="row">
		<!-- Sandbox Mode -->
		<div class="col-sm-6">
			<div class="card">
				<div class="card-header">Paypal sandbox mode (use for account tests)</div>
				<div class="card-body">
                    <?php if (session()->getFlashdata('paypal_sandbox')): ?>
                        <div class="alert alert-info">
                            <?= esc(session()->getFlashdata('paypal_sandbox')) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="" id="paypal_sandbox">
                        <?= csrf_field() ?>
           				<input type="hidden" name="paypal_sandbox" value="<?= htmlspecialchars($paypal_sandbox) ?>">
						<label for="paypal_sandbox_switch" class="sr-only">Paypal sandbox mode</label>
                        <input id="paypal_sandbox_switch" <?= $paypal_sandbox == 1 ? 'checked' : '' ?> data-toggle="toggle" data-for-field="paypal_sandbox" class="toggle-changer" type="checkbox">   
						<button class="btn btn-secondary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Paypal Email -->
		<div class="col-sm-6">
			<div class="card">
				<div class="card-header">Paypal business email</div>
				<div class="card-body">
                    <?php if (session()->getFlashdata('paypal_email')): ?>
                        <div class="alert alert-info">
                            <?= esc(session()->getFlashdata('paypal_email')) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="" id="paypal_email">
                        <?= csrf_field() ?>
                        <div class="input-group">
							<input class="form-control"
								placeholder="Leave empty for no paypal available method"
								name="paypal_email" value="<?= esc($paypal_email) ?>"
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
	<hr>

	<h3>Bank Account Settings</h3>
	<div class="row">
		<div class="col-sm-6">
            <?php if (session()->getFlashdata('bank_account')): ?>
                <div class="alert alert-info">
                    <?= esc(session()->getFlashdata('bank_account')) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="" id="bank_account">
                <?= csrf_field() ?>
                <div class="table-responsive">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td colspan="2"><b>Pay to - Recipient name/ltd</b></td>
							</tr>
							<tr>
								<td colspan="2"><input type="text" name="name"
									value="<?= $bank_account ? esc($bank_account['name']) : '' ?>"
									class="form-control" placeholder="Example: BoxingTeam Ltd."></td>
							</tr>
							<tr>
								<td><b>IBAN</b></td>
								<td><b>BIC</b></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control"
									value="<?= $bank_account ? esc($bank_account['iban']) : '' ?>"
									name="iban" placeholder="Example: BG11FIBB329291923912301230">
								</td>
								<td><input type="text" class="form-control"
									value="<?= $bank_account ? esc($bank_account['bic']) : '' ?>"
									name="bic" placeholder="Example: FIBBGSF"></td>
							</tr>
							<tr>
								<td colspan="2"><b>Bank</b></td>
							</tr>
							<tr>
								<td colspan="2"><input type="text"
									value="<?= $bank_account ? esc($bank_account['bank']) : '' ?>"
									name="bank" class="form-control"
									placeholder="Example: First Investment Bank"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<input type="submit" class="btn btn-primary btn-block"
					value="Save Bank Account Settings">
			</form>
		</div>
	</div>
<?php endif; ?>

<!-- Modal for more info buttons in orders -->
	<div class="modal fade" id="modalPreviewMoreInfo" tabindex="-1"
		role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">
						Preview <b id="client-name"></b>
					</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="preview-info-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>