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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


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
        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('main_assets/img/logo.png') }}" alt="">
            <h1 class="sitename">SIPENA</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
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
{{--    @section('content')--}}
        <section id="hero" class="hero section" style="display: flex; align-items: center; justify-content: center;">
            <div class="hero-bg">
                <img src="{{ asset('main_assets/img/hero-bg-light.webp') }}" alt="">
            </div>
            <section id="contact" class="contact section" style="padding: 0 0 40px 0;">
                <div class="container section-title" data-aos="fade-up">
                    <h2>LOGIN</h2>
                    <p>Silakan Login Disini</p>
                </div>
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="form-container row g-2">
                        <div class="col-lg-12 equal-height" style="width: 500px;">
                            <div class="info-item d-flex flex-column justify-content-center aos-init aos-animate equal-height" data-aos="fade-up" data-aos-delay="200">
                                <h3>Sistem Informasi Pengelolaan Administrasi</h3>
                            </div>
                        </div>
                        <div class="login col-lg-12 equal-height" style="width: 500px;">
                            <div class="info-item d-flex flex-column justify-content-center equal-height">
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        <b>Waduh!</b> {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{ route('actionLogin') }}" method="post" style="display: flex; flex-direction: column; align-items: center;">
                                    @csrf
{{--                                    <input type="hidden" name="_token" value="P4rsXRGc3jzsPv9Sk7FgkrkOvonDDvFEdx9JesfD" autocomplete="off">--}}
                                    <div class="form-group" style="width: 100%;">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="nip_nik" placeholder="Enter Username">
                                    </div>
                                    <div class="form-group" style="width: 100%; position: relative;">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" style="padding-right: 40px; height: 50px;">
                                        <button class="btn" type="button" id="togglePassword" style="position: absolute; right: 10px; top: 74%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                                            <i class="fa fa-eye-slash" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    <div class="checkbox" style="width: 100%; display: flex; align-items: center;">
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember" style="margin-left: 5px;">Remember Me</label>
                                    </div>
                                    <button type="submit" class="button col-2" style="margin-top: 15px;">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
{{--    @endsection--}}
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
<script>
    window.onload = function () {
        const items = document.querySelectorAll('.equal-height');
        let maxHeight = 0;

        items.forEach(item => {
            const height = item.offsetHeight;
            if (height > maxHeight) {
                maxHeight = height;
            }
        });

        items.forEach(item => {
            item.style.height = maxHeight + 'px';
        });
    };

    document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const toggleIcon = this.querySelector('i');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
});


</script>

</body>

</html>