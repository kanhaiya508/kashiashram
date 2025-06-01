<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maharatri - Temple HTML Template</title>

    <!-- Favicon -->
    <link rel="icon" type="{{ asset('website/image/png') }}" sizes="32x32" href="favicon.ico">

    <!-- partial:partial/__stylesheets.html -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/ion.rangeSlider.min.css') }}">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('website/assets/fonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/font-awesome.min.css') }}">
    <!-- Template Style sheet -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/responsive.css') }}">
    <!-- partial -->

</head>

<body>

    <!-- Preloader Start -->
    <div class="sigma_preloader">
        <img src="{{ asset('website/assets/img/om.svg') }}" alt="preloader">
    </div>
    <!-- Preloader End -->

    <!-- Search Start -->
    <div class="sigma_search-form-wrapper">
        <div class="sigma_search-trigger close-btn">
            <span></span>
            <span></span>
        </div>
        <form class="sigma_search-form" method="post">
            <input type="text" placeholder="Search..." value="">
            <button type="submit" class="sigma_search-btn">
                <i class="fal fa-search"></i>
            </button>
        </form>
    </div>
    <!-- Search End -->



    <!-- partial:partia/__sidenav.html -->
    <aside class="sigma_aside sigma_aside-right sigma_aside-right-panel sigma_aside-bg">
        <div class="sidebar">

            <div class="sidebar-widget widget-logo">
                <img src="{{ asset('website/assets/img/logo_big.png') }}" class="mb-30" alt="img">
                <p>The way you feel in the temple is a pattern for how you want to feel in your life. let us be guided
                    by divinity of lord kasiviswanath in kasi-mokshapuri. sri kasi gayatri ashram established by sri
                    abburu hari hara swamy ji of nellore,</p>
            </div>

            <!-- Instagram Start -->
            <div class="sidebar-widget widget-ig">
                <h5 class="widget-title">Instagram</h5>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <a href="#" class="sigma_ig-item">
                            <img src="{{ asset('website/assets/img/ig/1.jpg') }}" alt="ig">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <a href="#" class="sigma_ig-item">
                            <img src="{{ asset('website/assets/img/ig/2.jpg') }}" alt="ig">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <a href="#" class="sigma_ig-item">
                            <img src="{{ asset('website/assets/img/ig/3.jpg') }}" alt="ig">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <a href="#" class="sigma_ig-item">
                            <img src="{{ asset('website/assets/img/ig/4.jpg') }}" alt="ig">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <a href="#" class="sigma_ig-item">
                            <img src="{{ asset('website/assets/img/ig/5.jpg') }}" alt="ig">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <a href="#" class="sigma_ig-item">
                            <img src="{{ asset('website/assets/img/ig/6.jpg') }}" alt="ig">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Instagram End -->

            <!-- Social Media Start -->
            <div class="sidebar-widget">
                <h5 class="widget-title">Follow Us</h5>
                <div class="sigma_post-share">
                    <ul class="sigma_sm square light">
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Social Media End -->

        </div>
    </aside>
    <div class="sigma_aside-overlay aside-trigger-right"></div>
    <!-- partial -->

    <!-- partial:partia/__mobile-nav.html -->
    <aside class="sigma_aside sigma_aside-left">

        <a class="navbar-brand" href="{{route('index')}}"> <img src="{{ asset('website/assets/img/logo_big.png') }}"
                alt="logo"> </a>

        <!-- Menu -->
        <ul>
            <li class="menu-item">
                <a href="{{route('index')}}#">Home</a>

            </li>
            <li class="menu-item ">
                <a href="{{route('index')}}#about">About Us</a>
            </li>
            <li class="menu-item ">
                <a href="{{route('index')}}#service">Service</a>
            </li>


            <li class="menu-item ">
                <a href="{{route('index')}}#destinations">Destinations</a>
            </li>

            <li class="menu-item ">
                <a href="{{route('index')}}#testimonials">Testimonials</a>
            </li>

            <li class="menu-item ">
                <a href="{{route('web.donation')}}"> Donation </a>
            </li>

            <li class="menu-item ">
                <a href="{{route('web.room-bookings')}}"> Book Room </a>
            </li>

        </ul>

    </aside>
    <div class="sigma_aside-overlay aside-trigger-left"></div>
    <!-- partial -->

    <!-- partial:partia/__header.html -->
    <header class="sigma_header header-2 can-sticky">

        <!-- Middle Header Start -->
        <div class="sigma_header-middle">
            <nav class="navbar">

                <!-- Controls -->
                <div class="sigma_header-controls style-2">

                    <ul class="sigma_header-controls-inner">
                        <!-- Desktop Toggler -->
                        <li class="aside-toggler style-2 aside-trigger-right desktop-toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </li>

                        <!-- Mobile Toggler -->
                        <li class="aside-toggler style-2 aside-trigger-left">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </li>
                    </ul>

                </div>

                <!-- Menu -->
                <ul class="navbar-nav">
                    <li class="menu-item">
                        <a href="{{route('index')}}#">Home</a>

                    </li>
                    <li class="menu-item ">
                        <a href="{{route('index')}}#about">About Us</a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{route('index')}}#service">Service</a>
                    </li>


                    <li class="menu-item ">
                        <a href="{{route('index')}}#destinations">Destinations</a>
                    </li>

                    <li class="menu-item ">
                        <a href="{{route('index')}}#testimonials">Testimonials</a>
                    </li>


                    <li class="menu-item ">
                        <a href="{{route('web.donation')}}">Donation</a>
                    </li>


                </ul>

                <!-- Logo Start -->
                <div class="sigma_logo-wrapper">
                    <a class="navbar-brand" href="index.html">
                        <img src="{{ asset('website/assets/img/logo_big.png') }}" alt="logo">
                    </a>
                </div>
                <!-- Logo End -->

                <!-- Button & Phone -->
                <div class="sigma_header-controls sigma_header-button">
                    <a href="tel:+123456789" class="sigma_header-contact">
                        <i class="fal fa-phone"></i>
                        <div class="sigma_header-contact-inner">
                            <span>Get Support</span>
                            <h6>+91 99187 74933</h6>
                        </div>
                    </a>
                    <a class="sigma_btn-custom" href="{{route('web.room-bookings')}}"> BOOK ROOM
                    </a>
                </div>



            </nav>
        </div>
        <!-- Middle Header End -->

    </header>
    <!-- partial -->



    <!-- Content -->
    @yield('content')


    <!-- Back To Top Start -->
    <div class="sigma_top style-5">
        <i class="far fa-angle-double-up"></i>
    </div>
    <!-- Back To Top End -->

    <!-- Audio Box Start -->

    <!-- <div class="sigma_audio-box">
    <div id="audio-btn">
      <i class="fa fa-play"> </i>
      <i class="fa fa-music"></i>
    </div>
  </div> -->

    <!-- Audio Box End -->

    <!-- partial:partia/__footer.html -->
    <footer class="sigma_footer footer-2">

        <!-- Middle Footer -->
        <div class="sigma_footer-middle">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 footer-widget">
                        <h5 class="widget-title">About Us</h5>
                        <p class="mb-4">Shree Gayatri charitable Trust , founded by Sri Abburu Hari Hara Swamy Ji in
                            Nellore, Andhra Pradesh, is a spiritual hub for pilgrims. Supported by it offers Narayana
                            Seva, Nitya Annadanam, </p>
                        <div class="d-flex align-items-center justify-content-md-start justify-content-center">
                            <i class="far fa-phone custom-primary me-3"></i>
                            <span>+91 99187 74933</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-md-start justify-content-center mt-2">
                            <i class="far fa-envelope custom-primary me-3"></i>
                            <span>sethu2kasi@gmail.com</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-md-start justify-content-center mt-2">
                            <i class="far fa-map-marker custom-primary me-3"></i>
                            <span> Shree Gayatri charitable Trust .
                                No.D47/118-157 Ramapura Luxa Road</span>
                        </div>
                    </div>


                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 footer-widget">
                        <h5 class="widget-title">Information</h5>
                        <ul>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="our-story.html">Our Story</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="temple-images.html">Temple Images</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="donation.html">Donation</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="anathanam.html">Anathanam</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="our-ads.html">Our Ads</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="contact.html">Contact Us</a>
                            </li>
                        </ul>
                    </div>




                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 footer-widget">
                        <h5 class="widget-title">Services</h5>
                        <ul>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="shraddha-karma.php">Shraddha Karma</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="accomodation.php">Accommodation</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="pooja.php">Pooja</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="education.php">Educational</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="kasi-grabhavasam.php">Kasi Grabhavasam</a>
                            </li>
                        </ul>
                    </div>





                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 footer-widget">
                        <h5 class="widget-title">Our Temple Cities</h5>
                        <ul>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="varanasi.html">Varanasi</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="prayagraj.html">Prayagraj</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="ujjain.html">Ujjain</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="gaya.html">Gaya</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="sitamarhi.html">Sitamarhi</a>
                            </li>
                            <li>
                                <i class="fas fa-om"></i>
                                <a href="vindhyachal.html">Vindhyachal</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="sigma_footer-bottom">
            <div class="container-fluid">
                <div class="sigma_footer-copyright">
                    <span class="copyright-text">
                        Designed and Developed by
                        <a href="https://webdeveloperkashi.com/" target="_blank">Web Developer Kashi</a>.
                        All rights reserved.
                    </span>

                </div>

                <ul class="sigma_sm square">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </footer>
    <!-- partial -->

    <!-- partial:partia/__scripts.html -->
    <script src="{{ asset('website/assets/js/plugins/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/jquery.event.move.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins/ion.rangeSlider.min.js') }}"></script>

    <script src="{{ asset('website/assets/js/main.js') }}"></script>
    <!-- partial -->

</body>

</html>
