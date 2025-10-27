<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(32, 201, 151, 0.85)), url('frontend/img/carousel-4.png') center/cover;" hidden>
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold text-white mb-3">Detail Artikel</h1>
                    <p class="lead text-white mb-4">Temukan insight mendalam seputar budidaya kentang dari para ahli FredianFarm</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-book-open me-2"></i>Panduan Lengkap
                        </span>
                        <span class="badge bg-light text-success fs-6 py-2 px-3">
                            <i class="fas fa-lightbulb me-2"></i>Tips Praktis
                        </span>
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-chart-line me-2"></i>Hasil Optimal
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->  


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <!-- Featured Image -->
                    <?php if (!empty($post->featured_image)) : ?>
                        <div class="mb-4">
                            <img class="img-fluid w-100 rounded" 
                                src="/images/posts/<?= $post->featured_image ?>" 
                                alt="<?= $post->title ?>"
                                style="height: 300px; object-fit: cover;">
                        </div>
                    <?php endif; ?>

                    <!-- Post Meta -->
                    <ul class="post-meta mb-2 mt-4 list-unstyled d-flex flex-wrap">
                        <li class="me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                                <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"></path>
                            </svg> 
                            <span><?= date_formatter($post->created_at) ?></span>
                        </li>
                        <?php if (!empty($post->author_name)) : ?>
                            <li class="me-4">
                                <i class="bi bi-person me-1"></i>
                                <?= $post->author_name ?>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($post->views)) : ?>
                            <li class="me-4">
                                <i class="bi bi-eye me-1"></i>
                                <?= $post->views ?> views
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($post->category_name)) : ?>
                            <li class="me-4">
                                <i class="bi bi-folder me-1"></i>
                                <a href="<?= route_to('category-posts', $post->category_id) ?>" class="text-dark text-decoration-none">
                                    <?= $post->category_name ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Post Title -->
                    <h1 class="mb-4"><?= $post->title ?></h1>

                    <!-- Tags -->
                    <?php if (count(get_tags_by_post_id($post->id))) : ?>
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <strong class="me-3">Tags:</strong>
                            <?php foreach (get_tags_by_post_id($post->id) as $tag) : ?>
                                <a href="<?= route_to('tag-posts', urlencode($tag)) ?>" class="btn btn-sm btn-outline-primary m-1">
                                    <?= $tag ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="content text-left">
                        <?= $post->content ?>
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="d-flex align-items-center">
                            <strong class="me-3">Bagikan:</strong>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" 
                            target="_blank" class="btn btn-sm btn-primary rounded-circle me-2">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= urlencode($post->title) ?>" 
                            target="_blank" class="btn btn-sm btn-primary rounded-circle me-2">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text=<?= urlencode($post->title . ' ' . current_url()) ?>" 
                            target="_blank" class="btn btn-sm btn-primary rounded-circle me-2">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= current_url() ?>" 
                            target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Blog Detail End -->

                <!-- Disqus Comments -->
                <div class="mt-5">
                    <div id="disqus_thread"></div>
                    <script type="application/javascript">
                        var disqus_config = function() {
                            this.page.url = '<?= current_url() ?>';
                            this.page.identifier = 'post-<?= $post->id ?>';
                        };
                        (function() {
                            if (["localhost", "127.0.0.1"].indexOf(window.location.hostname) != -1) {
                                document.getElementById('disqus_thread').innerHTML = 'Disqus comments not available by default when the website is previewed locally.';
                                return;
                            }
                            var d = document,
                                s = d.createElement('script');
                            s.async = true;
                            s.src = '//' + "themefisher-template" + '.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
                    </noscript>
                    <a href="https://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
                </div>
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-primary p-4">
                        <?php foreach (get_categories() as $category) : ?>
                            <a class="fs-5 fw-bold text-white mb-2" href="<?= route_to('category-posts', $category->id) ?>"><i class="bi bi-arrow-right me-2"></i><?= $category->name ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>
                    <div class="bg-primary p-4">
                        <?php foreach (sidebar_latest_posts() as $post) : ?>
                            <div class="d-flex overflow-hidden mb-3">
                                <img class="img-fluid flex-shrink-0" src="/images/posts/thumb_<?= $post->featured_image ?>" style="width: 75px;" alt="">
                                <a href="<?= route_to('read-post', $post->slug) ?>" class="d-flex align-items-center bg-white text-dark fs-6 px-3 mb-0">
                                    <?= limit_words($post->title, 6) ?>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <!-- Recent Post End -->

                <!-- Image Start -->
                <div class="mb-5">
                    <img src="frontend/img/blog-1.jpg" alt="" class="img-fluid rounded">
                </div>
                <!-- Image End -->

                <!-- Tags Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Tag Ferdian Farm</h2>
                    <div class="d-flex flex-wrap m-n1">
                        <?php foreach (get_tags() as $tag) : ?>
                            <a href="<?= route_to('tag-posts', urlencode($tag)) ?>" class="btn btn-sm btn-primary m-1"><?= $tag ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <!-- Tags End -->

                <!-- Plain Text Start -->
                <div>
                    <h2 class="mb-4">Konsultasi Gratis</h2>
                    <div class="bg-primary text-center text-white" style="padding: 30px;">
                        <p>Butuh bantuan teknis budidaya kentang? Tim ahli kami siap membantu konsultasi gratis via WhatsApp untuk hasil panen maksimal.</p>
                        <a href="https://wa.me/628563333235" class="btn btn-secondary py-2 px-4">Chat Sekarang</a>
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
<?= $this->endSection() ?>