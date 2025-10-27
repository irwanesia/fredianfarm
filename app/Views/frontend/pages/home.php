<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('page_meta') ?>
<meta name="robots" content="index,follow" />
<meta name="title" content="<?= get_settings()->blog_title ?>" />
<meta name="description" content="<?= get_settings()->blog_meta_description ?>" />
<meta name="author" content="<?= get_settings()->blog_title ?>" />
<link rel="canonical" href="<?= base_url() ?>" />
<meta property="og:title" content="<?= get_settings()->blog_title ?>" />
<meta property="og:type" content="website" />
<meta property="og:description" content="<?= get_settings()->blog_meta_description ?>" />
<meta property="og:url" content="<?= base_url() ?>" />
<meta property="og:image" content="<?= base_url('images/blog/' . get_settings()->blog_logo) ?>" />
<meta name="twitter:domain" content="<?= base_url() ?>" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" property="og:title" itemprop="name" content="<?= get_settings()->blog_title ?>" />
<meta name="twitter:description" property="og:description" itemprop="description" content="<?= get_settings()->blog_meta_description ?>" />
<meta name="twitter:image" content="<?= base_url('images/blog/' . get_settings()->blog_logo) ?>" />
<?= $this->endSection() ?>

<!-- style -->
<?= $this->section('stylesheets') ?>
    <style>
        /* .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #fd7e14 0%, #ffc107 100%) !important;
        }

        .bg-vegetable {
            background-image: url('path/to/vegetable-pattern.png');
            background-size: cover;
            background-blend-mode: overlay;
        }

        .bg-fruit {
            background-image: url('path/to/fruit-pattern.png');
            background-size: cover;
            background-blend-mode: overlay;
        } */

        .bg-gradient-facts {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        }

        .about img {
            transition: transform 0.3s ease;
        }

        .about img:hover {
            transform: scale(1.02);
        }

        .bg-gradient-feature {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        }

        .feature-card {
            transition: transform 0.3s ease, background 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .feature-card:hover {
            transform: translateX(5px);
            background: rgba(255,255,255,0.2) !important;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <!-- Carousel Start -->
    <div id="header-carousel" class="carousel slide carousel-fade carousel-responsive" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
            
            <!-- Slide 1: Focus on Granola L -->
            <div class="carousel-item active h-100">
                <img class="w-100 h-100" src="frontend/img/carousel-4.png" alt="Bibit Kentang Granola L" style="object-fit: cover;">
                <div class="carousel-caption top-0 bottom-0 start-0 end-0 d-flex flex-column align-items-center justify-content-center">
                    <div class="text-center p-3 p-md-5" style="max-width: 900px;">
                        <div class="badge bg-success mb-2 mb-md-3">Stok Tersedia</div>
                        <h1 class="display-4 display-md-3 text-white mb-2 mb-md-3">Bibit Kentang Granola L</h1>
                        <p class="lead d-none d-md-block text-white mb-3 mb-md-4">Stekmini Outdoor - Garansi Virus - Siap Akhir Tahun</p>
                        <p class="small d-md-none text-white mb-3">Stekmini Outdoor - Garansi Virus</p>
                        <div class="d-flex flex-column flex-md-row gap-2 gap-md-3 justify-content-center">
                            <a href="/products/granola-l" class="btn btn-warning btn-sm btn-md-lg px-3 px-md-4">
                                <i class="fas fa-seedling me-2"></i>Detail Produk
                            </a>
                            <a href="https://wa.me/628xxxxxx" class="btn btn-success btn-sm btn-md-lg px-3 px-md-4">
                                <i class="fab fa-whatsapp me-2"></i>Pesan Langsung
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 dan 3 tetap sama -->
            <div class="carousel-item h-100">
                <img class="w-100 h-100" src="frontend/img/carousel-5.png" alt="Bibit Kentang G0+" style="object-fit: cover;">
                <div class="carousel-caption top-0 bottom-0 start-0 end-0 d-flex flex-column align-items-center justify-content-center">
                    <div class="text-center p-3 p-md-5" style="max-width: 900px;">
                        <div class="badge bg-warning text-dark mb-2 mb-md-3">Limited Stock</div>
                        <h1 class="display-4 display-md-3 text-white mb-2 mb-md-3">Bibit Kentang G0+ Premium</h1>
                        <p class="lead d-none d-md-block text-white mb-3 mb-md-4">Kualitas Terbaik - Hasil Maksimal - Stok Terbatas</p>
                        <p class="small d-md-none text-white mb-3">Kualitas Terbaik - Stok Terbatas</p>
                        <div class="d-flex flex-column flex-md-row gap-2 gap-md-3 justify-content-center">
                            <a href="/products/g0-plus" class="btn btn-primary btn-sm btn-md-lg px-3 px-md-4">
                                <i class="fas fa-info-circle me-2"></i>Info Lengkap
                            </a>
                            <a href="/contact" class="btn btn-light btn-sm btn-md-lg px-3 px-md-4">
                                <i class="fas fa-phone me-2"></i>Konsultasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item h-100">
                <img class="w-100 h-100" src="frontend/img/carousel-6.png" alt="Semua Varietas Kentang" style="object-fit: cover;">
                <div class="carousel-caption top-0 bottom-0 start-0 end-0 d-flex flex-column align-items-center justify-content-center">
                    <div class="text-center p-3 p-md-5" style="max-width: 900px;">
                        <div class="badge bg-info mb-2 mb-md-3">Multiple Varieties</div>
                        <h1 class="display-4 display-md-3 text-white mb-2 mb-md-3">All Varietas Kentang</h1>
                        <p class="lead d-none d-md-block text-white mb-3 mb-md-4">Produksi Bibit G2 Granola L & Varietas Lainnya</p>
                        <p class="small d-md-none text-white mb-3">Bibit G2 Granola & Varietas Lain</p>
                        <div class="d-flex flex-column flex-md-row gap-2 gap-md-3 justify-content-center">
                            <a href="/categories" class="btn btn-outline-light btn-sm btn-md-lg px-3 px-md-4">
                                <i class="fas fa-list me-2"></i>Lihat Varietas
                            </a>
                            <a href="/blog" class="btn btn-outline-warning btn-sm btn-md-lg px-3 px-md-4">
                                <i class="fas fa-book me-2"></i>Tips Budidaya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Carousel End -->

    <!-- Banner Start -->
    <!-- <div class="container-fluid banner mb-5">
        <div class="container">
            <div class="row gx-0">
                <div class="col-md-6">
                    <div class="bg-primary bg-vegetable d-flex flex-column justify-content-center p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Organic Vegetables</h3>
                        <p class="text-white">Dolor magna ipsum elitr sea erat elitr amet ipsum stet justo dolor, amet lorem diam no duo sed dolore amet diam</p>
                        <a class="text-white fw-bold" href="">Read More<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-secondary bg-fruit d-flex flex-column justify-content-center p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Organic Fruits</h3>
                        <p class="text-white">Dolor magna ipsum elitr sea erat elitr amet ipsum stet justo dolor, amet lorem diam no duo sed dolore amet diam</p>
                        <a class="text-white fw-bold" href="">Read More<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner Start -->

    <!-- Banner Start -->
    <div class="container-fluid banner mb-5">
        <div class="container">
            <div class="row gx-0">
                <div class="col-md-6">
                    <div class="bg-success bg-vegetable d-flex flex-column justify-content-center p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Bibit Kentang Granola L</h3>
                        <p class="text-white">Ready stekmini outdoor untuk akhir tahun. Garansi virus, kualitas terjamin dengan hasil panen optimal untuk usaha pertanian Anda.</p>
                        <a class="text-white fw-bold" href="<?= route_to('category-posts', 'granola-l') ?>">
                            Lihat Stok <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-warning bg-fruit d-flex flex-column justify-content-center p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Bibit Kentang G0+</h3>
                        <p class="text-white">Kualitas premium dengan garansi mutu. Yuk mumpung masih ada stok, readykan untuk kebutuhan bibit kentang terbaik Anda.</p>
                        <a class="text-white fw-bold" href="<?= route_to('category-posts', 'g0-plus') ?>">
                            Pesan Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- About Start -->
    <div class="container-fluid about pt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="d-flex h-100 border border-5 border-success border-bottom-0 pt-4">
                        <img class="img-fluid mt-auto mx-auto" src="frontend/img/model-2.png" alt="FredianFarm - Petani Kentang Professional">
                    </div>
                </div>
                <div class="col-lg-6 pb-5">
                    <div class="mb-3 pb-2">
                        <h6 class="text-success text-uppercase">Tentang Kami</h6>
                        <h1 class="display-5">FredianFarm - Spesialis Bibit Kentang Berkualitas</h1>
                    </div>
                    <p class="mb-4">FredianFarm merupakan petani kentang profesional yang berfokus pada produksi dan penyediaan bibit kentang berkualitas tinggi. Dengan pengalaman bertahun-tahun dalam budidaya kentang, kami menghadirkan bibit unggulan dengan garansi kualitas untuk mendukung kesuksesan panen Anda.</p>
                    <div class="row gx-5 gy-4">
                        <div class="col-sm-6">
                            <i class="fas fa-seedling display-1 text-success"></i>
                            <h4>Bibit Berkualitas</h4>
                            <p class="mb-0">Bibit kentang pilihan dengan garansi virus dan kualitas terjamin untuk hasil panen optimal</p>
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-tractor display-1 text-warning"></i>
                            <h4>Teknologi Modern</h4>
                            <p class="mb-0">Menggunakan teknik stekmini outdoor dan metode budidaya terkini untuk kualitas terbaik</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="/about" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-info-circle me-2" style="color: white !important;"></i>Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Facts Start -->
    <div class="container-fluid bg-primary facts py-5 mb-5">
        <div class="container py-5">
            <div class="row gx-5 gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-calendar-alt fs-4 text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white">Tahun Pengalaman</h5>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">5</h1>
                            <small class="text-white-50">+ Tahun Berpengalaman</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-seedling fs-4 text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white">Bibit Terjual</h5>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">50</h1>
                            <small class="text-white-50">+ Ribu Bibit</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-user-check fs-4 text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white">Petani Mitra</h5>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">500</h1>
                            <small class="text-white-50">+ Petani Puas</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-map-marker-alt fs-4 text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white">Area Layanan</h5>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">25</h1>
                            <small class="text-white-50">+ Kota/Kabupaten</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->
    

    <!-- Services Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <h6 class="text-success text-uppercase">Layanan Kami</h6>
                        <h1 class="display-5">Layanan Unggulan FredianFarm</h1>
                    </div>
                    <p class="mb-4">Kami menyediakan berbagai layanan terpadu untuk mendukung kesuksesan budidaya kentang Anda. Dari penyediaan bibit berkualitas hingga pendampingan teknis.</p>
                    <a href="<?= route_to('contact') ?>" class="btn btn-primary py-md-3 px-md-5">
                        <i class="fas fa-phone me-2"></i>Konsultasi Gratis
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item bg-light text-center p-5 border-success rounded">
                        <i class="fas fa-seedling display-1 text-success mb-3"></i>
                        <h4>Bibit Kentang Berkualitas</h4>
                        <p class="mb-0">Penyediaan bibit kentang Granola L, G0+ dan varietas unggulan lainnya dengan garansi kualitas dan bebas virus</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item bg-light text-center p-5 border-warning rounded">
                        <i class="fas fa-shipping-fast display-1 text-warning mb-3"></i>
                        <h4>Pengiriman Nasional</h4>
                        <p class="mb-0">Layanan pengiriman bibit ke seluruh Indonesia dengan packing aman dan garansi sampai dalam kondisi baik</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item bg-light text-center p-5 border-info rounded">
                        <i class="fas fa-user-tie display-1 text-info mb-3"></i>
                        <h4>Konsultasi Budidaya</h4>
                        <p class="mb-0">Pendampingan teknis dan konsultasi gratis dari petani berpengalaman untuk optimalisasi hasil panen Anda</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item bg-light text-center p-5 border-primary rounded">
                        <i class="fas fa-clipboard-check display-1 text-primary mb-3"></i>
                        <h4>Quality Control</h4>
                        <p class="mb-0">Proses seleksi dan quality control ketat untuk memastikan setiap bibit memenuhi standar kualitas tertinggi</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item bg-light text-center p-5 border-danger rounded">
                        <i class="fas fa-shield-alt display-1 text-danger mb-3"></i>
                        <h4>Garansi Kualitas</h4>
                        <p class="mb-0">Garansi bibit bebas virus dan komitmen kami untuk kepuasan serta kesuksesan budidaya kentang Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- Features Start -->
    <div class="container-fluid bg-gradient-feature py-5 pb-lg-0 my-5" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
        <div class="container py-5 pb-lg-0">
            <div class="mx-auto text-center mb-5" style="max-width: 600px; margin-top: -60px">
                <span class="badge bg-warning text-dark mb-3">Keunggulan Kami</span>
                <h1 class="display-6 fw-bold text-white mb-3">Mengapa Petani Mempercayai FredianFarm?</h1>
                <p class="lead text-white">Komitmen kami terhadap kualitas dan kepuasan petani menjadikan FredianFarm pilihan utama untuk bibit kentang</p>
            </div>
            
            <div class="row g-5 align-items-center">
                <div class="col-lg-4">
                    <!-- Left Features -->
                    <div class="feature-card text-white mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-virus-slash fs-4 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-white mb-1">Garansi Virus</h4>
                                <p class="mb-0 small">Bibit dijamin bebas penyakit dengan sertifikasi kualitas</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-white mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-tachometer-alt fs-4 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-white mb-1">Hasil Optimal</h4>
                                <p class="mb-0 small">Tingkat keberhasilan tanam mencapai 95% dengan hasil panen maksimal</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-white p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-hand-holding-usd fs-4 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-white mb-1">Harga Kompetitif</h4>
                                <p class="mb-0 small">Kualitas premium dengan harga terjangkau untuk semua kalangan petani</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <!-- Center Content -->
                    <div class="bg-white h-100 text-center p-5 rounded-3 shadow-lg position-relative">
                        <div class="position-absolute top-0 start-50 translate-middle mt-4">
                            <span class="badge bg-success fs-6 px-3 py-2">Terpercaya</span>
                        </div>
                        <div class="mb-4">
                            <h5 class="text-success fw-bold">"Kualitas Bibit, Hasil Maksimal"</h5>
                            <p class="text-muted">FredianFarm tidak hanya menjual bibit, tetapi memberikan solusi lengkap budidaya kentang yang menguntungkan</p>
                        </div>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <i class="fas fa-calendar-check text-success fa-2x mb-2"></i>
                                    <h5 class="fw-bold mb-1">5+ Tahun</h5>
                                    <small class="text-muted">Pengalaman</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <i class="fas fa-users text-warning fa-2x mb-2"></i>
                                    <h5 class="fw-bold mb-1">500+</h5>
                                    <small class="text-muted">Petani Mitra</small>
                                </div>
                            </div>
                        </div>
                        
                        <img class="img-fluid rounded mt-3" src="frontend/img/blog-1.jpg" alt="Sukses Budidaya Kentang">
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <!-- Right Features -->
                    <div class="feature-card text-white mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-shipping-fast fs-4 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-white mb-1">Pengiriman Aman</h4>
                                <p class="mb-0 small">Packing khusus dan garansi sampai untuk menjaga kualitas bibit</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-white mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-graduation-cap fs-4 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-white mb-1">Pendampingan</h4>
                                <p class="mb-0 small">Konsultasi teknis gratis dari petani berpengalaman</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-white p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-seedling fs-4 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-white mb-1">Teknik Modern</h4>
                                <p class="mb-0 small">Stekmini outdoor dan metode budidaya terkini untuk efisiensi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center my-5">
                <a href="/testimonials" class="btn btn-warning btn-lg px-5 me-3">
                    <i class="fas fa-comments me-2"></i>Testimoni Petani
                </a>
                <a href="/contact" class="btn btn-outline-light btn-lg px-5">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </a>
            </div>
            <div style="color: #20c997">
                test
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-success text-uppercase">Produk Kami</h6>
                <h1 class="display-5">Bibit Kentang Unggulan</h1>
            </div>
            <div class="owl-carousel product-carousel px-5">
                <div class="pb-5">
                    <div class="product-item position-relative bg-white d-flex flex-column text-center border rounded shadow-sm">
                        <img class="img-fluid mb-4" src="frontend/img/product-1.png" alt="Bibit Kentang Granola L">
                        <h6 class="mb-3">Bibit Kentang Granola L</h6>
                        <p class="text-muted small px-3">Stekmini outdoor, garansi virus, siap tanam</p>
                        <h5 class="text-success mb-0">Rp 25.000/kg</h5>
                        <div class="btn-action d-flex justify-content-center mt-3">
                            <a class="btn bg-success py-2 px-3 me-2" href="https://wa.me/628563333235?text=Halo,%20saya%20minat%20bibit%20Granola%20L">
                                <i class="bi bi-whatsapp text-white"></i>
                            </a>
                            <a class="btn bg-secondary py-2 px-3" href="<?= route_to('read-post', 'bibit-kentang-granola-l') ?>">
                                <i class="bi bi-eye text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="product-item position-relative bg-white d-flex flex-column text-center border rounded shadow-sm">
                        <img class="img-fluid mb-4" src="frontend/img/product-2.png" alt="Bibit Kentang G0+">
                        <h6 class="mb-3">Bibit Kentang G0+ Premium</h6>
                        <p class="text-muted small px-3">Kualitas terbaik, hasil maksimal, stok terbatas</p>
                        <h5 class="text-success mb-0">Rp 35.000/kg</h5>
                        <div class="btn-action d-flex justify-content-center mt-3">
                            <a class="btn bg-success py-2 px-3 me-2" href="https://wa.me/628563333235?text=Halo,%20saya%20minat%20bibit%20G0+">
                                <i class="bi bi-whatsapp text-white"></i>
                            </a>
                            <a class="btn bg-secondary py-2 px-3" href="<?= route_to('read-post', 'bibit-kentang-g0-plus') ?>">
                                <i class="bi bi-eye text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="product-item position-relative bg-white d-flex flex-column text-center border rounded shadow-sm">
                        <img class="img-fluid mb-4" src="frontend/img/product-2.png" alt="Bibit G2 Granola">
                        <h6 class="mb-3">Bibit G2 Granola</h6>
                        <p class="text-muted small px-3">Produksi lokal, kualitas terjamin, harga ekonomis</p>
                        <h5 class="text-success mb-0">Rp 20.000/kg</h5>
                        <div class="btn-action d-flex justify-content-center mt-3">
                            <a class="btn bg-success py-2 px-3 me-2" href="https://wa.me/628563333235?text=Halo,%20saya%20minat%20bibit%20G2%20Granola">
                                <i class="bi bi-whatsapp text-white"></i>
                            </a>
                            <a class="btn bg-secondary py-2 px-3" href="<?= route_to('read-post', 'bibit-g2-granola') ?>">
                                <i class="bi bi-eye text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="product-item position-relative bg-white d-flex flex-column text-center border rounded shadow-sm">
                        <img class="img-fluid mb-4" src="frontend/img/product-1.png" alt="Paket All Varietas">
                        <h6 class="mb-3">Paket All Varietas</h6>
                        <p class="text-muted small px-3">Campuran varietas untuk diversifikasi hasil panen</p>
                        <h5 class="text-success mb-0">Rp 30.000/kg</h5>
                        <div class="btn-action d-flex justify-content-center mt-3">
                            <a class="btn bg-success py-2 px-3 me-2" href="https://wa.me/628563333235?text=Halo,%20saya%20minat%20Paket%20All%20Varietas">
                                <i class="bi bi-whatsapp text-white"></i>
                            </a>
                            <a class="btn bg-secondary py-2 px-3" href="<?= route_to('categories') ?>">
                                <i class="bi bi-eye text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Testimonial Start -->
    <div class="container-fluid bg-testimonial py-5 my-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="owl-carousel testimonial-carousel p-5">
                        <div class="testimonial-item text-center text-white">
                            <img class="img-fluid mx-auto p-2 border border-5 border-warning rounded-circle mb-4" src="frontend/img/farmer-1.jpg" alt="Pak Budi - Petani Kentang">
                            <p class="fs-5">"Sejak pakai bibit dari FredianFarm, hasil panen saya meningkat 40%. Bibit Granola L-nya benar-benar bebas virus dan tumbuh serempak. Pelayanannya juga cepat!"</p>
                            <div class="text-warning mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <hr class="mx-auto w-25">
                            <h4 class="text-white mb-0">Pak Budi</h4>
                            <small class="text-warning">Petani Kentang - Malang</small>
                        </div>
                        <div class="testimonial-item text-center text-white">
                            <img class="img-fluid mx-auto p-2 border border-5 border-warning rounded-circle mb-4" src="frontend/img/farmer-2.jpg" alt="Ibu Sari - Petani Kentang">
                            <p class="fs-5">"G0+ dari FredianFarm memang beda! Bibitnya sehat dan pertumbuhannya cepat. Timnya juga responsif banget, setiap ada masalah langsung dibantu. Recommended banget!"</p>
                            <div class="text-warning mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <hr class="mx-auto w-25">
                            <h4 class="text-white mb-0">Ibu Sari</h4>
                            <small class="text-warning">Petani Kentang - Batu</small>
                        </div>
                        <div class="testimonial-item text-center text-white">
                            <img class="img-fluid mx-auto p-2 border border-5 border-warning rounded-circle mb-4" src="frontend/img/farmer-3.jpg" alt="Pak Joko - Petani Kentang">
                            <p class="fs-5">"Pengiriman cepat dan packing aman. Bibit sampai dalam kondisi segar. Yang paling saya suka, garansi virusnya bikin tenang. Sudah 3 kali repeat order dan selalu puas."</p>
                            <div class="text-warning mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <hr class="mx-auto w-25">
                            <h4 class="text-white mb-0">Pak Joko</h4>
                            <small class="text-warning">Petani Kentang - Pasuruan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-success text-uppercase">Tim Kami</h6>
                <h1 class="display-5">Petani Professional FredianFarm</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="row g-0">
                        <div class="col-10">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="frontend/img/tim-1.png" alt="Fredi - Founder FredianFarm">
                                <div class="position-absolute start-0 bottom-0 w-100 py-3 px-4" style="background: rgba(40, 167, 69, .85);">
                                    <h4 class="text-white">Fredi</h4>
                                    <span class="text-white">Founder & Petani Ahli</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="h-100 d-flex flex-column align-items-center justify-content-around bg-warning py-5">
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fab fa-tiktok text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fab fa-instagram text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fab fa-whatsapp text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fab fa-youtube text-warning"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="row g-0">
                        <div class="col-10">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="frontend/img/tim-2.png" alt="Tim Agronomist">
                                <div class="position-absolute start-0 bottom-0 w-100 py-3 px-4" style="background: rgba(40, 167, 69, .85);">
                                    <h4 class="text-white">Tim Agronomist</h4>
                                    <span class="text-white">Spesialis Budidaya Kentang</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="h-100 d-flex flex-column align-items-center justify-content-around bg-warning py-5">
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-seedling text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-clipboard-check text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-microscope text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-tractor text-warning"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="row g-0">
                        <div class="col-10">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="frontend/img/tim-2.png" alt="Tim Support">
                                <div class="position-absolute start-0 bottom-0 w-100 py-3 px-4" style="background: rgba(40, 167, 69, .85);">
                                    <h4 class="text-white">Tim Support</h4>
                                    <span class="text-white">Customer Service & Logistics</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="h-100 d-flex flex-column align-items-center justify-content-around bg-warning py-5">
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-headset text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-shipping-fast text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-phone-alt text-warning"></i></a>
                                <a class="btn btn-square rounded-circle bg-white" href="#"><i class="fas fa-comments text-warning"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Blog Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-success text-uppercase">Blog & Tips</h6>
                <h1 class="display-5">Tips Budidaya Kentang</h1>
            </div>
            <div class="row g-5">
                    <?php if (count(get_3_home_latest_posts()) > 0) : ?>
                        <?php foreach (get_3_home_latest_posts() as $post) : ?>
                            <div class="col-lg-4">
                                <div class="blog-item position-relative overflow-hidden rounded shadow-sm">
                                    <img class="img-fluid" src="/images/posts/resized_<?= $post->featured_image ?>" alt="">
                                    <a class="blog-overlay" href="<?= route_to('read-post', $post->slug) ?>">
                                        <h4 class="text-white"><?= $post->title ?></h4>
                                        <div class="d-flex justify-content-between align-items-center text-white">
                                            <span class="fw-bold"><?= date_formatter($post->created_at) ?></span>
                                            <!-- Reading time sejajar dengan tanggal -->
                                            <small class="text-white-50 d-block mt-2">
                                                <i class="fas fa-clock me-1"></i>
                                                <?= get_reading_time($post->content) ?>
                                            </small>
                                        </div>
                                    </a>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
            </div>
            <div class="text-center mt-5">
                <a href="<?= route_to('blog') ?>" class="btn btn-success btn-lg px-5">
                    <i class="fas fa-book me-2"></i>Lihat Semua Artikel
                </a>
            </div>
        </div>
    </div>
    <!-- Blog End -->
    
<?= $this->endSection() ?>