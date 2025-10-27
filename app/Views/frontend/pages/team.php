<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(32, 201, 151, 0.85)), url('frontend/img/carousel-6.png') center/cover;">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold text-white mb-3">Tim FredianFarm</h1>
                    <p class="lead text-white mb-4">Bertemu dengan petani profesional dan ahli budidaya kentang yang siap membantu kesuksesan Anda</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-user-tie me-2"></i>Ahli Agronomi
                        </span>
                        <span class="badge bg-light text-success fs-6 py-2 px-3">
                            <i class="fas fa-tractor me-2"></i>Petani Berpengalaman
                        </span>
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-graduation-cap me-2"></i>Pendamping Teknis
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


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