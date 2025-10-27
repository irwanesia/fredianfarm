<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'New Page Title' ?></title>
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <?= $this->renderSection('page_meta') ?>
    <link rel="icon" href="/images/blog/<?= get_settings()->blog_favicon ?>" type="image/x-icon">

    <!-- Favicon -->
    <link href="/frontend/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="/frontend/css/style.css">
    <?= $this->renderSection('stylesheets') ?>
</head>

<body>
    <!-- Topbar Start -->
    <?php include("inc/topbar.php") ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php include("inc/navbar.php") ?>
    <!-- Navbar End -->

    <!-- main/content -->
    <?= $this->renderSection('content') ?>
    <!-- main/content end -->

    <!-- Footer Start -->
    <?php include("inc/footer.php") ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/frontend/lib/easing/easing.min.js"></script>
    <script src="/frontend/lib/waypoints/waypoints.min.js"></script>
    <script src="/frontend/lib/counterup/counterup.min.js"></script>
    <script src="/frontend/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/frontend/js/main.js"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>