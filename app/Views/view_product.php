<?= $this->extend('_parts/layout') ?>
<?= $this->section('product-detail') ?>
<div class="col-12 px-0">
    <div class="container-fluid mt-3 mb-4" id="view-product">
        <div class="body">
            <div class="row align-items-start">
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                    <div class="<?= $product['folder'] != null ? 'product-main-image-with-gallery' : '' ?>">
                        <?php
                        $productImage = base_url('/attachments/no-image-frontend.png');
                        if (is_file('attachments/shop_images/' . $product['image'])) {
                            $productImage = base_url('/attachments/shop_images/' . $product['image']);
                        }
                        ?>
                        <img src="<?= $productImage ?>" data-num="0" class="other-img-preview img-fluid img-sl the-image d-block mx-auto" alt="<?= str_replace('"', "'", $product['title']) ?>">
                    </div>
                    <?php
                    if ($product['folder'] != null) {
                        $dir = "attachments/shop_images/" . $product['folder'] . '/';
                    ?>
                        <div class="row">
                            <?php
                            if (is_dir($dir)) {
                                if ($dh = opendir($dir)) {
                                    $i = 1;
                                    while (($file = readdir($dh)) !== false) {
                                        if (is_file($dir . $file)) {
                            ?>
                                            <div class="col-4 col-md-4 text-center mb-3">
                                                <img src="<?= base_url($dir . $file) ?>" data-num="<?= $i ?>" class="other-img-preview img-sl img-thumbnail the-image" alt="<?= str_replace('"', "'", $product['title']) ?>">
                                            </div>
                            <?php
                                            $i++;
                                        }
                                    }
                                    closedir($dh);
                                }
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php include rtrim(APPPATH, '/') . '/Views/main/social_share.php'; ?>
                </div>

                <div class="col-12 col-md-8">
                    <h1><?= $product['title'] ?></h1>
                    <div class="row row-info">
                        <div class="col-12 col-sm-6"><b><?= lang('new_price') ?>:</b></div>
                        <div class="col-12 col-sm-6"><?= format_currency($product['price']) ?></div>
                    </div>
                    <?php if ($product['old_price'] != '') { ?>
                        <div class="row row-info">
                            <div class="col-12 col-sm-6"><b><?= lang('old_price') ?>:</b></div>
                            <div class="col-12 col-sm-6"><?= format_currency($product['old_price']) ?></div>
                        </div>
                    <?php }
                    if ($publicQuantity == 1) { ?>
                        <div class="row row-info">
                            <div class="col-12 col-sm-6">
                                <b><?= lang('in_stock') ?>:</b>
                            </div>
                            <div class="col-12 col-sm-6"><?= $product['quantity'] ?></div>
                        </div>
                    <?php } ?>
                    <div class="row row-info">
                        <div class="col-12 col-sm-6"><b><?= lang('num_added_to_cart') ?>:</b></div>
                        <div class="col-12 col-sm-6"><?php
                                                        if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
                                                            $result = array_count_values($_SESSION['shopping_cart']);
                                                            if (isset($result[$product['id']]))
                                                                echo $result[$product['id']];
                                                            else
                                                                echo 0;
                                                        } else {
                                                            echo 0;
                                                        }
                                                        ?></div>
                    </div>
                    <?php if ($publicDateAdded == 1) { ?>
                        <div class="row row-info">
                            <div class="col-12 col-sm-6"><b><?= lang('added_on') ?>:</b></div>
                            <div class="col-12 col-sm-6"><?= date('m.d.Y', $product['time']) ?></div>
                        </div>
                    <?php } ?>
                    <div class="row row-info">
                        <div class="col-12 col-sm-6"><b><?= lang('in_category') ?>:</b></div>
                        <div class="col-12 col-sm-6">
                            <a href="javascript:void(0);" class="go-category btn-blue-round" data-categorie-id="<?= $product['shop_categorie'] ?>">
                                <?= $product['categorie_name'] ?>
                            </a>
                        </div>
                    </div>
                    <div class="row row-info">
                        <div class="col-12 col-sm-6"></div>
                        <div class="col-12 col-sm-6 manage-buttons">
                            <?php if ($product['quantity'] > 0) { ?>
                                <a href="javascript:void(0);" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/checkout' ?>" class="add-to-cart btn-add cloth-bg-color mb-2">
                                    <span class="text-to-bg"><?= lang('buy_now') ?></span>
                                </a>
                                <a href="javascript:void(0);" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="add-to-cart btn-add cloth-bg-color">
                                    <span class="text-to-bg"><?= lang('add_to_cart') ?></span>
                                </a>
                            <?php } else { ?>
                                <div class="alert alert-info"><?= lang('out_of_stock_product') ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row row-info">
                        <div class="col-12"><b><?= lang('description') ?>:</b></div>
                    </div>
                    <div id="description">
                        <?= $product['description'] ?>
                    </div>
                </div>
            </div>
            <div class="row products orders-from-category mt-4" id="products-side">
                <div class="col-12 filter-sidebar title cloth-bg-color">
                    <span><?= lang('oder_from_category') ?></span>
                </div>
                <?php
                if (!empty($sameCagegoryProducts)) {
                    $load::getProducts($sameCagegoryProducts, 'col-sm-4 col-md-3', false);
                } else {
                ?>
                    <div class="col-12 alert alert-info"><?= lang('no_same_category_products') ?></div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div id="modalImagePreview" class="modal">
    <div class="image-preview-container">
        <div class="modal-content">
            <div class="inner-prev-container">
                <img id="img01" alt="">
                <span class="close">&times;</span>
                <span class="img-series"></span>
            </div>
        </div>
        <a href="javascript:void(0);" class="inner-next"></a>
        <a href="javascript:void(0);" class="inner-prev"></a>
    </div>
    <div id="caption"></div>
</div>
<script src="<?= base_url('assets/js/image-preveiw.js') ?>"></script>
<?= $this->endSection() ?>