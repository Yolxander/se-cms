<nav class="navbar bg-slate-900 navbar-expand-lg flex-wrap top-0 px-0 py-0">
    <div class="container py-2">
        <nav aria-label="breadcrumb">
            <div class="d-flex align-items-center">
                <span class="px-3 font-weight-bold text-lg text-white me-4">Hotel CMS Dashboard</span>
            </div>
        </nav>
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="nav-link text-white p-0">
                    Dashboard
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('manage_pages') }}" class="nav-link text-white p-0">
                    Manage Pages
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('photo_gallery') }}" class="nav-link text-white p-0">
                    Photo Gallery
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('booking_management') }}" class="nav-link text-white p-0">
                    Booking Management
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('guest_reviews') }}" class="nav-link text-white p-0">
                    Guest Reviews
                </a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('settings') }}" class="nav-link text-white p-0">
                    Settings
                </a>
            </li>
        </ul>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-md-auto justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <!-- Additional navbar items for notifications, settings, and other actions -->
            </ul>
        </div>
    </div>
</nav>
