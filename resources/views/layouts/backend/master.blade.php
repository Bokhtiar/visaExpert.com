<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-layout="vertical"
    data-topbar="light"
    data-sidebar="light"
    data-sidebar-size="lg"
    data-sidebar-image="none"
    data-preloader="enable">
<head>
    @yield('css')
    @include('layouts.backend.partials.includes.metas')
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    @include('layouts.backend.partials.includes.styles')
</head>

<body>
@include('layouts.backend.partials.preloader')
@include('layouts.alert')
<div id="layout-wrapper">
    @include('layouts.backend.partials.header')

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        id="NotificationModalbtn-close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/gsqxdxog.json"
                            trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548"
                            style="width: 100px; height: 100px"
                        ></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">
                                Are you sure you want to remove this Notification ?
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button
                            type="button"
                            class="btn w-sm btn-light"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn w-sm btn-danger"
                            id="delete-notification"
                        >
                            Yes, Delete It!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.backend.partials.leftSidebar')

    <div class="vertical-overlay"></div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('layouts.backend.partials.footer')
    </div>
</div>

@include('layouts.backend.partials.includes.scripts')
@yield('js')
</body>
</html>
