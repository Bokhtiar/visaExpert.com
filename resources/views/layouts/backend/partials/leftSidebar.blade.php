<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark text-dark fw-bolder fs-5">
            <span class="logo-sm"><strong>{{ config('app.name') }}</strong></span>
            <span class="logo-lg">{{ config('app.name') }}</span>
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
                    <a class="nav-link menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i data-feather="home" class="icon-dual"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>



                @hasPermission('Customer List')
                    @can(\App\Permissions::VIEW_CUSTOMER)
                        <li class="nav-item my-1">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"
                                href="#sidebarCustomers" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarCustomers">
                                <i data-feather="file" class="icon-dual"></i>
                                <span data-key="t-customers">Customers</span>
                            </a>


                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.customers.*') ? 'show' : '' }}"
                                id="sidebarCustomers">
                                <ul class="nav nav-sm flex-column">
                                    @hasPermission('Customer List')
                                        <li class="nav-item">
                                            <a href="{{ route('admin.customers.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}"
                                                data-key="t-customer-list">
                                                Customer List
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('admin.customers.all') }}"
                                                class="nav-link {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}"
                                                data-key="t-customer-list">
                                                All Customer List
                                            </a>
                                        </li>

                                         <li class="nav-item">
                                            <a href="{{ route('admin.customers.web-file') }}"
                                                class="nav-link {{ request()->routeIs('admin.customers.web-file') ? 'active' : '' }}"
                                                data-key="t-customer-list">
                                                Customer web file
                                            </a>
                                        </li>
                                    @endhasPermission
                                    @hasPermission('Customer invoice')
                                        <li class="nav-item">
                                            <a href="{{ route('admin.customers-invoices.list') }}"
                                                class="nav-link {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}"
                                                data-key="t-customer-list">
                                                Customer Invoice List
                                            </a>
                                        </li>
                                    @endhasPermission

                                   
                                </ul>
                            </div>

                        </li>
                    @endcan
                @endhasPermission

                {{-- notepad --}}
                @hasPermission('Notepad List')
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.notepad.*') ? 'active' : '' }}"
                            href="#sidebarNotepad" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarNotepad">
                            <i data-feather="file" class="icon-dual"></i>
                            <span data-key="t-customers">Notepad</span>
                        </a>


                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.notepad.*') ? 'show' : '' }}"
                            id="sidebarNotepad">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.notepad.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.notepad.index') ? 'active' : '' }}"
                                        data-key="t-customer-list">
                                        Notepad List
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endhasPermission


                @hasPermission('Visa Type List')
                    @can(\App\Permissions::VIEW_VISA_TYPE)
                        <li class="nav-item my-1">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.visa-types.*') ? 'active' : '' }}"
                                href="#sidebarVisaTypes" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarVisaTypes">
                                <i data-feather="divide-circle" class="icon-dual"></i>
                                <span data-key="t-visa-types">Visa Types</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.visa-types.*') ? 'show' : '' }}"
                                id="sidebarVisaTypes">
                                <ul class="nav nav-sm flex-column">
                                    @hasPermission('Visa Create Type')
                                        @can(\App\Permissions::CREATE_VISA_TYPE)
                                            <li class="nav-item">
                                                <a href="{{ route('admin.visa-types.create') }}"
                                                    class="nav-link {{ request()->routeIs('admin.visa-types.create') ? 'active' : '' }}"
                                                    data-key="t-add-visa-type">
                                                    Add Visa Type
                                                </a>
                                            </li>
                                        @endcan
                                    @endhasPermission

                                    <li class="nav-item">
                                        <a href="{{ route('admin.visa-types.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.visa-types.index') ? 'active' : '' }}"
                                            data-key="t-visa-type-list">
                                            Visa Type List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                @endhasPermission

                @hasPermission('Road List')
                    @can(\App\Permissions::VIEW_ROAD)
                        <li class="nav-item my-1">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.road.*') ? 'active' : '' }}"
                                href="#sidebarRoad" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarRoad">
                                <i data-feather="divide-circle" class="icon-dual"></i>
                                <span data-key="t-visa-types">By Road</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.road.*') ? 'show' : '' }}"
                                id="sidebarRoad">
                                <ul class="nav nav-sm flex-column">

                                    @hasPermission('Create Road')
                                        @can(\App\Permissions::CREATE_ROAD)
                                            <li class="nav-item">
                                                <a href="{{ route('admin.road.create') }}"
                                                    class="nav-link {{ request()->routeIs('admin.road.create') ? 'active' : '' }}"
                                                    data-key="t-add-visa-type">
                                                    Add Road
                                                </a>
                                            </li>
                                        @endcan
                                    @endhasPermission
                                    @can(\App\Permissions::VIEW_ROAD)
                                        <li class="nav-item">
                                            <a href="{{ route('admin.road.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.road.index') ? 'active' : '' }}"
                                                data-key="t-visa-type-list">
                                                Road List
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                @endhasPermission




                <!-- balance transfer -->
                @hasPermission('Transfer List')
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.transfer.*') ? 'active' : '' }}"
                            href="#sidebarBalance" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarBalance">
                            <i data-feather="divide-circle" class="icon-dual"></i>
                            <span data-key="t-visa-types">Balance</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.transfer.*') ? 'show' : '' }}"
                            id="sidebarBalance">
                            <ul class="nav nav-sm flex-column">
                                @hasPermission('Transfer Create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.transfer.create') }}"
                                            class="nav-link {{ request()->routeIs('admin.transfer.create') ? 'active' : '' }}"
                                            data-key="t-add-visa-type">
                                            Transfer Balance Create
                                        </a>
                                    </li>
                                @endhasPermission
                                @hasPermission('Transfer List')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.transfer.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.transfer.index') ? 'active' : '' }}"
                                            data-key="t-add-visa-type">
                                            Transfer Balance List
                                        </a>
                                    </li>
                                @endhasPermission

                                @hasPermission('Recive List')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.recive.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.recive.index') ? 'active' : '' }}"
                                            data-key="t-visa-type-list">
                                            Receive Balance List
                                        </a>
                                    </li>
                                @endhasPermission

                                @hasPermission('Statement List')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.statement.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.statement.index') ? 'active' : '' }}"
                                            data-key="t-visa-type-list">
                                            Statement List
                                        </a>
                                    </li>
                                @endhasPermission
                            </ul>
                        </div>
                    </li>
                    <!-- balance transfer -->
                @endhasPermission


                {{-- holiday --}}
                @hasPermission('Holiday List')
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.holiday.*') ? 'active' : '' }}"
                            href="#sidebarholiday" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarholiday">
                            <i data-feather="divide-circle" class="icon-dual"></i>
                            <span data-key="t-visa-types">Holiday List</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.holiday.*') ? 'show' : '' }}"
                            id="sidebarholiday">
                            <ul class="nav nav-sm flex-column">
                                @hasPermission('Holiday Create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.holiday.create') }}"
                                            class="nav-link {{ request()->routeIs('admin.holiday.create') ? 'active' : '' }}"
                                            data-key="t-add-visa-type">
                                            Add holiday
                                        </a>
                                    </li>
                                @endhasPermission
                                @hasPermission('Holiday List')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.holiday.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.holiday.index') ? 'active' : '' }}"
                                            data-key="t-visa-type-list">
                                            holiday List
                                        </a>
                                    </li>
                                @endhasPermission
                            </ul>
                        </div>
                    </li>
                @endhasPermission

                {{-- leave --}}
                @hasPermission('Leave List')
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.leave.*') ? 'active' : '' }}"
                            href="#sidebarleave" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarleave">
                            <i data-feather="divide-circle" class="icon-dual"></i>
                            <span data-key="t-visa-types">leave Apply</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.leave.*') ? 'show' : '' }}"
                            id="sidebarleave">
                            <ul class="nav nav-sm flex-column">
                                @hasPermission('Leave Create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.leave.create') }}"
                                            class="nav-link {{ request()->routeIs('admin.leave.create') ? 'active' : '' }}"
                                            data-key="t-add-visa-type">
                                            Add Leave
                                        </a>
                                    </li>
                                @endhasPermission
                                @hasPermission('Leave List')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.leave.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.leave.index') ? 'active' : '' }}"
                                            data-key="t-visa-type-list">
                                            Leave List
                                        </a>
                                    </li>
                                @endhasPermission
                            </ul>
                        </div>
                    </li>
                @endhasPermission

                {{-- attendance --}}
                @hasPermission('Attendance List')
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}"
                            href="#sidebarAttendance" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarAttendance">
                            <i data-feather="divide-circle" class="icon-dual"></i>
                            <span data-key="t-visa-types">Attendance</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.attendance.*') ? 'show' : '' }}"
                            id="sidebarAttendance">
                            <ul class="nav nav-sm flex-column">
                                @hasPermission('Attendance List')
                                    <li class="nav-item">
                                        <a href="{{ url('admin/attendance') }}"
                                            class="nav-link {{ request()->routeIs('admin.attendance') ? 'active' : '' }}"
                                            data-key="t-add-visa-type">
                                            Attendance List
                                        </a>
                                    </li>
                                @endhasPermission
                            </ul>
                        </div>
                    </li>
                @endhasPermission



                @hasPermission('List Link')
                    @can(\App\Permissions::VIEW_LINK)
                        <li class="nav-item my-1">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.link.*') ? 'active' : '' }}"
                                href="#sidebarLink" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarLink">
                                <i data-feather="divide-circle" class="icon-dual"></i>
                                <span data-key="t-visa-types">Website Link</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.link.*') ? 'show' : '' }}"
                                id="sidebarLink">
                                <ul class="nav nav-sm flex-column">
                                    @hasPermission('Create Link')
                                        @can(\App\Permissions::CREATE_LINK)
                                            <li class="nav-item">
                                                <a href="{{ route('admin.link.create') }}"
                                                    class="nav-link {{ request()->routeIs('admin.link.create') ? 'active' : '' }}"
                                                    data-key="t-add-visa-type">
                                                    Add Website Link
                                                </a>
                                            </li>
                                        @endcan
                                    @endhasPermission

                                    @can(\App\Permissions::VIEW_LINK)
                                        <li class="nav-item">
                                            <a href="{{ route('admin.link.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.link.index') ? 'active' : '' }}"
                                                data-key="t-visa-type-list">
                                                Website List
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                @endhasPermission

                {{-- package and service --}}
                @can(\App\Permissions::VIEW_SERVICE, \App\Permissions::VIEW_TOUR_PACKAGE)
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.services.*', 'admin.tour-packages.*') ? 'active' : '' }}"
                            href="#sidebarConfiguration" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarConfiguration">
                            <i data-feather="tool" class="icon-dual"></i>
                            <span data-key="t-configuration">Billing</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.services.*', 'admin.tour-packages.*') ? 'show' : '' }}"
                            id="sidebarConfiguration">
                            <ul class="nav nav-sm flex-column">
                                @hasPermission('List Service')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.services.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.services.index') ? 'active' : '' }}"
                                            data-key="t-service-charge">
                                            Service Charge
                                        </a>
                                    </li>
                                @endhasPermission
                                @hasPermission('List Package')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.tour-packages.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.tour-packages.index') ? 'active' : '' }}"
                                            data-key="t-tour-packages">
                                            Tour Packages
                                        </a>
                                    </li>
                                @endhasPermission
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- role and user --}}
                @can(\App\Permissions::VIEW_ROLE, \App\Permissions::VIEW_USER)
                    <li class="nav-item my-1">
                        <a class="nav-link menu-link {{ request()->routeIs('admin.roles.*', 'admin.users.*') ? 'active' : '' }}"
                            href="#sidebarUserManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarUserManagement">
                            <i data-feather="users" class="icon-dual"></i>
                            <span data-key="t-user-management">User Management</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('admin.roles.*', 'admin.users.*') ? 'show' : '' }}"
                            id="sidebarUserManagement">
                            <ul class="nav nav-sm flex-column">
                                @hasPermission('Access Roles')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.roles.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}"
                                            data-key="t-add-roles">
                                            Roles
                                        </a>
                                    </li>
                                @endhasPermission
                                @hasPermission('Access Users')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.users.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
                                            data-key="t-users">
                                            Users
                                        </a>
                                    </li>
                                @endhasPermission
                            </ul>
                        </div>
                    </li>
                @endcan

                @hasPermission('List Expense')
                    @can(\App\Permissions::VIEW_DAILY_OFFICE_EXPENSE)
                        <li class="nav-item">
                            <a href="{{ route('admin.daily-office-expenses.index') }}"
                                class="nav-link {{ request()->routeIs('admin.daily-office-expenses.index') ? 'active' : '' }}"
                                data-key="t-daily-office-expense">
                                <i data-feather="paperclip" class="icon-dual"></i>
                                <span data-key="t-daily-office-spending">Daily Office Spending</span>
                            </a>
                        </li>
                    @endcan
                @endhasPermission

                @hasPermission('List Duty')
                    @can(\App\Permissions::VIEW_STAFF_DUTY_SALARY)
                        <li class="nav-item">
                            <a href="{{ route('admin.staff-duty-salaries.index') }}"
                                class="nav-link {{ request()->routeIs('admin.staff-duty-salaries.index') ? 'active' : '' }}">
                                <i data-feather="percent" class="icon-dual"></i>
                                <span data-key="t-staff-duty-salary">Staff Duty & Salary</span>
                            </a>
                        </li>
                    @endcan
                @endhasPermission
                @hasPermission('Access Activity Logs')
                    @can(\App\Permissions::ACCESS_ACTIVITY_LOGS)
                        <li class="nav-item my-1">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.activity-logs') ? 'active' : '' }}"
                                href="{{ route('admin.activity-logs') }}">
                                <i data-feather="list" class="icon-dual-warning"></i>
                                <span data-key="t-activity-logs">Activity Logs</span>
                            </a>
                        </li>
                    @endcan
                @endhasPermission
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
