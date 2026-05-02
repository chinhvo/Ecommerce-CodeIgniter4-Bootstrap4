<div class="row content">
	<section class="col-md-8 col-12 px-0 d-md-flex">
		<?php if (!empty($sliders)) : ?>
			<section class="sidebar-slider">
				<div id="sidebarCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<?php foreach ($sliders as $i => $slide) : ?>
							<li data-target="#sidebarCarousel"
								data-slide-to="<?= $i ?>"
								class="<?= $i === 0 ? 'active' : '' ?>"></li>
						<?php endforeach; ?>
					</ol>
					<!-- Slides -->
					<div class="carousel-inner">
						<?php foreach ($sliders as $i => $slide) : ?>
							<div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
								<?php if (!empty($slide['link'])) : ?>
									<a href="<?= esc($slide['link']) ?>"
										title="<?= esc($slide['name']) ?>"
										rel="nofollow">
									<?php endif; ?>
									<img class="d-block w-100"
										src="<?= base_url(esc($slide['image'])) ?>"
										alt="<?= esc($slide['name']) ?>">
									<?php if (!empty($slide['link'])) : ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
					<!-- Controls -->
					<a class="carousel-control-prev" href="#sidebarCarousel"
						role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#sidebarCarousel"
						role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</section>
		<?php endif; ?>
	</section>
	<aside class="sidebar-banner sidebar-banner-home col-md-4 col-12"
		style="padding-right: 0px; padding-left: 10px;">
		<div class="row">
			<div class="col-md-12 col-sm-6 col-12 banner">
				<a rel="nofollow" href="#"> <img
						src="/attachments/qc-right-slide-3630.jpg" class="img-fluid w-100">
				</a>
			</div>
			<div class="col-md-12 col-sm-6 col-12 banner">
				<a href="/blog/khuyen-mai">
					<div class="banner-item icon-on-left red">
						<h4>Khuyến mãi!</h4>
						<p>Mua xe nhận ngay quà khủng</p>
						<span class="button">Xem</span> <i class="icons icon-star-empty"></i>
					</div>
				</a>
			</div>
			<div class="col-md-12 col-sm-6 col-12 banner">
				<a href="/blog/mua-xe-may-dien-xe-dap-dien-tra-gop">
					<div class="banner-item icon-on-left green">
						<h4>MUA TRẢ GÓP</h4>
						<p>Áp dụng cho tất cả sản phẩm</p>
						<span class="button">Xem</span> <i class="icons icon-visa"></i>
					</div>
				</a>
			</div>
		</div>
	</aside>
</div>