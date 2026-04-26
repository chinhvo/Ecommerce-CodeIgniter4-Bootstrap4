<div class="col-12 px-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom top-shop-menu">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#shopTopMenu" aria-controls="shopTopMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="shopTopMenu">
                <ul class="navbar-nav mr-auto w-100">
                    <li class="nav-item <?= uri_string() === '' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url() ?>"><?= lang('home') ?></a>
                    </li>

                    <?php if (! empty($nav_categories)) { ?>
                        <?php foreach ($nav_categories as $category) { ?>
                            <?php $hasChildren = ! empty($category['children']); ?>
                            <li class="nav-item <?= $hasChildren ? 'dropdown' : '' ?>">
                                <a
                                    class="nav-link <?= $hasChildren ? 'dropdown-toggle' : '' ?>"
                                    href="<?= base_url('?category=' . $category['id']) ?>"
                                    <?= $hasChildren ? 'id="category_' . $category['id'] . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '' ?>
                                >
                                    <?= esc($category['name']) ?>
                                </a>

                                <?php if ($hasChildren) { ?>
                                    <div class="dropdown-menu" aria-labelledby="category_<?= $category['id'] ?>">
                                        <?php foreach ($category['children'] as $child) { ?>
                                            <a class="dropdown-item" href="<?= base_url('?category=' . $child['id']) ?>">
                                                <?= esc($child['name']) ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if (in_array('blog', $nonDynPages ?? [], true)) { ?>
                        <li class="nav-item <?= strpos(uri_string(), 'blog') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('blog') ?>"><?= lang('blog') ?></a>
                        </li>
                    <?php } ?>

                    <li class="nav-item <?= strpos(uri_string(), 'contacts') !== false ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('contacts') ?>"><?= lang('contacts') ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
