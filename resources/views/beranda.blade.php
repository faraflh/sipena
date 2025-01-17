<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'QuickStart')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('main_assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('main_assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('main_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('main_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('main_assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('main_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('main_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('main_assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="@yield('body-class', 'index-page')">
<!-- Header -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="#" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('main_assets/img/logo.png') }}" alt="">
            <h1 class="sitename">SIPENA</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#" class="active">Beranda</a></li>
                <li><a href="{{ url('/permohonan') }}">Permohonan</a></li>
                <li><a href="{{ url('/tracking') }}">Tracking</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ url('/login') }}">LOGIN</a>
    </div>
</header>

<!-- Main Content -->
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="{{ asset('main_assets/img/hero-bg-light.webp') }}" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Selamat Datang di <span>SIPENA</span></h1>
                <p data-aos="fade-up" data-aos-delay="100">
                    Quickly start your project now and set the stage for success
                </p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-get-started">Logout</button>
                    </form>
{{--                    <a href="#about" class="btn-get-started">Get Started</a>--}}
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center">
                        <i class="bi bi-play-circle"></i><span>Watch Video</span>
                    </a>
                </div>
                <img src="{{ asset('main_assets/img/hero-services-img.webp') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>
    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section light-background">
        <div class="container">
            <div class="row gy-4">
                @foreach ($services as $service)
                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi {{ $service['icon'] }}"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">{{ $service['title'] }}</a></h4>
                                <p class="description">{{ $service['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <p class="who-we-are">Who We Are</p>
                    <h3>{{ __('Unleashing Potential with Creative Strategy') }}</h3>
                    <p class="fst-italic">
                        {{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}
                    </p>
                    <ul>
                        @foreach ($aboutPoints as $point)
                            <li><i class="bi bi-check-circle"></i> <span>{{ $point }}</span></li>
                        @endforeach
                    </ul>
                    <a href="#" class="read-more"><span>{{ __('Read More') }}</span><i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <img src="{{ asset('main_assets/img/about-company-1.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="row gy-4">
                                <div class="col-lg-12">
                                    <img src="{{ asset('main_assets/img/about-company-2.jpg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-12">
                                    <img src="{{ asset('main_assets/img/about-company-3.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                @foreach ($clients as $client)
                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('main_assets/img/clients/' . $client['logo']) }}" class="img-fluid" alt="{{ $client['name'] }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- /Clients Section -->

    <!-- Additional Sections -->
    <!-- Repeat similar conversions for other sections -->

</main>
<!-- Footer -->
@include('partials.footer')

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('main_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('main_assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('main_assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('main_assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('main_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('main_assets/js/main.js') }}"></script>
</body>

</html>
