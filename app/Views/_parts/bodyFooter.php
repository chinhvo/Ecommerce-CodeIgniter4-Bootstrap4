<div class="h-line"></div>
<div class="body-footer">
    <div class="row">
        <?php if (!empty($footerAboutUs)) { ?>
            <div class="col-sm-3">
                <h3><?= lang('about_us') ?></h3>
                <hr>
                <?= html_entity_decode($footerAboutUs) ?>
            </div>
        <?php } ?>
        <div class="col-sm-3">
            <h3><?= lang('social') ?></h3>
            <hr>
            <ul class="social list-unstyled">
                <?php if (!empty($footerSocialFacebook)) { ?>
                    <li><a href="<?= esc($footerSocialFacebook) ?>" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>
                <?php if (!empty($footerSocialTwitter)) { ?>
                    <li><a href="<?= esc($footerSocialTwitter) ?>" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>
                <?php if (!empty($footerSocialGooglePlus)) { ?>
                    <li><a href="<?= esc($footerSocialGooglePlus) ?>" target="_blank" rel="noopener"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if (!empty($footerSocialPinterest)) { ?>
                    <li><a href="<?= esc($footerSocialPinterest) ?>" target="_blank" rel="noopener"><i class="fa fa-pinterest"></i></a></li>
                <?php } ?>
                <?php if (!empty($footerSocialYoutube)) { ?>
                    <li><a href="<?= esc($footerSocialYoutube) ?>" target="_blank" rel="noopener"><i class="fa fa-youtube"></i></a></li>
                <?php } ?>
                <?php if (!empty($footerSocialZalo)) { ?>
                    <li><a href="<?= esc($footerSocialZalo) ?>" target="_blank" rel="noopener"><img src="/attachments/site_logo/zalo.png" alt="Zalo"></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-sm-3">
            <h3><?= lang('newsletter') ?></h3>
            <hr>
            <div class="newsletter-box">
                <form method="POST" id="subscribeForm">
                    <?= csrf_field() ?>
                    <div class="input-group">
                        <input type="email" class="form-control" name="subscribeEmail" placeholder="<?= lang('email_address') ?>">
                        <div class="input-group-append">
                            <button class="btn bg-red cloth-bg-color" onclick="checkEmailField()" type="button">
                                <?= lang('subscribe') ?> <i class="fa fa-long-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-3">
            <h3><?= lang('contacts') ?></h3>
            <hr>
            <?php
            $mapCoordinates = trim(html_entity_decode((string) ($googleMaps ?? '')));
            $mapUrl = $mapCoordinates !== '' ? 'https://www.google.com/maps?q=' . rawurlencode($mapCoordinates) : '';
            ?>
            <ul class="footer-icon list-unstyled">
                <?php if (!empty($footerContactAddr)) { ?>
                    <li class="d-flex mb-2">
                        <span class="mr-2">
                            <?php if ($mapUrl !== '') { ?>
                                <a href="<?= esc($mapUrl) ?>" target="_blank" rel="noopener">
                                    <i class="fa fa-map-marker"></i>
                                </a>
                            <?php } else { ?>
                                <i class="fa fa-map-marker"></i>
                            <?php } ?>
                        </span>
                        <span class="f-cont-info"><?= $footerContactAddr ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($footerContactPhone)) { ?>
                    <li class="d-flex mb-2">
                        <span class="mr-2"><i class="fa fa-phone"></i></span>
                        <span class="f-cont-info"><?= $footerContactPhone ?></span>
                    </li>
                <?php } ?>
                <?php if (!empty($footerContactEmail)) { ?>
                    <li class="d-flex mb-2">
                        <span class="mr-2"><i class="fa fa-envelope"></i></span>
                        <span class="f-cont-info"><a href="mailto:<?= esc($footerContactEmail, 'url') ?>"><?= $footerContactEmail ?></a></span>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div id="button-contact-vr">
            <div id="gom-all-in-one">
                <div id="face-vr" class="button-contact">
                    <div class="phone-vr">
                        <div class="phone-vr-circle-fill"></div>
                        <div class="phone-vr-img-circle">
                            <a
                                target="_blank"
                                rel="nofollow"
                                href="https://m.me/thegioixechaydien.com.vn">
                                <img src="/attachments/site_logo/face.png" />
                            </a>
                        </div>
                    </div>
                </div>
                <div id="zalo-vr" class="button-contact">
                    <div class="phone-vr">
                        <div class="phone-vr-circle-fill"></div>
                        <div class="phone-vr-img-circle">
                            <a
                                target="_blank"
                                rel="nofollow"
                                href="https://zalo.me/859572689369390173">
                                <img src="/attachments/site_logo/zalo.png" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>