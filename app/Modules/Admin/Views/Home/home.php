<?= $this->extend('\App\Modules\Admin\Views\_parts\layout') ?>
<?= $this->section('home') ?>
<div
	class="col-sm-9 col-md-9 col-lg-10 offset-sm-3 offset-md-3 offset-lg-2">
	<script src="<?= base_url('assets/highcharts/highcharts.js') ?>"></script>
	<script src="<?= base_url('assets/highcharts/data.js') ?>"></script>
	<script src="<?= base_url('assets/highcharts/drilldown.js') ?>"></script>

	<h1>
		<img src="<?= base_url('assets/imgs/admin-home.png') ?>"
			class="header-img" style="margin-top: -3px;"> <?= lang('home') ?>
	</h1>
	<hr>

	<div class="home-page">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><i class="fa fa-dashboard"></i>
						<?= lang('dashboard_overview') ?></li>
					</ol>
				</nav>
			</div>
		</div>

		<!-- Dashboard Quick Panels -->
		<div class="row">
			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card text-white bg-primary h-100">
					<div class="card-body fast-view-panel">
						<div class="row">
							<div class="col-3">
								<i class="fa fa-clock-o fa-5x"></i>
							</div>
							<div class="col-9 text-right">
								<div style="font-size: 25px;"><?= date('d.m.Y', session()->get('last_login')) ?></div>
								<div style="font-size: 16px;"><?= date('H:i:s', session()->get('last_login')) ?></div>
								<div><?= lang('last_login_label') ?></div>
							</div>
						</div>
					</div>
					<a href="<?= base_url('admin/adminusers') ?>"
						class="card-footer text-white clearfix small z-1 d-flex justify-content-between align-items-center">
						<span><?= lang('view_details') ?></span> <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card text-white bg-success h-100">
					<div class="card-body fast-view-panel">
						<div class="row">
							<div class="col-3">
								<i class="fa fa-envelope-o fa-5x"></i>
							</div>
							<div class="col-9 text-right">
								<div class="display-4"><?= $lastSubscribed ?></div>
								<div><?= lang('new_subscribed') ?></div>
							</div>
						</div>
					</div>
					<a href="<?= base_url('admin/emails') ?>"
						class="card-footer text-white clearfix small z-1 d-flex justify-content-between align-items-center">
						<span><?= lang('view_details') ?></span> <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card text-dark bg-warning h-100">
					<div class="card-body fast-view-panel">
						<div class="row">
							<div class="col-3">
								<i class="fa fa-shopping-cart fa-5x"></i>
							</div>
							<div class="col-9 text-right">
								<div class="display-4"><?= $newOrdersCount ?></div>
								<div><?= lang('new_orders_label') ?></div>
							</div>
						</div>
					</div>
					<a href="<?= base_url('admin/orders') ?>"
						class="card-footer text-dark clearfix small z-1 d-flex justify-content-between align-items-center">
						<span><?= lang('view_details') ?></span> <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card text-white bg-danger h-100">
					<div class="card-body fast-view-panel">
						<div class="row">
							<div class="col-3">
								<i class="fa fa-sort-numeric-desc fa-5x"></i>
							</div>
							<div class="col-9 text-right">
								<div class="display-4"><?= $lowQuantity ?></div>
								<div><?= lang('low_quantity_products') ?><br><?= lang('lower_than_5') ?></div>
							</div>
						</div>
					</div>
					<a href="<?= base_url('admin/products?orderby=quantity=asc') ?>"
						class="card-footer text-white clearfix small z-1 d-flex justify-content-between align-items-center">
						<span><?= lang('view_details') ?></span> <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		</div>

		<!-- Charts -->
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-bar-chart-o fa-fw"></i> <?= lang('orders_by_month_chart') ?>
					</div>
					<div class="card-body">
						<div id="container-by-month"
							style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
					</div>
				</div>
			</div>

			<div class="col-lg-12 mb-4">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-bar-chart-o fa-fw"></i> <?= lang('orders_from_referrer_chart') ?>
					</div>
					<div class="card-body">
						<div id="container-by-referrer"
							style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- Tables -->
		<div class="row">
			<!-- Payment Types -->
			<div class="col-lg-4 mb-4">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-long-arrow-right fa-fw"></i> <?= lang('most_orders_by_payment') ?>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
									<th><?= lang('payment_type') ?></th>
									<th><?= lang('num_orders') ?></th>
									</tr>
								</thead>
								<tbody>
                                <?php if (!empty($ordersByPaymentType)): ?>
                                    <?php foreach ($ordersByPaymentType as $paymentT): ?>
                                        <tr>
										<td><?= $paymentT['payment_type'] ?></td>
										<td><?= $paymentT['num'] ?></td>
									</tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
											<td colspan="2"><?= lang('no_orders') ?></td>
									</tr>
                                <?php endif ?>
                            </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- Activity -->
			<div class="col-lg-4 mb-4">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-clock-o fa-fw"></i> <?= lang('last_activity_log') ?>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
									<th><?= lang('col_user') ?></th>
									<th><?= lang('col_action') ?></th>
									</tr>
								</thead>
								<tbody>
                                <?php if (!empty($activity)): ?>
                                    <?php foreach ($activity as $action): ?>
                                        <tr>
										<td><i class="fa fa-user"></i> <b><?= esc($action['username']) ?></b></td>
										<td><?= esc($action['activity']) . ' on ' . date('d.m.Y / H.i.s', $action['time']) ?></td>
									</tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
											<td colspan="2"><?= lang('no_history_found') ?></td>
									</tr>
                                <?php endif ?>
                            </tbody>
							</table>
						</div>
						<div class="text-right">
						<a href="<?= base_url('admin/history') ?>"><?= lang('view_all_activity') ?> <i
								class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
			</div>

			<!-- Most Sold -->
			<div class="col-lg-4 mb-4">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-money fa-fw"></i> <?= lang('most_sold') ?>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
									<th><?= lang('col_sales') ?></th>
									<th><?= lang('col_url') ?></th>
									</tr>
								</thead>
								<tbody>
                                <?php if (!empty($mostSold)): ?>
                                    <?php foreach ($mostSold as $product): ?>
                                        <tr>
										<td><?= $product['procurement'] ?></td>
										<td><a target="_blank" href="<?= base_url($product['url']) ?>"><?= base_url($product['url']) ?></a></td>
									</tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
											<td colspan="2"><?= lang('no_orders') ?></td>
										</tr>
                                <?php endif ?>
                            </tbody>
						</table>
					</div>
					<div class="text-right">
						<a
							href="<?= base_url('admin/products?orderby=procurement=desc') ?>"><?= lang('view_all_products') ?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Charts Init -->
	<script>
        $(function () {
            Highcharts.chart('container-by-referrer', {
                chart: { type: 'column' },
                title: { text: 'Orders coming from..' },
                subtitle: { text: 'Most Orders By Referrer' },
                xAxis: { type: 'category' },
                yAxis: { title: { text: 'Total max numbers' } },
                legend: { enabled: false },
                plotOptions: { series: { borderWidth: 0, dataLabels: { enabled: true, format: '{y}' } } },
                tooltip: { headerFormat: '<span style="font-size:11px">{series.name}</span><br>', pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>' },
                series: [{
                    name: 'Referrer',
                    colorByPoint: true,
                    data: [
                        <?php foreach ($byReferral as $referrer): ?>
                        { name: '<?= $referrer['referrer'] ?>', y: <?= $referrer['num'] ?>, drilldown: '<?= $referrer['referrer'] ?>' },
                        <?php endforeach ?>
                    ]
                }]
            });
        });
    
        $(function () {
            Highcharts.chart('container-by-month', {
                title: { text: 'Monthly Orders', x: -20 },
                subtitle: { text: 'Source: Orders table', x: -20 },
                xAxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] },
                yAxis: { title: { text: 'Orders' }, plotLines: [{ value: 0, width: 1, color: '#808080' }] },
                tooltip: { valueSuffix: ' Orders' },
                legend: { layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0 },
                series: [
                    <?php foreach ($ordersByMonth['years'] as $year): ?>
                    { name: '<?= $year ?>', data: [<?= implode(',', $ordersByMonth['orders'][$year]) ?>] },
                    <?php endforeach ?>
                ]
            });
        });
	</script>
</div>

<?= $this->endSection() ?>
