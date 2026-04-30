<?php

namespace App\Libraries;

use CodeIgniter\Config\Services;

class Loop
{
    public function __construct()
    {
        helper(['url', 'text', 'html', 'filesystem']); // Load needed helpers
    }

    public static function buildFrontendUrl(string $url, ?string $vendorUrl = null): string
    {
        $url = trim($url);
        if ($url === '') {
            return base_url();
        }

        // Normalize malformed protocol values like "http:/domain.com/path".
        $normalizeAbsoluteUrl = static function (string $value): string {
            $value = trim($value);
            $value = ltrim($value, '/\\');

            return (string) preg_replace('#^(https?):/*#i', '$1://', $value);
        };

        $normalizedUrl = $normalizeAbsoluteUrl($url);
        if (filter_var($normalizedUrl, FILTER_VALIDATE_URL)) {
            return $normalizedUrl;
        }

        $segments = [];
        /*
        $langUrl = defined('LANG_URL') ? trim((string) LANG_URL, '/\\') : '';
        if ($langUrl !== '') {
            $segments[] = $langUrl;
        }*/

        $vendorUrl = trim((string) $vendorUrl);
        $normalizedPath = trim($normalizedUrl, '/\\');
        if ($vendorUrl !== '' && strtolower($vendorUrl) !== 'null') {
            $normalizedVendorUrl = $normalizeAbsoluteUrl($vendorUrl);
            if (filter_var($normalizedVendorUrl, FILTER_VALIDATE_URL)) {
                return rtrim($normalizedVendorUrl, '/') . '/' . $normalizedPath;
            }

            $segments[] = trim($vendorUrl, '/\\');
            $segments[] = $normalizedPath;

            return base_url(implode('/', $segments));
        }

        if (!preg_match('#^product/#i', $normalizedPath)) {
            $normalizedPath = 'product/' . $normalizedPath;
        }

        $segments[] = $normalizedPath;

        return base_url(implode('/', $segments));
    }

    public static function getCartItems(array $cartItems)
    {
        if (!is_array($cartItems) || empty($cartItems['array'])) {
            return '';
        }        
        if (!empty($cartItems['array'])) {
            ?>
            <li class="cleaner text-right">
                <a href="javascript:void(0);" class="btn-blue-round" onclick="clearCart()">
                    <?= lang('clear_all') ?>
                </a>
            </li>
            <li class="divider"></li>
            <?php
            foreach ($cartItems['array'] as $cartItem) {
                $productImage = base_url('attachments/no-image-frontend.png');
                $cartItemUrl = self::buildFrontendUrl((string) ($cartItem['url'] ?? ''));
                if (is_file(FCPATH . 'attachments/shop_images/' . $cartItem['image'])) {
                    $productImage = base_url('attachments/shop_images/' . $cartItem['image']);
                }
                ?>
                <li class="shop-item" data-artticle-id="<?= esc($cartItem['id']) ?>">
                    <span class="num_added hidden"><?= esc($cartItem['num_added']) ?></span>
                    <div class="item">
                        <div class="item-in">
                            <div class="left-side">
                                <img src="<?= esc($productImage) ?>" alt="<?= esc($cartItem['title']) ?>" />
                            </div>
                            <div class="right-side">
                                <a href="<?= esc($cartItemUrl) ?>" class="item-info">
                                    <span><?= esc($cartItem['title']) ?></span>
                                    <span class="prices">
                                        <?php
                                        if ($cartItem['num_added'] == 1) {
                                            echo esc($cartItem['price']);
                                        } else {
                                            echo '<span class="num-added-single">' . esc($cartItem['num_added']) .
                                                 '</span> x <span class="price-single">' . esc($cartItem['price']) .
                                                 '</span> - <span class="sum-price-single">' . esc($cartItem['sum_price']) . '</span>';
                                        }
                                        ?>
                                    </span>
                                    <span class="currency"><?= CURRENCY ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="item-x-absolute">
                            <button class="btn btn-xs btn-danger pull-right" onclick="removeProduct(<?= esc($cartItem['id']) ?>)">
                                x
                            </button>
                        </div>
                    </div>
                </li>
                <?php
            }
            ?>
            <li class="divider"></li>
            <li class="text-center">
                <a class="go-checkout btn btn-default btn-sm" href="<?= base_url('/checkout') ?>">
                    <?php
                    if (!empty($cartItems['array'])) {
                        echo '<i class="fa fa-check"></i> ' . lang('checkout') . ' - <span class="finalSum">' . esc($cartItems['finalSum']) . '</span>' . CURRENCY;
                    } else {
                        echo '<span class="no-for-pay">' . lang('no_for_pay') . '</span>';
                    }
                    ?>
                </a>
            </li>
            <?php
        } else {
            ?>
            <li class="text-center"><?= lang('no_products') ?></li>
            <?php
        }
    }

    public static function getProducts(array $products, string $classes = '', bool $carousel = false)
    {
        $publicQuantity = Services::renderer()->getData('publicQuantity');
        $moreInfoBtn = Services::renderer()->getData('moreInfoBtn');
        $hideBuyButtonsOfOutOfStock = Services::renderer()->getData('hideBuyButtonsOfOutOfStock');
        $refreshAfterAddToCart = Services::renderer()->getData('refreshAfterAddToCart');

        if ($carousel) {
            ?>
            <div class="carousel slide" id="small_carousel" data-ride="carousel" data-interval="3000">
                <ol class="carousel-indicators">
                    <?php foreach (array_keys($products) as $i): ?>
                        <li data-target="#small_carousel" data-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></li>
                    <?php endforeach; ?>
                </ol>
                <div class="carousel-inner products">
            <?php
        }

        foreach ($products as $i => $article) {
            $active = ($i === 0 && $carousel) ? 'active' : '';
            $backgroundImageFile = base_url('attachments/no-image-frontend.png');
            $rawImage = isset($article['image']) ? trim((string) $article['image']) : '';
            $detailsUrl = self::buildFrontendUrl((string) ($article['url'] ?? ''), $article['vendor_url'] ?? null);

            if ($rawImage !== '') {
                // Support values stored as full relative paths or as filenames.
                $normalizedImage = ltrim($rawImage, '/\\');
                if (is_file(FCPATH . $normalizedImage)) {
                    $backgroundImageFile = base_url($normalizedImage);
                } elseif (is_file(FCPATH . 'attachments/shop_images/' . $normalizedImage)) {
                    $backgroundImageFile = base_url('attachments/shop_images/' . $normalizedImage);
                }
            }
            ?>
            <div class="product-list <?= $carousel ? 'item' : '' ?> <?= esc($classes) ?> <?= $active ?>">
                <div class="inner">
                    <div class="img-container">
                        <a href="<?= esc($detailsUrl) ?>" >
                            <img src="<?= esc($backgroundImageFile) ?>" alt="<?= esc(character_limiter($article['title'], 70)) ?>" onerror="this.onerror=null;this.src='<?= esc(base_url('attachments/no-image-frontend.png')) ?>';">
                        </a>
                    </div>
                    <h6 class="product-title">
                        <a href="<?= esc($detailsUrl) ?>"><?= character_limiter($article['title'], 70) ?></a>
                    </h6>
                    <div class="price">
                        <span class="underline"><?= lang('new_price') ?>: <span><?= format_currency($article['price']) ?></span></span>
                        <?php if ($article['old_price'] && $article['price']) {
                            $percent_friendly = number_format((($article['old_price'] - $article['price']) / $article['old_price']) * 100) . '%';
                            ?>
                            <span class="price-down"><?= esc($percent_friendly) ?></span>
                        <?php } ?>
                    </div>
                    <div class="price-discount <?= empty($article['old_price']) ? 'invisible' : '' ?>">
                        <?= lang('old_price') ?>: <span><?= $article['old_price'] ? format_currency($article['old_price']) : '' ?></span>
                    </div>
                    <?php if ($publicQuantity == 1): ?>
                        <div class="quantity">
                            <?= lang('in_stock') ?>: <span><?= esc($article['quantity']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($moreInfoBtn == 1): ?>
                        <a href="<?= esc($detailsUrl) ?>" class="info-btn gradient-color">
                            <span class="text-to-bg"><?= lang('info_product_list') ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ($hideBuyButtonsOfOutOfStock == 0 || (int)$article['quantity'] > 0):
                        $hasRefresh = ($refreshAfterAddToCart == 1);
                        ?>
                        <div class="add-to-cart">
                            <a href="javascript:void(0);" class="add-to-cart btn-add <?= $hasRefresh ? 'refresh-me' : '' ?>" data-goto="<?= base_url('/shopping-cart') ?>" data-id="<?= esc($article['id']) ?>">
                                <img class="loader" src="<?= base_url('assets/imgs/ajax-loader.gif') ?>" alt="Loading">
                                <span class="text-to-bg"><?= lang('add_to_cart') ?></span>
                            </a>
                        </div>
                        <!-- <div class="add-to-cart">
                            <a href="javascript:void(0);" class="add-to-cart btn-add more-blue" data-goto="<?= base_url('/checkout') ?>" data-id="<?= esc($article['id']) ?>">
                                <img class="loader" src="<?= base_url('assets/imgs/ajax-loader.gif') ?>" alt="Loading">
                                <span class="text-to-bg"><?= lang('buy_now') ?></span>
                            </a>
                        </div> -->
                    <?php else: ?>
                        <div>Product is out of stock</div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }

        if ($carousel) {
            ?>
                </div>
                <a class="left carousel-control" href="#small_carousel" role="button" data-slide="prev">
                    <i class="fa fa-5x fa-angle-left" aria-hidden="true"></i>
                </a>
                <a class="right carousel-control" href="#small_carousel" role="button" data-slide="next">
                    <i class="fa fa-5x fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
            <?php
        }
    }
}
