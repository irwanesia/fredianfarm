<div class="container-fluid bg-footer bg-success text-white mt-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <h4 class="text-white mb-4">Hubungi Kami</h4>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-warning me-2"></i>
                            <p class="text-white mb-0">Jl. Pertanian No. 123, Malang, Jawa Timur</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-warning me-2"></i>
                            <p class="text-white mb-0">info@fredianfarm.com</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-warning me-2"></i>
                            <p class="text-white mb-0">+62 857-XXXX-XXXX</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="fab fa-whatsapp text-warning me-2"></i>
                            <p class="text-white mb-0">+62 857-XXXX-XXXX</p>
                        </div>
                        <div class="d-flex mt-4">
                            <?php 
                                $social_media = get_social_media();
                            ?>
                            <a class="btn btn-warning btn-square rounded-circle me-2" href="<?= ($social_media->github_url) ?>"><i class="fab fa-tiktok"></i></a>
                            <a class="btn btn-warning btn-square rounded-circle me-2" href="<?= ($social_media->instagram_url) ?>"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-warning btn-square rounded-circle me-2" href="<?= ($social_media->facebook_url) ?>"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-warning btn-square rounded-circle " href="<?= ($social_media->youtube_url) ?>"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Menu Utama</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="/"><i class="bi bi-arrow-right text-warning me-2"></i>Beranda</a>
                            <a class="text-white mb-2" href="/about"><i class="bi bi-arrow-right text-warning me-2"></i>Tentang Kami</a>
                            <a class="text-white mb-2" href="/products"><i class="bi bi-arrow-right text-warning me-2"></i>Produk Bibit</a>
                            <a class="text-white mb-2" href="/blog"><i class="bi bi-arrow-right text-warning me-2"></i>Tips Budidaya</a>
                            <a class="text-white mb-2" href="/testimonials"><i class="bi bi-arrow-right text-warning me-2"></i>Testimoni</a>
                            <a class="text-white" href="/contact"><i class="bi bi-arrow-right text-warning me-2"></i>Kontak</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Produk Kami</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="/products/granola-l"><i class="bi bi-arrow-right text-warning me-2"></i>Bibit Granola L</a>
                            <a class="text-white mb-2" href="/products/g0-plus"><i class="bi bi-arrow-right text-warning me-2"></i>Bibit G0+ Premium</a>
                            <a class="text-white mb-2" href="/products/g2-granola"><i class="bi bi-arrow-right text-warning me-2"></i>Bibit G2 Granola</a>
                            <a class="text-white mb-2" href="/products/all-varietas"><i class="bi bi-arrow-right text-warning me-2"></i>Paket All Varietas</a>
                            <a class="text-white mb-2" href="/categories"><i class="bi bi-arrow-right text-warning me-2"></i>Semua Varietas</a>
                            <a class="text-white" href="/contact"><i class="bi bi-arrow-right text-warning me-2"></i>Konsultasi Gratis</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-lg-n5">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-warning p-5">
                    <h4 class="text-white">Newsletter</h4>
                    <h6 class="text-white">Tips Budidaya Kentang</h6>
                    <p class="text-white">Dapatkan tips terbaru budidaya kentang dan info promo bibit langsung ke email Anda</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-white p-3" placeholder="Email Anda">
                            <button class="btn btn-success">Berlangganan</button>
                        </div>
                    </form>
                    <div class="mt-3">
                        <small class="text-white">Bergabung dengan 500+ petani lainnya</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; <a class="text-warning fw-bold" href="/">FredianFarm</a>. All Rights Reserved. 
        <br>Spesialis Bibit Kentang Berkualitas - Garansi Bebas Virus</p>
        <br>
        <small class="text-muted">Melayani pengiriman bibit kentang ke seluruh Indonesia</small>
    </div>
</div>