<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('discounts') ?>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2  pt-2">
	<h1>
		<img src="<?= base_url('assets/imgs/discount.png') ?>"
			class="header-img" style="margin-top: -3px;"> Discount Codes
	</h1>
	<hr>

	<div class="mb-3">
		<a href="javascript:void(0);"
			id="toogleAddDiscountCode" class="btn btn-primary float-left"> <b>+</b>
			Add discount code
		</a>

		<form method="POST" action="" class="float-right form-inline">
			<label class="mr-2" for="codeDiscountsSwitch">Code discounts</label> 
			<input type="hidden"
				name="codeDiscounts" value="<?= htmlspecialchars($codeDiscounts) ?>">
			<input id="codeDiscountsSwitch" <?= $codeDiscounts == 1 ? 'checked' : '' ?>
				data-toggle="toggle" data-for-field="codeDiscounts"
				class="toggle-changer" type="checkbox">
			<button class="btn btn-secondary ml-2" type="submit" name = "saveCodeDiscounts" value="save">Save</button>
		</form>

		<div class="clearfix"></div>
	</div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead class="thead-light">
				<tr>
					<th>Code</th>
					<th>Amount</th>
					<th>Valid from</th>
					<th>Valid to</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
            <?php if (! empty($discountCodes)): ?>
                <?php foreach ($discountCodes as $code): ?>
                    <?php $tostatus = $code['status'] == 1 ? 0 : 1; ?>
                    <tr>
					<td><?= htmlspecialchars($code['code']) ?></td>
					<td><?= $code['type'] == 'float' ? '-' . htmlspecialchars($code['amount']) : '-' . htmlspecialchars($code['amount']) . '%' ?></td>
					<td><?= date('d.m.Y', $code['valid_from_date']) ?></td>
					<td
						<?= time() > $code['valid_to_date'] ? 'class="text-danger"' : '' ?>>
                            <?= date('d.m.Y', $code['valid_to_date']) ?>
                        </td>
					<td class="text-center"><a
						href="<?= base_url('admin/discounts?codeid='.(int)$code['id'].'&tostatus='.(int)$tostatus) ?>">
                                <?=(int) $code['status'] == 1 ? '<span class="badge badge-success">Enabled</span>' : '<span class="badge badge-danger">Disabled</span>'?>
                            </a></td>
					<td class="text-center"><a
						href="<?= base_url('admin/discounts?edit='.(int)$code['id']) ?>"
						class="btn btn-primary btn-sm">Edit</a></td>
				</tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
					<td colspan="6">No discount codes added</td>
				</tr>
            <?php endif; ?>
            </tbody>
		</table>
	</div>

    <?= $links_pagination ?>

    <!-- add/edit discounts -->
	<div class="modal fade" id="addDiscountCode" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="" method="POST">
					<input type="hidden" name="update"
						value="<?= isset($_POST['update']) ? (int)$_POST['update'] : '0' ?>">

					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Add discount code</h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= implode('<br>', session()->getFlashdata('error')) ?></div>
                        <?php endif; ?>

                        <div class="form-group">
							<label for="discount_type">Type of discount</label> <select class="form-control"
								name="type" id="discount_type">
								<option
									<?= (isset($_POST['type']) && $_POST['type'] == 'percent') || !isset($_POST['percent']) ? 'selected' : '' ?>
									value="percent">%</option>
								<option
									<?= isset($_POST['type']) && $_POST['type'] == 'float' ? 'selected' : '' ?>
									value="float">Float</option>
							</select>
						</div>

						<div class="form-group">
							<label for="discount_amount">Discount value</label> <input class="form-control"
								id="discount_amount"
								name="amount"
								value="<?= isset($_POST['amount']) ? htmlspecialchars($_POST['amount']) : '' ?>"
								type="text">
						</div>

						<div class="form-group position-relative">
							<label for="discount_code">Discount code</label> <input class="form-control"
								id="discount_code"
								name="code"
								value="<?= isset($_POST['code']) ? htmlspecialchars($_POST['code']) : '' ?>"
								type="text">
							<div class="position-absolute" style="right: 5px; top: 28px;">
								<input type="text" data-toggle="tooltip"
									title="Set length of code"
									class="codeLength form-control d-inline-block" value="6"
									readonly
									style="width: 40px; text-align: center; display: inline-block;">
								<a href="javascript:void(0);" onclick="generateDiscountCode()"
									class="btn btn-secondary btn-sm mb-1">Generate</a>
							</div>
						</div>

						<div class="form-group">
							<label for="valid_from_date">Valid from date</label> <input
								id="valid_from_date"
								class="form-control datepicker" name="valid_from_date"
								placeholder="yyyy/mm/dd"
								value="<?= isset($_POST['valid_from_date']) ? htmlspecialchars($_POST['valid_from_date']) : '' ?>"
								type="text">
						</div>

						<div class="form-group">
							<label for="valid_to_date">Valid to date</label> <input
								id="valid_to_date"
								class="form-control datepicker" name="valid_to_date"
								placeholder="yyyy/mm/dd"
								value="<?= isset($_POST['valid_to_date']) ? htmlspecialchars($_POST['valid_to_date']) : '' ?>"
								type="text">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button"
							onclick="location.href='<?= base_url('admin/discounts') ?>';"
							class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" name="submit" class="btn btn-primary" value ="save" id="saveDiscount">Save</button>
					</div>

				</form>
			</div>
		</div>		
	</div>
	<script>
        $(document).ready(function () {
        	$("#addDiscountCode").modal('hide'); 
        	
            $('[data-toggle="tooltip"]').tooltip();

            <?php if (isset($_POST['code'])): ?>
                $('#addDiscountCode').modal('show');
            <?php endif; ?>
            
            $('.datepicker').datepicker({
                format: "dd.mm.yyyy",
                autoclose: true,
                format: "yyyy/mm/dd",
                todayHighlight: true
            });
            
            $("#toogleAddDiscountCode").click(function() {            
                $("#addDiscountCode").modal('show'); 
                clearInputs("addDiscountCode");
            });            
            
            $("#saveDiscount").click(function() {     
            	//temporary solution to hide model       
                setTimeout(() => {
                   $("#addDiscountCode").modal('hide'); 
                }, 2000);             
            });                           
        });


        function generateDiscountCode() {
            var length = $('.codeLength').val();
            if (length < 3 || length == '') {
                alert('Too short discount code!');
            } else {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (var i = 0; i < length; i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                $('[name="code"]').val(text.toUpperCase());
            }
        }
    </script>
</div>
<?= $this->endSection() ?>
