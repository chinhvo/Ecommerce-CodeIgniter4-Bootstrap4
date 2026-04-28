<aside class="col-md-4 col-12 top-news-home">
    <div class="top-news-card top-news-tabs-wrap">
        <ul class="nav nav-tabs top-news-tabs" id="topNewsTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="newstablink" data-toggle="tab" href="#newstab" role="tab" aria-controls="newstab" aria-selected="true">
                    <i class="fa fa-file-text" aria-hidden="true"></i> Tin tức mới
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pagefacelink" data-toggle="tab" href="#pageface" role="tab" aria-controls="pageface" aria-selected="false">Facebook</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="galalink" data-toggle="tab" href="#gala" role="tab" aria-controls="gala" aria-selected="false">
                    <i class="fa fa-picture-o" aria-hidden="true"></i> Videos
                </a>
            </li>
        </ul>

        <div class="tab-content top-news-tab-content">
            <div class="tab-pane fade show active" id="newstab" role="tabpanel" aria-labelledby="newstablink">
                <table class="table table-borderless bestsellers-table mb-2">
                    <tbody>
                        <?php if (!empty($lastBlogs)) { ?>
                            <?php foreach ($lastBlogs as $post) { ?>
                                <tr class="bestseller-item">
                                    <td class="product-thumbnail">
                                        <a href="<?= LANG_URL . '/blog/' . $post['url'] ?>">
                                            <img src="<?= base_url('attachments/blog_images/' . $post['image']) ?>" alt="<?= esc($post['title']) ?>" class="img-fluid">
                                        </a>
                                    </td>
                                    <td class="product-info">
                                        <p>
                                            <a href="<?= LANG_URL . '/blog/' . $post['url'] ?>"><?= character_limiter($post['title'], 80) ?></a>
                                        </p>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td>
                                    <div class="alert alert-info mb-0"><?= lang('no_posts') ?></div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-right">
                    <strong><a class="blue" href="<?= base_url('blog') ?>">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></strong>
                </div>
            </div>

            <div class="tab-pane fade" id="pageface" role="tabpanel" aria-labelledby="pagefacelink">
                <div class="facebook-pane">
                    <iframe
                        title="Facebook"
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fthegioixechaydien.com.vn&tabs=timeline&width=340&height=430&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true"
                        width="100%"
                        height="430"
                        style="border:none;overflow:hidden"
                        scrolling="no"
                        frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>

            <div class="tab-pane fade" id="gala" role="tabpanel" aria-labelledby="galalink">
                <div class="video-pane">
                    <div class="embed-responsive embed-responsive-16by9 mb-2">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/NljrQlmt028" allowfullscreen title="Video Xe Chay Dien"></iframe>
                    </div>
                    <ul class="video-links list-unstyled mb-2">
                        <li><a href="https://www.youtube.com/watch?v=NljrQlmt028" target="_blank" rel="noopener">Xe dien V1 Plus Livo Trang Den</a></li>
                        <li><a href="https://www.youtube.com/watch?v=b-Dai6_SwvY" target="_blank" rel="noopener">Xe may dien TAILG F73</a></li>
                        <li><a href="https://www.youtube.com/watch?v=O5JSqW-hs7Q" target="_blank" rel="noopener">Xe dien TYPE3 Pro</a></li>
                        <li><a href="https://www.youtube.com/watch?v=FfQqxvd5_RI" target="_blank" rel="noopener">Danh gia o to dien Bestune Xiaoma</a></li>
                    </ul>
                    <div class="text-right">
                        <strong><a class="blue" href="https://www.youtube.com/@thegioixechaydien" target="_blank" rel="noopener"><?= lang('read_more') ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>