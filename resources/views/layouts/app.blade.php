<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/remixicon.css">
    <link rel="stylesheet" href="/assets/css/boxicons.min.css">
    <link rel="stylesheet" href="/assets/css/iconsax.css">
    <link rel="stylesheet" href="/assets/css/metismenu.min.css">
    <link rel="stylesheet" href="/assets/css/simplebar.min.css">
    <link rel="stylesheet" href="/assets/css/calendar.css">
    <link rel="stylesheet" href="/assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/css/jbox.all.min.css">
    <link rel="stylesheet" href="/assets/css/editor.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/loaders.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link rel="stylesheet" href="/assets/css/ataru.css">
    <link rel="icon" type="image/png" href="/assets/images/favicon.svg">
    <title>Jigawa Insights</title>
</head>
<body style="background-color: #2C3E50">
    <div class="preloader">
        <img src="/image/Ataru.jpg" alt="main-logo">
    </div>
    <div class="all-section-area">
        <div class="header-area p-2" style="background-color: #fff;">
            <div class="row">
                <div class="col-12 col-md-4">
                    <p class="h4">JIGAWA INSIGHTS</p>
                </div>
                <div class="col-12 col-md-4">

                </div>
                <div class="col-12 col-md-4 text-right">
                    {{ auth()->user()->name }}
                </div>
            </div>
        </div>
        <main class="main-content-wrap" style="background-color:#2C3E50;color:#fff;padding:0;padding-top:20px;">
            @yield("content")
        </main>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>
    <script src="/assets/js/geticons.js"></script>
    <script src="/assets/js/sweetalert2.all.min.js"></script>
    <script src="/assets/js/jbox.all.min.js"></script>
    <script src="/assets/js/editor.js"></script>
    <script src="/assets/js/form-validator.min.js"></script>
    <script src="/assets/js/contact-form-script.js"></script>
    <script src="/assets/js/ajaxchimp.min.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>
</html>
