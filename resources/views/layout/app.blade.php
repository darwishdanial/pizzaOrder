<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pizza Haven</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Best pizza in town.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- All CSS is here
	============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/proximanova.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/proximanova.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/line-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slinky.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/easyzoom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

</head>

<body>
    <div class="main-wrapper wrapper-2">
        <header class="header-area section-padding-lr-1 transparent-bar header-padding-tb sticky-bar sticky-white-bg">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="language-wrap">
                            <ul>
                                <!-- <li><a>Welcome</a></li> -->
                                <li><a>Welcome {{Auth::user()->name ?? 'guest'}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="logo text-center">
                            <!-- <a href="#"><img src="assets/images/logo/logo.png" alt="logo"></a> -->
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="header-action-wrap">
                            <div class="header-action-cart">
                                <!-- <a class="cart-active" href="{{ route('cart', ['user' => Auth::user()->id ?? 'guest']) }}">
                                    <img class="injectable" src="{{ asset('assets/images/icon-img/bag.svg') }}" alt="">

                                    <span class="product-count">01</span>
                                </a> -->
                            </div>
                            <div class="header-action-menu">
                                <a class="menu-active-button" href="#">
                                    <span class="info-width-1"></span>
                                    <span class="info-width-2"></span>
                                    <span class="info-width-3"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Menu start / tepi cart icon -->
        <div class="off-canvas-active">
            <a class="off-canvas-close"><i class="las la-times"></i></a>
            <div class="off-canvas-wrap">
                <div class="menu-wrap">
                    <div id="menu" class="slinky-mobile-menu text-left">
                        <ul>
                            <li>
                                <a href="#">PAGES</a>
                                <ul>
                                    <li><a href="{{ route('firstPage') }}">Home Page</a></li>
                                    <li><a href="{{ route('order') }}">Order Page</a></li>
                                    <li><a href="{{ route('cart', ['user' => Auth::user()->id ?? 'guest']) }}">Cart Page</a></li>
                                    <li><a href="{{  route('checkout', ['user' => Auth::user()->id ?? 'guest']) }}">Checkout Page</a></li>
                                    <li><a href="{{  route('deliveryStatus') }}">Delivery Page</a></li>
                                    <li><a href="{{ route('viewBillHistory') }}">Bill History Page</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('reg.log') }}">LOG IN / REGISTER</a>
                            </li>
                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    LOG OUT
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- page content -->
        @yield('content')
        <!-- page content -->

        <footer class="footer-area section-padding-lr-2 bg-gray">
            <div class="container-fluid">
                <div class="footer-top section-padding-9">
                    <div class="row mb-n6">
                        <div class="col-34 mb-6">
                            <div class="footer-widget footer-logo">
                                <!-- <a href="#"><img src="assets/images/logo/logo-2.png" alt=""></a> -->
                            </div>
                        </div>
                        <div class="col-22-5 mb-6">
                            <div class="footer-widget footer-list">
                                <ul>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Term & Conditions</a></li>
                                    <li><a href="#">About Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-24 mb-6">
                            <div class="footer-widget footer-list">
                                <ul>
                                    <li><a href="#">Shipping Info</a></li>
                                    <li><a href="#">Returns/Excahnges</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-19-5 mb-6">
                            <div class="footer-widget footer-list">
                                <ul>
                                    <li><a href="#">love@pizzahaven.com</a></li>
                                    <li><a href="#">(+60)19-3492720</a></li>
                                </ul>
                                <div class="social-icon">
                                    <a href="#"><img class="injectable" src="{{ asset('assets/images/icon-img/facebook.svg') }}" alt=""></a>
                                    <a href="#"><img class="injectable" src="{{ asset('assets/images/icon-img/twitter.svg') }}" alt=""></a>
                                    <a href="#"><img class="injectable" src="{{ asset('assets/images/icon-img/instagram.svg') }}" alt=""></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom copyright border-top-1 text-center">
                    <p>Copyright ©2024 All rights reserved | Pizza Haven </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- Global Vendor, plugins JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/svg-inject.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slinky.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui-touch-punch.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/easyzoom.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/aos.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.nice-select.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>