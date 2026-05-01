<div class="col-12 mb-3">
    <div class="store-pico" id="store-pico">
        <h5 class="text-center showroom-section-title"><?= lang('showroom_section_title') ?></h5>
        <?php if (!empty($showrooms)) : ?>
            <div class="row">
                <?php foreach ($showrooms as $showroom) : ?>
                    <?php
                    $mapLocation = trim((string) ($showroom['google_map_location'] ?? ''));
                    $mapQuery = trim((string) ($showroom['address'] ?? ''));

                    if ($mapLocation !== '') {
                        if (preg_match('/[?&]q=([^&]+)/', $mapLocation, $qMatches)) {
                            $mapQuery = urldecode($qMatches[1]);
                        } elseif (preg_match('/@(-?[0-9.]+),(-?[0-9.]+)/', $mapLocation, $coordMatches)) {
                            $mapQuery = $coordMatches[1] . ',' . $coordMatches[2];
                        }
                    }

                    $mapImage = '';
                    if ($mapQuery !== '') {
                        $encodedMapQuery = rawurlencode($mapQuery);
                        $mapImage = 'https://maps.googleapis.com/maps/api/staticmap?size=640x360&zoom=15&maptype=roadmap&markers=color:red%7C' . $encodedMapQuery . '&center=' . $encodedMapQuery;
                    }

                    $fallbackImage = !empty($showroom['main_image']) ? base_url(esc($showroom['main_image'])) : '';
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <?php if ($mapImage !== '') : ?>
                                <img src="<?= esc($mapImage, 'attr') ?>"
                                    class="card-img-top"
                                    alt="<?= esc($showroom['name']) ?>"
                                    onerror="<?= $fallbackImage !== '' ? "this.onerror=null;this.src='" . esc($fallbackImage, 'attr') . "';" : 'this.style.display=\'none\';' ?>"
                                    style="height: 200px; object-fit: cover;">
                            <?php elseif (!empty($showroom['main_image'])) : ?>
                                <img src="<?= base_url(esc($showroom['main_image'])) ?>"
                                    class="card-img-top"
                                    alt="<?= esc($showroom['name']) ?>"
                                    style="height: 200px; object-fit: cover;">
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title mb-2"><?= esc($showroom['name']) ?></h5>
                                <p class="card-text mb-2">
                                    <i class="fa fa-map-marker"></i>
                                    <strong><?= lang('showroom_address_label') ?>:</strong>
                                    <?= esc($showroom['address']) ?>
                                </p>

                                <?php if (!empty($showroom['contact_phone'])) : ?>
                                    <p class="card-text mb-1">
                                        <i class="fa fa-phone"></i>
                                        <strong><?= lang('showroom_contact_label') ?>:</strong>
                                        <?= esc($showroom['contact_phone']) ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($showroom['email'])) : ?>
                                    <p class="card-text mb-1">
                                        <i class="fa fa-envelope"></i>
                                        <?= esc($showroom['email']) ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($showroom['google_map_location'])) : ?>
                                    <a href="<?= esc($showroom['google_map_location']) ?>" target="_blank" rel="noopener nofollow" class="btn btn-outline-primary btn-sm mt-2">
                                        <?= lang('showroom_view_google_map') ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info mb-0"><?= lang('showroom_empty_message') ?></div>
        <?php endif; ?>
    </div>
</div>