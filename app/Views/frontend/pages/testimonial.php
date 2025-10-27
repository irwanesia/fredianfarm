<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('stylesheets') ?>
<style>
    .bg-testimonial {
        /* background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('frontend/img/farm-background.jpg') center center no-repeat; */
        background-size: cover;
    }

    .testimonial-item {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .owl-carousel .owl-item img {
        width: auto !important;
    }
    </style>
<?= $this->endSection() ?>
<!-- Testimonial End -->
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(32, 201, 151, 0.85)), url('frontend/img/carousel-4.png') center/cover;">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold text-white mb-3">Testimoni Petani</h1>
                    <p class="lead text-white mb-4">Lihat pengalaman nyata ratusan petani yang telah sukses dengan bibit kentang FredianFarm</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-chart-line me-2"></i>Hasil Meningkat
                        </span>
                        <span class="badge bg-light text-success fs-6 py-2 px-3">
                            <i class="fas fa-thumbs-up me-2"></i>Kepuasan 95%
                        </span>
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-redo me-2"></i>Repeat Order
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Testimonial Start -->
    <div class="container-fluid my-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center text-dark mb-5">
                        <h6 class="text-warning text-uppercase">Testimoni</h6>
                        <h1 class="display-5 text-dark mb-3">Review dari Google</h1>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="text-warning me-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-dark">4.9/5 dari 20+ Review</span>
                        </div>
                    </div>

                    <div class="owl-carousel testimonial-carousel p-5">
                        <!-- Review 1 -->
                        <div class="testimonial-item text-center text-white">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img class="img-fluid mx-auto p-2 border border-3 border-warning rounded-circle" 
                                    src="frontend/img/user-default.png" 
                                    alt="Ibrahim Boing - Petani Kentang" 
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3 text-start">
                                    <h5 class="text-white mb-1">Ibrahim Boing</h5>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="fs-5 mb-4">"Alhamdullilah sudah hampir 5 tahun saya berlangganan disini,hampir tidak pernah kecewa dengan kualitas pembibitannya,. Semua jenis variate sangat memeuaskan,semoga tetap amanah buat petani2 .kerana sangat sangat membantu khususnya petani kentag di seputar wilayah Dieng.!"</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-warning">2 minggu lalu</small>
                                <div class="d-flex align-items-center">
                                    <img src="frontend/img/google-logo.png" width="20" alt="Google" class="me-2">
                                    <small class="text-white">Google Review</small>
                                </div>
                            </div>
                        </div>

                        <!-- Review 2 -->
                        <div class="testimonial-item text-center text-white">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img class="img-fluid mx-auto p-2 border border-3 border-warning rounded-circle" 
                                    src="frontend/img/user-default.png" 
                                    alt="Khafi Ardannr - Petani Kentang" 
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3 text-start">
                                    <h5 class="text-white mb-1">Khafi Ardannr</h5>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="fs-5 mb-4">"Alhamdulillah sudah 2 kali ngambil bibit kentang di Fredian Farm performa tanaman dari awal tanam hingga panen performanya OK 👍 …!"</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-warning">1 bulan lalu</small>
                                <div class="d-flex align-items-center">
                                    <img src="frontend/img/google-logo.png" width="20" alt="Google" class="me-2">
                                    <small class="text-white">Google Review</small>
                                </div>
                            </div>
                        </div>

                        <!-- Review 3 -->
                        <div class="testimonial-item text-center text-white">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img class="img-fluid mx-auto p-2 border border-3 border-warning rounded-circle" 
                                    src="frontend/img/user-default.png" 
                                    alt="Akhdan Potatoes farm - Petani Kentang" 
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3 text-start">
                                    <h5 class="text-white mb-1">Akhdan Potatoes farm</h5>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="fs-5 mb-4">"Real testy No kaleng2 Panenanya mas Fredian berbobot terus 😍bibit berkualitas menghasilkan hasil yang maksimal😍 …"</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-warning">1 bulan lalu</small>
                                <div class="d-flex align-items-center">
                                    <img src="frontend/img/google-logo.png" width="20" alt="Google" class="me-2">
                                    <small class="text-white">Google Review</small>
                                </div>
                            </div>
                        </div>

                        <!-- Review 4 - Tambahan -->
                        <div class="testimonial-item text-center text-white">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img class="img-fluid mx-auto p-2 border border-3 border-warning rounded-circle" 
                                    src="frontend/img/user-default.png" 
                                    alt="Sur Wandi - Petani Kentang" 
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3 text-start">
                                    <h5 class="text-white mb-1">Sur Wandi</h5>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="fs-5 mb-4">"Stek mininya bagus, ada banyak varietas."</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-warning">2 bulan lalu</small>
                                <div class="d-flex align-items-center">
                                    <img src="frontend/img/google-logo.png" width="20" alt="Google" class="me-2">
                                    <small class="text-white">Google Review</small>
                                </div>
                            </div>
                        </div>

                        <!-- Review 5 - Tambahan -->
                        <div class="testimonial-item text-center text-white">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img class="img-fluid mx-auto p-2 border border-3 border-warning rounded-circle" 
                                    src="frontend/img/user-default.png" 
                                    alt="Yunie Wahyu - Petani Kentang" 
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3 text-start">
                                    <h5 class="text-white mb-1">Yuni Wahyu</h5>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="fs-5 mb-4">"Grend house sangat rapi bersih dan terbebas dari virus. Bibit yang di tanam juga bagus dan hasil yang maksimal.. Sangat rekomend."</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-warning">2 bulan lalu</small>
                                <div class="d-flex align-items-center">
                                    <img src="frontend/img/google-logo.png" width="20" alt="Google" class="me-2">
                                    <small class="text-white">Google Review</small>
                                </div>
                            </div>
                        </div>

                        <!-- Review 6 - Tambahan -->
                        <div class="testimonial-item text-center text-white">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img class="img-fluid mx-auto p-2 border border-3 border-warning rounded-circle" 
                                    src="frontend/img/user-default.png" 
                                    alt="Alwi Said - Petani Kentang" 
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3 text-start">
                                    <h5 class="text-white mb-1">Alwi Said</h5>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="fs-5 mb-4">"Puas banget, pasti amanah."</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-warning">2 bulan lalu</small>
                                <div class="d-flex align-items-center">
                                    <img src="frontend/img/google-logo.png" width="20" alt="Google" class="me-2">
                                    <small class="text-white">Google Review</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="text-center mt-5">
                        <a href="https://www.google.com/search?sca_esv=bbe3debe957613b7&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-EyFskFa3z3KxfPFOWKj9-bCpZO9T0by19RS--Kg1liGccaSNZNEdFnjBOqAF216Q3aeawK97ffU925QFJVwu1Bbp3Gv0vximZwdpy1nOyk1XUh2KJA_sNOmI0s-IU0pDs_Yvd5s%3D&q=Balai+Pembibitan+FREDIAN+FARM+%F0%9F%8C%B1+Reviews&sa=X&ved=2ahUKEwiu4Zq_5Y-QAxVK2TgGHZEeDqUQ0bkNegQIIRAD&biw=1366&bih=599&dpr=1" 
                        target="_blank" 
                        class="btn btn-warning btn-lg px-5">
                            <i class="fab fa-google me-2"></i>Lihat Semua Review di Google
                        </a>
                        <p class="text-white mt-3 small">Bergabung dengan 20+ petani yang sudah membuktikan kualitas FredianFarm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>