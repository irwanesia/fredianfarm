<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title><?= isset($pageTitle) ? $pageTitle : 'New Pages Title' ?></title>

    <!-- Site favicon -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="/backend/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/backend/vendors/images/favicon-32x32.png" /> -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/blog/<?= get_settings()->blog_favicon ?>" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/style.css" />
    <!-- Tambahkan ini dalam tag <head> untuk menyertakan CSS Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <?= $this->renderSection('stylesheets') ?>
</head>

<body>
    <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="/backend/vendors/images/deskapp-logo.svg" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> -->

    <?php include('include/header.php') ?>

    <?php include('include/right-sidebar.php') ?>

    <?php include('include/left-sidebar.php') ?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div>
                    <?= $this->renderSection('content') ?>
                </div>
            </div>

            <?php include('include/footer.php') ?>

        </div>
    </div>

    <!-- js -->
    <script src="/backend/vendors/scripts/core.js"></script>
    <script src="/backend/vendors/scripts/script.min.js"></script>
    <script src="/backend/vendors/scripts/process.js"></script>
    <script src="/backend/vendors/scripts/layout-settings.js"></script>
    <!-- Menautkan SweetAlert dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Tambahkan ini sebelum tag penutup </body> untuk menyertakan JavaScript Toastr -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>