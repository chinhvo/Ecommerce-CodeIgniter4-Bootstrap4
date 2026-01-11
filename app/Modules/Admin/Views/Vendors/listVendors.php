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
					<h1 class="h4 mb-0">Admin Vendors List</h1>
				</div>

				<hr class="my-3">

      <?php if (!empty($vendors)) { ?>
            <div class="table-responsive">
    					<table class="table table-striped table-hover mb-0">
    						<thead class="thead-light">
    							<tr>
    								<th scope="col">#ID</th>
    								<th scope="col">Name</th>
    								<th scope="col">Email</th>
    								<th scope="col">Sold products amount</th>
    								<th scope="col">Created At</th>
    							</tr>
    						</thead>
    
    						<tbody>
                  <?php foreach ($vendors as $vendor) { ?>
                    <tr>
						<td><?= $vendor['id'] ?></td>
						<td><?= isset($vendor['name']) ? $vendor['name'] : 'Vendor name is empty' ?></td>
						<td><?= $vendor['email'] ?></td>

						<td>
                        <?php
                $orders = $controller->getVendorOrders($vendor->id);
    
                if (! count($orders)) {
                    ?>
                            <span class="badge badge-danger">No orders</span>
                            <?php
                } else {
                    $countSales = 0;
    
                    foreach ($orders as $order) {
                        $product = unserialize($order['products']);
                        foreach ($product as $key => $value) {
                            $countSales += (int) $value;
                        }
                    }
                    ?>
                            <span class="badge badge-success"><?= $countSales ?></span>
                            <?php
                }
                ?>
                      </td>
    
    								<td><?= $vendor->created_at ?></td>
    							</tr>
                  <?php } ?>
                </tbody>
    					</table>
    				</div>
        
              <?php } else { ?>
                <hr class="my-3">
        				<div class="alert alert-info mb-0">No vendors found!</div>
              <?php } ?>
    
        </div>
		</div>
	</div>

</div>
<?= $this->endSection() ?>