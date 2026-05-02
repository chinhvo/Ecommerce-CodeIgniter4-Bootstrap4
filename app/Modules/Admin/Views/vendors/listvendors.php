<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('listvendors') ?>
<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<div id="vendors" class="container-fluid">
		<div class="row">
			<div class="col-12">

				<div class="d-flex align-items-center mb-2">
					<img src="<?= base_url('assets/imgs/admin-user.png') ?>"
						alt="Admin Vendors" class="mr-2"
						style="height: 32px; width: auto;">
					<h1 class="h4 mb-0"><?= lang('admin_vendors_list') ?></h1>
				</div>

				<hr class="my-3">

      <?php if (!empty($vendors)) { ?>
            <div class="table-responsive">
    					<table class="table table-striped table-hover mb-0">
    						<thead class="thead-light">
    							<tr>
									<th scope="col">#<?= lang('col_id') ?></th>
									<th scope="col"><?= lang('col_name') ?></th>
									<th scope="col"><?= lang('col_email') ?></th>
									<th scope="col"><?= lang('sold_products_amount') ?></th>
									<th scope="col"><?= lang('created_at') ?></th>
    							</tr>
    						</thead>
    
    						<tbody>
                  <?php foreach ($vendors as $vendor) { ?>
                    <tr>
						<td><?= $vendor['id'] ?></td>
						<td><?= isset($vendor['name']) ? $vendor['name'] : lang('vendor_name_empty') ?></td>
						<td><?= $vendor['email'] ?></td>

						<td>
						<?php $countSales = $vendorSalesCounts[(int) $vendor['id']] ?? 0; ?>
						<?php if ($countSales === 0) { ?>
							<span class="badge badge-danger"><?= lang('no_orders') ?></span>
						<?php } else { ?>
							<span class="badge badge-success"><?= $countSales ?></span>
						<?php } ?>
                      </td>
    
								<td><?= $vendor['created_at'] ?></td>
    							</tr>
                  <?php } ?>
                </tbody>
    					</table>
    				</div>
        
              <?php } else { ?>
                <hr class="my-3">
						<div class="alert alert-info mb-0"><?= lang('no_vendors_found') ?></div>
              <?php } ?>
    
        </div>
		</div>
	</div>

</div>
<?= $this->endSection() ?>