<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-dark text-dark fw-bolder fs-5">
            <span class="logo-sm"><strong><?php echo e(config('app.name')); ?></strong></span>
            <span class="logo-lg"><?php echo e(config('app.name')); ?></span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item my-2">
                    <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.dashboard')); ?>">
                        <i data-feather="home" class="icon-dual"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Customer List')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_CUSTOMER)): ?>
                        <li class="nav-item my-1">
                            <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.customers.*') ? 'active' : ''); ?>"
                                href="#sidebarCustomers" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarCustomers">
                                <i data-feather="file" class="icon-dual"></i>
                                <span data-key="t-customers">Customers</span>
                            </a>

                            <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Customer List')): ?>
                            <div class="collapse menu-dropdown <?php echo e(request()->routeIs('admin.customers.*') ? 'show' : ''); ?>"
                                id="sidebarCustomers">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.customers.index')); ?>"
                                            class="nav-link <?php echo e(request()->routeIs('admin.customers.index') ? 'active' : ''); ?>"
                                            data-key="t-customer-list">
                                            Customer List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php endif; ?>   
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_VISA_TYPE)): ?>
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.visa-types.*') ? 'active' : ''); ?>"
                            href="#sidebarVisaTypes" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarVisaTypes">
                            <i data-feather="divide-circle" class="icon-dual"></i>
                            <span data-key="t-visa-types">Visa Types</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->routeIs('admin.visa-types.*') ? 'show' : ''); ?>"
                            id="sidebarVisaTypes">
                            <ul class="nav nav-sm flex-column">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_VISA_TYPE)): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.visa-types.create')); ?>"
                                            class="nav-link <?php echo e(request()->routeIs('admin.visa-types.create') ? 'active' : ''); ?>"
                                            data-key="t-add-visa-type">
                                            Add Visa Type
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.visa-types.index')); ?>"
                                        class="nav-link <?php echo e(request()->routeIs('admin.visa-types.index') ? 'active' : ''); ?>"
                                        data-key="t-visa-type-list">
                                        Visa Type List
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_ROAD)): ?>
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.road.*') ? 'active' : ''); ?>"
                            href="#sidebarRoad" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarRoad">
                            <i data-feather="divide-circle" class="icon-dual"></i>
                            <span data-key="t-visa-types">By Road</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->routeIs('admin.road.*') ? 'show' : ''); ?>"
                            id="sidebarRoad">
                            <ul class="nav nav-sm flex-column">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_ROAD)): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.road.create')); ?>"
                                            class="nav-link <?php echo e(request()->routeIs('admin.road.create') ? 'active' : ''); ?>"
                                            data-key="t-add-visa-type">
                                            Add Road
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_ROAD)): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.road.index')); ?>"
                                            class="nav-link <?php echo e(request()->routeIs('admin.road.index') ? 'active' : ''); ?>"
                                            data-key="t-visa-type-list">
                                            Road List
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_LINK)): ?>
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.link.*') ? 'active' : ''); ?>"
                            href="#sidebarLink" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarLink">
                            <i data-feather="divide-circle" class="icon-dual"></i>
                            <span data-key="t-visa-types">Website Link</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->routeIs('admin.link.*') ? 'show' : ''); ?>"
                            id="sidebarLink">
                            <ul class="nav nav-sm flex-column">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_LINK)): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.link.create')); ?>"
                                            class="nav-link <?php echo e(request()->routeIs('admin.link.create') ? 'active' : ''); ?>"
                                            data-key="t-add-visa-type">
                                            Add Website Link
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_LINK)): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.link.index')); ?>"
                                            class="nav-link <?php echo e(request()->routeIs('admin.link.index') ? 'active' : ''); ?>"
                                            data-key="t-visa-type-list">
                                            Website List
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_SERVICE, \App\Permissions::VIEW_TOUR_PACKAGE)): ?>
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.services.*', 'admin.tour-packages.*') ? 'active' : ''); ?>"
                            href="#sidebarConfiguration" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarConfiguration">
                            <i data-feather="tool" class="icon-dual"></i>
                            <span data-key="t-configuration">Billing</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->routeIs('admin.services.*', 'admin.tour-packages.*') ? 'show' : ''); ?>"
                            id="sidebarConfiguration">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.services.index')); ?>"
                                        class="nav-link <?php echo e(request()->routeIs('admin.services.index') ? 'active' : ''); ?>"
                                        data-key="t-service-charge">
                                        Service Charge
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.tour-packages.index')); ?>"
                                        class="nav-link <?php echo e(request()->routeIs('admin.tour-packages.index') ? 'active' : ''); ?>"
                                        data-key="t-tour-packages">
                                        Tour Packages
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_ROLE, \App\Permissions::VIEW_USER)): ?>
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.roles.*', 'admin.users.*') ? 'active' : ''); ?>"
                            href="#sidebarUserManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarUserManagement">
                            <i data-feather="users" class="icon-dual"></i>
                            <span data-key="t-user-management">User Management</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->routeIs('admin.roles.*', 'admin.users.*') ? 'show' : ''); ?>"
                            id="sidebarUserManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.roles.index')); ?>"
                                        class="nav-link <?php echo e(request()->routeIs('admin.roles.index') ? 'active' : ''); ?>"
                                        data-key="t-add-roles">
                                        Roles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.users.index')); ?>"
                                        class="nav-link <?php echo e(request()->routeIs('admin.users.index') ? 'active' : ''); ?>"
                                        data-key="t-users">
                                        Users
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_DAILY_OFFICE_EXPENSE)): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.daily-office-expenses.index')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('admin.daily-office-expenses.index') ? 'active' : ''); ?>"
                            data-key="t-daily-office-expense">
                            <i data-feather="paperclip" class="icon-dual"></i>
                            <span data-key="t-daily-office-spending">Daily Office Spending</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_STAFF_DUTY_SALARY)): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.staff-duty-salaries.index')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('admin.staff-duty-salaries.index') ? 'active' : ''); ?>">
                            <i data-feather="percent" class="icon-dual"></i>
                            <span data-key="t-staff-duty-salary">Staff Duty & Salary</span>
                        </a>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::ACCESS_ACTIVITY_LOGS)): ?>
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link <?php echo e(request()->routeIs('admin.activity-logs') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.activity-logs')); ?>">
                            <i data-feather="list" class="icon-dual-warning"></i>
                            <span data-key="t-activity-logs">Activity Logs</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<?php /**PATH C:\xampp\htdocs\visa\resources\views/layouts/backend/partials/leftSidebar.blade.php ENDPATH**/ ?>