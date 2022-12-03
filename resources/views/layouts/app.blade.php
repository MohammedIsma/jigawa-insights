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
    <link rel="icon" type="image/png" href="/assets/images/favicon.svg">
    <title>Jigawa Insights</title>
</head>
<body>
    <div class="preloader">
        <img src="/image/Ataru.jpg" alt="main-logo">
    </div>
    <div class="all-section-area">
        <div class="header-area">
            <div class="container-fluid">
                <div class="header-content-wrapper">
                    <div class="header-content d-flex justify-content-between align-items-center">
                        <div class="header-left-content d-flex">
                            <div class="responsive-burger-menu d-block d-lg-none">
                                <span class="top-bar"></span>
                                <span class="middle-bar"></span>
                                <span class="bottom-bar"></span>
                            </div>

                            <div class="main-logo">
                                <a href="/">
                                    <img src="/image/Ataru.jpg" alt="main-logo" width="50">
                                </a>
                            </div>

                            <form class="search-bar d-flex">
                                <img src="assets/images/icon/search-normal.svg" alt="search-normal">

                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            </form>

                            <div class="option-item for-mobile-devices d-block d-lg-none">
                                <i class="search-btn ri-search-line"></i>
                                <i class="close-btn ri-close-line"></i>

                                <div class="search-overlay search-popup">
                                    <div class='search-box'>
                                        <form class="search-form">
                                            <input class="search-input" name="search" placeholder="Search" type="text">

                                            <button class="search-button" type="submit">
                                                <i class="ri-search-line"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="header-right-content d-flex align-items-center">

                            <div class="header-right-option dropdown profile-nav-item pt-0 pb-0">
                                <a class="dropdown-item dropdown-toggle avatar d-flex align-items-center" href="#" id="navbarDropdown-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="assets/images/avatar.png" alt="avatar">
                                    <div class="d-none d-lg-block d-md-block">
                                        <h3>{{ auth()->user()->name }}</h3>
                                        <span>Admin</span>
                                    </div>
                                </a>

                                <div class="dropdown-menu">
                                    <div class="dropdown-header d-flex flex-column align-items-center">
                                        <div class="figure mb-3">
                                            <img src="assets/images/avatar.png" class="rounded-circle" alt="avatar">
                                        </div>

                                        <div class="info text-center">
                                            <span class="name">John Smilga</span>
                                            <p class="mb-3 email">
                                                <a href="mailto:johnsmilga@hello.com">johnsmilga@hello.com</a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="dropdown-wrap">
                                        <ul class="profile-nav p-0 pt-3">
                                            <li class="nav-item">
                                                <a href="profile.html" class="nav-link">
                                                    <i class="ri-user-line"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="inbox.html" class="nav-link">
                                                    <i class="ri-mail-send-line"></i>
                                                    <span>My Inbox</span>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="edit-profile.html" class="nav-link">
                                                    <i class="ri-edit-box-line"></i>
                                                    <span>Edit Profile</span>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="edit-profile.html" class="nav-link">
                                                    <i class="ri-settings-5-line"></i>
                                                    <span>Settings</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="dropdown-footer">
                                        <ul class="profile-nav">
                                            <li class="nav-item">
                                                <a href="login.html" class="nav-link">
                                                    <i class="ri-login-circle-line"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="sidebar-menu">
            @include("menus.default")
        </nav>
        <main class="main-content-wrap style-two">
            @yield("content")
        </main>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/simplebar.min.js"></script>
    <script src="assets/js/geticons.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script src="assets/js/jbox.all.min.js"></script>
    <script src="assets/js/editor.js"></script>
    <script src="assets/js/form-validator.min.js"></script>
    <script src="assets/js/contact-form-script.js"></script>
    <script src="assets/js/ajaxchimp.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
