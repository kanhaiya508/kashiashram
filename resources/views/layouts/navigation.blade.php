<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" class="logo w-100 ">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
     <!-- Dashboard -->
<li class="menu-item">
    <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>

<!-- Room Calendar -->
<li class="menu-item {{ request()->routeIs('room-calendar') ? 'active' : '' }}">
    <a href="{{ route('room-calendar') }}" class="menu-link">
        <i class="menu-icon fas fa-clock"></i>
        <span class="menu-text">Room Calendar</span>
    </a>
</li>

<!-- Donor Calendar -->
<li class="menu-item {{ request()->routeIs('donor-calendar') ? 'active' : '' }}">
    <a href="{{ route('donor-calendar') }}" class="menu-link">
        <i class="menu-icon fas fa-hand-holding-heart"></i>
        <span class="menu-text">Donor Calendar</span>
    </a>
</li>

<!-- Booking Enquiry -->
<li class="menu-item {{ request()->routeIs('room-bookings.enquiry') ? 'active' : '' }}">
    <a href="{{ route('room-bookings.enquiry') }}" class="menu-link">
        <i class="menu-icon fas fa-question-circle"></i>
        <span class="menu-text">Booking Enquiry</span>
    </a>
</li>

<!-- New Booking -->
<li class="menu-item {{ request()->routeIs('room-bookings.available') ? 'active' : '' }}">
    <a href="{{ route('room-bookings.available') }}" class="menu-link">
        <i class="menu-icon fas fa-plus-square"></i>
        <span class="menu-text">New Booking</span>
    </a>
</li>

<!-- Booking List -->
<li class="menu-item {{ request()->routeIs('room-bookings.index') ? 'active' : '' }}">
    <a href="{{ route('room-bookings.index') }}" class="menu-link">
        <i class="menu-icon fas fa-list"></i>
        <span class="menu-text">Booking List</span>
    </a>
</li>

@can('room-list')
    <li class="menu-item {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
        <a href="{{ route('rooms.index') }}" class="menu-link">
            <i class="menu-icon fas fa-bed"></i>
            <span class="menu-text">Rooms</span>
        </a>
    </li>
@endcan

@can('ashram-list')
    <li class="menu-item {{ request()->routeIs('ashrams.*') ? 'active' : '' }}">
        <a href="{{ route('ashrams.index') }}" class="menu-link">
            <i class="menu-icon fas fa-church"></i>
            <span class="menu-text">Ashrams</span>
        </a>
    </li>
@endcan


        <!-- User Info -->

        @canany(['role-list', 'user-list'])
            @php
                $userActive = Request::routeIs('roles.*') || Request::routeIs('users.*') ? 'active open' : '';
            @endphp
            <li class="menu-item {{ $userActive }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Layouts">User Info</div>
                </a>

                <ul class="menu-sub">
                    @can('role-list')
                        <li class="menu-item {{ Request::routeIs('roles.*') ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}" class="menu-link" title="Manage roles and permissions">
                                <div data-i18n="Without menu">Role Management</div>
                            </a>
                        </li>
                    @endcan

                    @can('user-list')
                        <li class="menu-item {{ Request::routeIs('users.*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="menu-link" title="Manage user accounts">
                                <div data-i18n="Without menu">User Management</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany



        <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
        <li class="menu-item">
            <a href="https://wa.me/+916392945727" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
