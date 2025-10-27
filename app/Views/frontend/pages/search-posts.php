<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5" hidden>
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">Artikel</h1>
                    <a href="" class="btn btn-primary py-md-3 px-md-5 me-3">Home</a>
                    <a href="" class="btn btn-secondary py-md-3 px-md-5">Artikel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <!-- Search Results Start -->
            <div class="col-lg-8">
                <!-- Search Header -->
                <div class="mb-5">
                    <h1 class="mb-3">Search Results</h1>
                    <p class="text-muted">
                        <?php if (!empty($search)) : ?>
                            Showing results for: "<strong><?= esc($search) ?></strong>"
                        <?php endif; ?>
                        <span class="ms-3">Found <?= number_format($total) ?> results</span>
                    </p>
                    
                    <!-- Back to Blog Link -->
                    <a href="<?= route_to('blog') ?>" class="btn btn-outline-primary btn-sm mb-4">
                        <i class="bi bi-arrow-left me-1"></i>Back to Blog
                    </a>
                </div>

                <!-- Search Results -->
                <div class="row g-5">
                    <?php if (!empty($posts) && count($posts) > 0) : ?>
                        <?php foreach ($posts as $post) : ?>
                            <div class="col-md-6">
                                <article class="blog-item position-relative overflow-hidden">
                                    <img class="img-fluid" src="/images/posts/resized_<?= $post->featured_image ?>" alt="<?= $post->title ?>">
                                    <a class="blog-overlay" href="<?= route_to('read-post', $post->slug) ?>">
                                        <h4 class="text-white"><?= $post->title ?></h4>
                                        <div class="d-flex justify-content-between align-items-center text-white">
                                            <span class="fw-bold"><?= date_formatter($post->created_at) ?></span>
                                            <small class="text-white-50 mt-1" style="margin-left: 20px;">
                                                <i class="fas fa-clock me-1"></i>
                                                <?= get_reading_time($post->content) ?>
                                            </small>
                                        </div>
                                    </a>
                                </article>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="col-12">
                            <div class="alert alert-info text-center py-5">
                                <i class="bi bi-search display-4 d-block text-muted mb-3"></i>
                                <h4 class="text-muted">No posts found</h4>
                                <p class="text-muted">Try different keywords or browse all posts</p>
                                <a href="<?= route_to('blog') ?>" class="btn btn-primary mt-2">
                                    Browse All Posts
                                </a>
                            </div>
                        </div>
                    <?php endif ?>

                    <!-- Pagination -->
                    <div class="col-12">
                        <div class="row">
                            <?php if (isset($pager) && $pager && isset($page) && isset($perPage) && isset($total)) : ?>
                                <?= $pager->makeLinks($page, $perPage, $total, 'custom_pagination_view'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-center">
                                <small class="text-muted">
                                    Showing <?= number_format(($page - 1) * $perPage + 1) ?> - 
                                    <?= number_format(min($page * $perPage, $total)) ?> 
                                    of <?= number_format($total) ?> results
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Results End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">

                <!-- Search Form Start -->
                <div class="mb-5">
                    <form action="<?= route_to('search-posts') ?>" method="GET">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control p-3" placeholder="Keyword" 
                                value="<?= isset($_GET['q']) ? esc($_GET['q']) : '' ?>">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div> -->
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-primary p-4">
                        <?php foreach (get_categories() as $category) : ?>
                            <a class="fs-5 fw-bold text-white mb-2" href="<?= route_to('category-posts', $category->slug) ?>"><i class="bi bi-arrow-right me-2"></i><?= $category->name ?></a>
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
                    <h2 class="mb-4">Bibit Unggulan</h2>
                    <div class="bg-primary text-center text-white" style="padding: 30px;">
                        <p>Dapatkan bibit kentang varietas Granola & Atlantic dengan kualitas terbaik. Hasil panen melimpah, tahan penyakit, dan sudah terbukti di berbagai daerah di Indonesia.</p>
                        <a href="<?= route_to('products') ?>" class="btn btn-secondary py-2 px-4">Pesan Sekarang</a>
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
<?= $this->endSection() ?>