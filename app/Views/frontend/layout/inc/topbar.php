<div class="container-fluid px-5 d-none d-lg-block">
    <div class="row gx-5 py-3 align-items-center">
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-start">
                <!-- <i class="bi bi-phone-vibrate fs-1 text-primary me-2"></i> -->
                <i class="bi bi-whatsapp fs-2 text-success me-2"></i>
                <a href="https://wa.me/628563333235?text=Halo%20Fredian%20Farm,%20saya%20ingin%20bertanya%20tentang%20produk%20anda" 
                class="text-decoration-none"
                title="Chat via WhatsApp"
                data-bs-toggle="tooltip"
                data-bs-placement="bottom">
                    <h4 class="mb-0 text-dark">+62 856 3333 235</h4>
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="d-flex align-items-center justify-content-center">
                <a href="/" class="navbar-brand ms-lg-5">
                    <img src="/frontend/images/fredian_farm_logo.png" 
                         width="200" 
                         height="60" 
                         alt="Fredian Farm Logo"
                         loading="lazy">
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-end">
                <?php 
                    $social_media = get_social_media();
                ?>
                <a class="btn btn-primary btn-square rounded-circle me-2" target="_blank" href="<?= ($social_media->github_url) ?>"><i class="fab fa-tiktok"></i></a>
                <a class="btn btn-primary btn-square rounded-circle me-2" target="_blank" href="<?= ($social_media->instagram_url) ?>"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-primary btn-square rounded-circle me-2" target="_blank" href="<?= ($social_media->facebook_url) ?>"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-primary btn-square rounded-circle me-2" target="_blank" href="<?= ($social_media->youtube_url) ?>"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>