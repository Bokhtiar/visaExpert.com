<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.backend.partials.includes.metas')
    <title>@yield('title') | {{ config('app.name') }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="{{ asset('frontend/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body>
<div class="pt-5">
    @include('layouts.alert')
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg-custom" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>
    <div class="auth-page-content">
        <div class="container">
            @yield('guest-content')
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">
                            &copy; {{ date('Y') }} Crafted with <i class="mdi mdi-heart text-danger"></i> by
                            <a
                                href="https://pencilds.com/" target="_blank">
                                Pencil Design Studio
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- JAVASCRIPT -->
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/pages/password-addon.init.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins.js') }}"></script>
</body>
</html>
