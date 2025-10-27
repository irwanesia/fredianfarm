<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(32, 201, 151, 0.85)), url('frontend/img/carousel-6.png') center/cover;">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold text-white mb-3">Tentang FredianFarm</h1>
                    <p class="lead text-white mb-4">Spesialis bibit kentang berkualitas dengan pengalaman 5+ tahun melayani petani di seluruh Indonesia</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-award me-2"></i>Berkualitas
                        </span>
                        <span class="badge bg-light text-success fs-6 py-2 px-3">
                            <i class="fas fa-shield-alt me-2"></i>Garansi Virus
                        </span>
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-truck me-2"></i>Pengiriman Nasional
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


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
<?= $this->endSection() ?>