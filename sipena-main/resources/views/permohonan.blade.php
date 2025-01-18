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
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="#" class="active">Permohonan</a></li>
                <li><a href="{{ url('/tracking') }}">Tracking</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ url('/login') }}">LOGIN</a>
    </div>
</header>
<main class="main">
    <section id="hero" class="hero section"
             style="display: flex; align-items: center; justify-content: center; max-height: fit-content; position: relative;">
        <div class="hero-bg">
            <img src="{{ asset('main_assets/img/hero-bg-light.webp') }}" alt="">
        </div>

        <section id="contact" class="contact section" style="padding: 0 0 40px 0; width: 1200px;">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Permohonan</h2>
                <p>Silakan isi permohonan pembuatan aplikasi di bawah ini</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-12">
                        <div class="info-item d-flex flex-column justify-content-center equal-height" data-aos="fade-up"
                             data-aos-delay="200">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('submitForm') }}" method="POST">
                                @csrf
                                {{--                            <form action="{{ route('permohonan.submit') }}" method="POST">--}}
                                {{--                                @csrf--}}
                                <div class="row gy-4">
                                    <div class="form-1 col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_pemohon">Nama Pemohon (PIC)</label><span> *</span>
                                            <input type="text" class="form-control" id="nama_pemohon"
                                                   name="nama_pemohon" placeholder="Masukkan Nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nip">NIP</label><span> *</span>
                                            <input type="text" class="form-control" id="nip" name="nip"
                                                   placeholder="Masukkan NIP" maxlength="18" required>
                                            <small id="nipError" class="text-danger" style="display: none;">NIP tidak boleh lebih dari 18 digit.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="nomor_telepon">Nomor Telepon</label><span> *</span>
                                            <input type="text" class="form-control" id="nomor_telepon"
                                                   name="nomor_telepon"
                                                   placeholder="Masukkan Nomor Telepon" required>
                                        </div>
                                    </div>
                                    <div class="form-2 col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_opd">Nama OPD</label><span> *</span>
                                            <input type="text" class="form-control" id="nama_opd" name="nama_opd"
                                                   placeholder="Masukkan Nama OPD" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_aplikasi">Nama Aplikasi</label><span> *</span>
                                            <input type="text" class="form-control" id="nama_aplikasi"
                                                   name="nama_aplikasi" placeholder="Masukkan Nama Aplikasi" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label><span> *</span>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   placeholder="Masukkan Email" required>
                                            <small id="emailHelp" class="form-text text-muted">gunakan email dengan
                                                format <b>example@riau.go.id</b></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="button col-2" >Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none !important;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dotlottie-player src="https://lottie.host/7114e6eb-e3f4-4758-9e0f-05abdf30c791/wE8NBA6MFa.lottie"
                                      background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                    <p>Permohonan Anda berhasil dikirim!</p>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const myModal = new bootstrap.Modal(document.getElementById('exampleModalCenter'));
                myModal.show();
            });
        </script>
    @endif
</main>
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
<script src="{{ url('https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('main_assets/js/main.js') }}"></script>
</body>

</html>
