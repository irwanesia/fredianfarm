<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(32, 201, 151, 0.85)), url('frontend/img/services-hero.jpg') center/cover;" hidden>
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold text-white mb-3">Layanan FredianFarm</h1>
                    <p class="lead text-white mb-4">Solusi lengkap budidaya kentang dari penyediaan bibit berkualitas hingga pendampingan teknis profesional</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-seedling me-2"></i>Bibit Premium
                        </span>
                        <span class="badge bg-light text-success fs-6 py-2 px-3">
                            <i class="fas fa-shipping-fast me-2"></i>Pengiriman Cepat
                        </span>
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-headset me-2"></i>Konsultasi Gratis
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


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
<?= $this->endSection() ?>