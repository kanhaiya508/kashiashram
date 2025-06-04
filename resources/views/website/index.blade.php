@extends('website.layout')
@section('content')
    <!-- Banner Start -->
    <div class="sigma_banner banner-3">

        <div class="sigma_banner-slider">

            <!-- Banner Item Start -->
            <div class="light-bg sigma_banner-slider-inner bg-cover bg-center bg-norepeat"
                style="background-image: url('{{ asset('website/assets/img/banner/png/1.png') }}');">
                <div class="sigma_banner-text">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h1 class="title text-light">Some Important Life Lessons From Gita</h1>
                                <p class="blockquote mb-0 text-light  bg-transparent"> We are a Hindu that belives in Lord
                                    Rama and
                                    Vishnu Deva the
                                    followers and We are a Hindu that belives in Lord Rama and Vishnu Deva. This is where
                                    you should start
                                </p>
                                <div class="section-button d-flex align-items-center">
                                    <a href="{{ route('web.room-bookings') }}" class="sigma_btn-custom">Join Today <i
                                            class="far fa-arrow-right"></i> </a>
                                    <a href="{{ route('web.donation') }}" class="ms-3 sigma_btn-custom white">View Services
                                        <i class="far fa-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Item End -->

            <!-- Banner Item Start -->
            <div class="light-bg sigma_banner-slider-inner bg-cover bg-center bg-norepeat"
                style="background-image: url('{{ asset('website/assets/img/banner/png/2.png') }}');">
                <div class="sigma_banner-text">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h1 class="title">We are a Hindu that believe in Ram</h1>
                                <p class="blockquote mb-0 bg-transparent"> We are a Hindu that belives in Lord Rama and
                                    Vishnu Deva the
                                    followers and We are a Hindu that belives in Lord Rama and Vishnu Deva. This is where
                                    you should start
                                </p>
                                <div class="section-button d-flex align-items-center">
                                    <a href="{{ route('web.room-bookings') }}" class="sigma_btn-custom">Join Today <i
                                            class="far fa-arrow-right"></i> </a>
                                    <a href="{{ route('web.donation') }}" class="ms-3 sigma_btn-custom white">View Services
                                        <i class="far fa-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Item End -->

        </div>

    </div>
    <!-- Banner End -->

    <!-- About Start -->
    <section id="about" class="section">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-6 mb-lg-30">
                    <div class="img-group">
                        <div class="img-group-inner">
                            <img src="{{ asset('website/assets/img/about-group1/1.jpg') }}" alt="about">
                            <span></span>
                            <span></span>
                        </div>
                        <img src="{{ asset('website/assets/img/about-group1/2.jpg') }}" alt="about">
                        <img src="{{ asset('website/assets/img/about-group1/3.jpg') }}" alt="about">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="me-lg-30">
                        <div class="section-title mb-0 text-start">
                            <p class="subtitle">B7/131, Bagh Hada, Kedar Ghat - 221001</p>
                            <h4 class="title">Shree Gayatri Charitable Trust</h4>
                        </div>

                        <p class="blockquote bg-transparent"> The way you feel in the temple is a pattern for how you want
                            to feel in your life. let us be guided by divinity of lord kasiviswanath in kasi-mokshapuri.
                            sri kasi gayatri ashram established by sri abburu hari hara swamy ji of nellore, andhra pradesh
                            and in due course sri sri sri mahadevi mathaji sri datta peethadhi pathi associated with the
                            ashram and extending various services like narayana seva- nitya anna-danam to the visiting
                            pilgrims to kasi gayatri ashram and make arrangements for performing abhishekam to lord kasi
                            viswanath, kumkuma archana to kasi annapoorna devi besides other temples.
                            sri kasi gayatri ashram is a known place for pilgrims visiting kasi, prayaga, gaya etc </p>
                        <a href="about-us.html" class="sigma_btn-custom light">Learn More <i class="far fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- About End -->


    <div id="service" class="section section-padding pattern-squares dark-bg-2">
        <div class="container">

            <div class="section-title text-start">
                <p class="subtitle">Service</p>
                <h4 class="title text-white">How We Can Help</h4>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <a href="shraddha-karma.php" class="sigma_service style-1 primary-bg">
                        <div class="sigma_service-thumb">
                            <i class="text-white flaticon-temple"></i>
                        </div>
                        <div class="sigma_service-body">
                            <h5 class="text-white">Shraddha Karma</h5>
                            <p class="text-white">Perform last rites and rituals with full devotion and tradition.</p>
                        </div>
                        <span class="btn-link text-white">Learn More <i class="text-white far fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mt-negative-sm">
                    <a href="travel.php" class="sigma_service style-1 secondary-bg">
                        <div class="sigma_service-thumb">
                            <i class="text-white flaticon-hindu-1"></i>
                        </div>
                        <div class="sigma_service-body">
                            <h5 class="text-white">Travels</h5>
                            <p class="text-white">Plan sacred journeys and temple visits with ease.</p>
                        </div>
                        <span class="text-white btn-link">Learn More <i class="text-white far fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mt-negative-sm">
                    <a href="accomodation.php" class="sigma_service style-1 bg-white">
                        <div class="sigma_service-thumb">
                            <i class=" flaticon-pooja"></i>
                        </div>
                        <div class="sigma_service-body">
                            <h5>Accommodation</h5>
                            <p>Comfortable and spiritual stay near temples and sacred places.</p>
                        </div>
                        <span class="btn-link">Learn More <i class="far fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6">
                    <a href="pooja.php" class="sigma_service style-1 primary-bg">
                        <div class="sigma_service-thumb">
                            <i class="text-white flaticon-temple"></i>
                        </div>
                        <div class="sigma_service-body">
                            <h5 class="text-white">Pooja</h5>
                            <p class="text-white">Book pooja services for all occasions and religious needs.</p>
                        </div>
                        <span class="btn-link text-white">Learn More <i class="text-white far fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mt-negative-sm">
                    <a href="education.php" class="sigma_service style-1 secondary-bg">
                        <div class="sigma_service-thumb">
                            <i class="text-white flaticon-hindu-1"></i>
                        </div>
                        <div class="sigma_service-body">
                            <h5 class="text-white">Educational</h5>
                            <p class="text-white">Spiritual and cultural learning programs for all age groups.</p>
                        </div>
                        <span class="text-white btn-link">Learn More <i class="text-white far fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mt-negative-sm">
                    <a href="kasi-grabhavasam.php" class="sigma_service style-1 bg-white">
                        <div class="sigma_service-thumb">
                            <i class="flaticon-pooja"></i>
                        </div>
                        <div class="sigma_service-body">
                            <h5>Kasi Grabhavasam</h5>
                            <p>Experience divine living in the spiritual heart of Kashi.</p>
                        </div>
                        <span class="btn-link">Learn More <i class="far fa-arrow-right"></i></span>
                    </a>
                </div>

            </div>

            <div class="text-end mt-4">
                <a href="services.html" class="btn-link text-white">Get Started Now <i
                        class="custom-primary far fa-arrow-right"></i></a>
            </div>

        </div>
    </div>

    <!-- Puja Start -->
    <div id="destinations" class="section section-padding">
        <div class="container">

            <div class="section-title text-start">

                <h4 class="title">Top Destinations </h4>
                <p class="subtitle">Anything that brings people together to celebrate the glory of Goddess, we create truly
                    memorable experiences that you will cherish forever.
                </p>
            </div>

            <div class="row">
                <!-- Varanasi -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/varanasi-2.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Varanasi</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Prayagraj (Allahabad) -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/prayagraj-1.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Prayagraj (Allahabad)</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Ujjain -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/Ujjain-2.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Ujjain</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Gaya -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/gaya-5.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Gaya</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Sitamarhi -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/sitamarhi-2.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Sitamarhi</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Vindhyachal -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/Vindhyachal-1.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Vindhyachal</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Naimisaranya -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/naimisharanya-4.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Naimisaranya</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Ayodhya -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/ayothi-first.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Ayodhya</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Vinayak In Kasi -->
                <div class="col-lg-4 coaching">
                    <div class="sigma_portfolio-item style-2">
                        <img src="{{ asset('website/assets/img/destinations/vinay-k-3.jpg') }}" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5><a href="puja-details.html">Vinayak In Kasi</a></h5>
                            </div>
                            <a href="puja-details.html"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Puja End -->

    <!-- Testimonials Start -->
    <section id="testimonials" class="section pt-0">

        <div class="container testimonial-section bg-contain bg-norepeat bg-center"
            style="background-image: url({{ asset('website/assets/img/textures/map-2.png') }})">

            <div class="section-title text-center">
                <p class="subtitle">Testimonials</p>
                <h4 class="title">What Our Congregation Say</h4>
            </div>

            <div class="sigma_testimonial style-2">
                <div class="sigma_testimonial-slider">

                    <div class="sigma_testimonial-inner">
                        <div class="sigma_testimonial-thumb">
                            <img src="{{ asset('website/assets/img/testimonials/1.jpg') }}" alt="testimonial">
                        </div>
                        <div>
                            <div class="sigma_testimonial-body">
                                <div class="sigma_rating-wrapper">
                                    <div class="sigma_rating">
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <p>I'm very happy to stay in Gayathri Ashramam. The food is awesome. Thank you for providing
                                    good food free of cost. Great experience — thank you guys!</p>
                            </div>
                            <div class="sigma_testimonial-footer">
                                <div class="sigma_testimonial-author">
                                    <cite>Janardhan KVN
                                    </cite>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sigma_testimonial-inner">
                        <div class="sigma_testimonial-thumb">
                            <img src="{{ asset('website/assets/img/testimonials/2.jpg') }}" alt="testimonial">
                        </div>
                        <div>
                            <div class="sigma_testimonial-body">
                                <div class="sigma_rating-wrapper">
                                    <div class="sigma_rating">
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <p>We have been to this place just this week. They made our experience really memorable.
                                    They took great care of our grandparents. The food feels just like home.</p>
                            </div>
                            <div class="sigma_testimonial-footer">
                                <div class="sigma_testimonial-author">
                                    <cite>Swetha Bandapalli

                                    </cite>
                                    {{-- <span>Executive</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sigma_testimonial-inner">
                        <div class="sigma_testimonial-thumb">
                            <img src="{{ asset('website/assets/img/testimonials/3.jpg') }}" alt="testimonial">
                        </div>
                        <div>
                            <div class="sigma_testimonial-body">
                                <div class="sigma_rating-wrapper">
                                    <div class="sigma_rating">
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <p>I'm very happy to stay in Gayathri Ashramam. The food is awesome. Thank you for providing
                                    good food free of cost. Great experience — thank you guys!</p>
                            </div>
                            <div class="sigma_testimonial-footer">
                                <div class="sigma_testimonial-author">
                                    <cite>Shiva Bavagari</cite>
                                    {{-- <span>Pandit</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-center mt-4">
                <div class="sigma_arrows style-2">
                    <i class="far fa-chevron-left slick-arrow slider-prev"></i>
                    <i class="far fa-chevron-right slick-arrow slider-next"></i>
                </div>
            </div>

        </div>
    </section>
    <!-- Testimonials End -->
@endsection
