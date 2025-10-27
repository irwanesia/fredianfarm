<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(32, 201, 151, 0.85)), url('frontend/img/carousel-5.png') center/cover;">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold text-white mb-3">Keunggulan FredianFarm</h1>
                    <p class="lead text-white mb-4">Temukan alasan mengapa ratusan petani mempercayakan bibit kentang mereka kepada FredianFarm</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="badge bg-warning text-white fs-6 py-2 px-3">
                            <i class="fas fa-shield-alt me-2"></i>Garansi Bebas Virus
                        </span>
                        <span class="badge bg-light text-success fs-6 py-2 px-3">
                            <i class="fas fa-shipping-fast me-2"></i>Pengiriman Nasional
                        </span>
                        <span class="badge bg-warning text-white fs-6 py-2 px-3">
                            <i class="fas fa-headset me-2"></i>Support 24/7
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Features Start -->
    <div class="container-fluid">
        <div class="container py-5 pb-lg-0 border border-shadwow rounded-3">
            <div class="mx-auto text-center mb-5" style="max-width: 600px; margin-top: -60px">
                <span class="badge bg-warning text-dark mb-3">Keunggulan Kami</span>
                <h1 class="display-6 fw-bold text-dark mb-3">Mengapa Petani Mempercayai FredianFarm?</h1>
                <p class="lead text-dark">Komitmen kami terhadap kualitas dan kepuasan petani menjadikan FredianFarm pilihan utama untuk bibit kentang</p>
            </div>
            
            <div class="row g-5 align-items-center">
                <div class="col-lg-4">
                    <!-- Left Features -->
                    <div class="feature-card text-dark mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-virus-slash fs-4 text-dark"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Garansi Virus</h4>
                                <p class="mb-0 small">Bibit dijamin bebas penyakit dengan sertifikasi kualitas</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-dark mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-tachometer-alt fs-4 text-dark"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Hasil Optimal</h4>
                                <p class="mb-0 small">Tingkat keberhasilan tanam mencapai 95% dengan hasil panen maksimal</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-dark p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-hand-holding-usd fs-4 text-dark"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Harga Kompetitif</h4>
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
                    <div class="feature-card text-dark mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-shipping-fast fs-4 text-dark"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Pengiriman Aman</h4>
                                <p class="mb-0 small">Packing khusus dan garansi sampai untuk menjaga kualitas bibit</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-dark mb-4 p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-graduation-cap fs-4 text-dark"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Pendampingan</h4>
                                <p class="mb-0 small">Konsultasi teknis gratis dari petani berpengalaman</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-card text-dark p-4 rounded-3" style="background: rgba(255,255,255,0.1);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning rounded-pill d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-seedling fs-4 text-dark"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Teknik Modern</h4>
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
                <a href="/contact" class="btn btn-outline-dark btn-lg px-5">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
    <!-- Features End -->
<?= $this->endSection() ?>