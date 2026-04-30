<?php
$brands = [
    ['title' => 'Xe điện EV', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-ev/', 'image' => '399.jpg'],
    ['title' => 'xe điện Vnbike', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-vnbike/', 'image' => '562.jpg'],
    ['title' => 'Xe Fornix', 'url' => 'https://thegioixechaydien.com.vn/xe-fornix/', 'image' => '170.jpg'],
    ['title' => 'Xe điện Vinfast', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-vinfast/', 'image' => '619.jpg'],
    ['title' => 'Xe điện JVC eco', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-jvc-eco/', 'image' => '347.jpg'],
    ['title' => 'Xe điện Eagle', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-eagle/', 'image' => '694.jpg'],
    ['title' => 'Xe điện LVTONG', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-lvtong/', 'image' => '751.jpg'],
    ['title' => 'Xe điện Pega', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-pega/', 'image' => '832.jpg'],
    ['title' => 'Xe điện Dibao', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-dibao/', 'image' => '670.jpg'],
    ['title' => 'Xe điện Detech', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-detech/', 'image' => '405.jpg'],
    ['title' => 'Xe điện Yadea', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-yadea/', 'image' => '595.jpg'],
    ['title' => 'Xe điện Asama', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-asama/', 'image' => '938.jpg'],
    ['title' => 'Xe Giant', 'url' => 'https://thegioixechaydien.com.vn/xe-giant/', 'image' => '452.jpg'],
    ['title' => 'Xe điện Yamaha', 'url' => 'https://thegioixechaydien.com.vn/xe-dien-yamaha/', 'image' => '571.jpg'],
];
?>

<div class="wrap-brands brands py-3">
    <div id="list_brands" class="list-brands row mx-n1">
        <?php foreach ($brands as $brand) { ?>
            <div class="brand-item col-6 col-sm-4 col-md-3 col-lg-2 px-1 mb-2">
                <a class="brand-card card h-100 border-0 shadow-sm text-decoration-none" title="<?= esc($brand['title']) ?>" href="<?= esc($brand['url']) ?>">
                    <div class="card-body brand-card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <img
                            class="brand-logo img-fluid"
                            data-original="<?= base_url('attachments/brand/' . $brand['image']) ?>"
                            alt="<?= esc($brand['title']) ?>"
                            src="<?= base_url('attachments/brand/' . $brand['image']) ?>"
                            loading="lazy"
                        />
                        <p class="brand-label mb-0 mt-2"><?= esc($brand['title']) ?></p>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

    <div class="text-center mt-2">
        <button type="button" class="more-brands btn btn-outline-secondary btn-sm" onclick="ShowAllBrand()">Hiển thị thêm<span></span></button>
    </div>
</div>
                        