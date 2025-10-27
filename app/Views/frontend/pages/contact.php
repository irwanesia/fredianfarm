<?= $this->extend('frontend/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(32, 201, 151, 0.85)), url('frontend/img/carousel-5.png') center/cover;">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold text-white mb-3">Hubungi Kami</h1>
                    <p class="lead text-white mb-4">Konsultasi gratis dengan tim ahli kami untuk solusi budidaya bibit kentang terbaik</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <a href="https://wa.me/628563333235"  class="text-decoration-none text-dark" >
                                <i class="fab fa-whatsapp me-2"></i>Fast Response
                            </a>
                        </span>
                        <span class="badge bg-light text-success fs-6 py-2 px-3">
                            <i class="fas fa-headset me-2"></i>Support 24/7
                        </span>
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-comments me-2"></i>Konsultasi Gratis
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center" style="max-width: 500px;">
                <!-- <h6 class="text-primary text-uppercase">Hubungi Kami</h6>
                <h1 class="display-5">Konsultasi Gratis Bibit Kentang</h1> -->
            </div>
            <div class="row g-0">
                <div class="col-lg-7">
                    <div class="bg-primary h-100 p-5">
                        <form>
                            <div class="row g-3">
                                <div class="col-6">
                                    <input type="text" class="form-control bg-light border-0 px-4" placeholder="Nama Lengkap" style="height: 55px;">
                                </div>
                                <div class="col-6">
                                    <input type="email" class="form-control bg-light border-0 px-4" placeholder="Email" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control bg-light border-0 px-4" placeholder="Subjek" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-light border-0 px-4 py-3" rows="4" placeholder="Pesan (jenis bibit kentang yang diminati, jumlah, lokasi, dll)"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="bg-secondary h-100 p-5">
                        <h2 class="text-white mb-4">Info Kontak</h2>
                        
                        <div class="d-flex mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-geo-alt fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">Lokasi Kami</h5>
                                <span class="text-white">Jl. Raya Pertanian No. 123<br>Magelang, Jawa Tengah</span>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-envelope-open fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">Email</h5>
                                <span class="text-white">info@fredianfarm.com<br>order@fredianfarm.com</span>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-whatsapp fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">WhatsApp</h5>
                                <span class="text-white">+62 856 3333 235<br>(Fast Response)</span>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-clock fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">Jam Operasional</h5>
                                <span class="text-white">Senin - Sabtu: 08.00 - 17.00 WIB</span>
                            </div>
                        </div>

                        <!-- Tambahan untuk media sosial -->
                        <div class="mt-4 pt-3 border-top border-white">
                            <h5 class="text-white mb-3">Follow Kami</h5>
                            <div class="d-flex">
                                <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-primary btn-square rounded-circle" href="#"><i class="fab fa-tiktok"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
<?= $this->endSection() ?>