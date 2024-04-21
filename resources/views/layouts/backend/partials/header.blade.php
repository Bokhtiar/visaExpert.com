<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex align-items-center">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">

                        <h3>{{ config('app.name') }}</h3>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                        <h3>{{ config('app.name') }}</h3>
                    </a>
                </div>
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                        id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                      <span></span>
                      <span></span>
                      <span></span>
                    </span>
                </button>
                <div>
                    <a href="{{ route('home') }}">
                        <span class="btn btn-clr-red">
                            <i class="mdi mdi-earth"></i> Visit Site
                        </span>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <!-- Full Screen mode -->
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            data-toggle="fullscreen">
                        <i class="bx bx-fullscreen fs-22"></i>
                    </button>
                </div>

                @can(\App\Permissions::ACCESS_ACTIVITY_LOGS)
                    <!-- Notifications -->
                    <div class="dropdown topbar-head-dropdown ms-1 header-item"
                         id="notificationDropdown">
                        <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown"
                                data-bs-auto-close="outside"
                                aria-haspopup="true"
                                aria-expanded="false">
                            <i class="bx bx-bell fs-22"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-notifications-dropdown">
                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white">
                                                Notifications
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom"
                                        data-dropdown-tabs="true"
                                        id="notificationItemsTab"
                                        role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active"
                                               data-bs-toggle="tab"
                                               href="#all-noti-tab"
                                               role="tab"
                                               aria-selected="true">
                                                All
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content position-relative"
                                 id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2"
                                     id="all-noti-tab"
                                     role="tabpanel">
                                    <div data-simplebar
                                         style="max-height: 300px"
                                         class="pe-2">
                                        @foreach($notifications as $notification)
                                            <div
                                                class="text-reset notification-item d-block dropdown-item position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar-xs me-3 flex-shrink-0">
                                                                  <span
                                                                      class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                                                    <i class="bx bx-badge-check"></i>
                                                                  </span>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-2 lh-base">
                                                                {{ $notification->content }}
                                                            </h6>
                                                        </a>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                                        <span>
                                                                            <i class="mdi mdi-clock-outline"></i>
                                                                            {{ $notification->created_at_for_humans }}
                                                                        </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

                <!-- User account -->
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button"
                            class="btn"
                            id="page-header-user-dropdown"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                          <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user"
                                     src="{{ asset('backend/assets/images/users/user.svg')}}"
                                     alt="Header Avatar"/>
                                <span class="text-start ms-xl-2">
                                  <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                      {{ Auth::user()->name }}
                                  </span>
                                  <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">
                                      {{ Str::ucFirst(Auth::user()->user_type) }}
                                  </span>
                                </span>
                          </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}</h6>
                        @can(\App\Permissions::UPDATE_PROFILE)
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Profile</span>
                            </a>
                        @endcan
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">
                                Logout
                            </span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
