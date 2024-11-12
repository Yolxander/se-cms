<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
           href="{{ route('dashboard') }}" target="_blank">
            <span class="font-weight-bold text-lg">Hotel CMS Dashboard</span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-4 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ is_current_route('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>dashboard</title>
                            <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                   fill-rule="nonzero">
                                    <path class="color-foreground"
                                          d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                          id="Path"></path>
                                    <path class="color-background"
                                          d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                          id="Path"></path>
                                    <path class="color-background"
                                          d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                          id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_current_route('pages.*') ? 'active' : '' }}" href="{{ route('pages.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>pages</title>
                            <g id="pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="document" transform="translate(12.000000, 12.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <path class="color-background"
                                          d="M20.5714286,0 L3.42857143,0 C1.53502286,0 0,1.53502286 0,3.42857143 L0,20.5714286 C0,22.4650286 1.53502286,24 3.42857143,24 L20.5714286,24 C22.4650286,24 24,22.4650286 24,20.5714286 L24,3.42857143 C24,1.53502286 22.4650286,0 20.5714286,0 Z M3.42857143,2.28571429 L20.5714286,2.28571429 C21.2031429,2.28571429 21.7142857,2.79685714 21.7142857,3.42857143 L21.7142857,6.85714286 L2.28571429,6.85714286 L2.28571429,3.42857143 C2.28571429,2.79685714 2.79685714,2.28571429 3.42857143,2.28571429 Z"
                                          id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Manage Pages</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_current_route('sections.*') ? 'active' : '' }}" href="{{ route('sections.index') }}">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>sections</title>
                            <g id="sections" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="layout" transform="translate(12.000000, 12.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <path class="color-background" d="M22,0 L2,0 C0.8954305,0 0,0.8954305 0,2 L0,22 C0,23.1045695 0.8954305,24 2,24 L22,24 C23.1045695,24 24,23.1045695 24,22 L24,2 C24,0.8954305 23.1045695,0 22,0 Z M10,22 L2,22 L2,12 L10,12 L10,22 Z M22,22 L12,22 L12,12 L22,12 L22,22 Z M22,10 L2,10 L2,2 L22,2 L22,10 Z" id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Manage Page Sections</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_current_route('media.*') ? 'active' : '' }}" href="{{ route('media.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>media</title>
                            <g id="media" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="image" transform="translate(12.000000, 12.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <path class="color-background"
                                          d="M21.7142857,0 L2.28571429,0 C1.02321429,0 0,1.02321429 0,2.28571429 L0,21.7142857 C0,22.9767857 1.02321429,24 2.28571429,24 L21.7142857,24 C22.9767857,24 24,22.9767857 24,21.7142857 L24,2.28571429 C24,1.02321429 22.9767857,0 21.7142857,0 Z M7.71428571,13.7142857 L10.2857143,16.2857143 L15.4285714,11.1428571 L21.7142857,17.4285714 L21.7142857,21.7142857 L2.28571429,21.7142857 L2.28571429,17.1428571 L7.71428571,13.7142857 Z"
                                          id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Photo Gallery</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_current_route('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>bookings</title>
                            <g id="bookings" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="calendar" transform="translate(12.000000, 12.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <path class="color-background"
                                          d="M21.7142857,3.42857143 L19.4285714,3.42857143 L19.4285714,1.71428571 C19.4285714,0.767142857 18.6614286,0 17.7142857,0 C16.7671429,0 16,0.767142857 16,1.71428571 L16,3.42857143 L8,3.42857143 L8,1.71428571 C8,0.767142857 7.23285714,0 6.28571429,0 C5.33857143,0 4.57142857,0.767142857 4.57142857,1.71428571 L4.57142857,3.42857143 L2.28571429,3.42857143 C1.02321429,3.42857143 0,4.45178571 0,5.71428571 L0,21.7142857 C0,22.9767857 1.02321429,24 2.28571429,24 L21.7142857,24 C22.9767857,24 24,22.9767857 24,21.7142857 L24,5.71428571 C24,4.45178571 22.9767857,3.42857143 21.7142857,3.42857143 Z M21.7142857,21.7142857 L2.28571429,21.7142857 L2.28571429,9.14285714 L21.7142857,9.14285714 L21.7142857,21.7142857 Z"
                                          id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Booking Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_current_route('reviews.*') ? 'active' : '' }}" href="{{ route('reviews.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>reviews</title>
                            <g id="reviews" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="star" transform="translate(12.000000, 12.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <path class="color-background"
                                          d="M12,0.587 L15.393,7.425 L22.854,8.533 L17.427,13.831 L18.719,21.271 L12,17.754 L5.281,21.271 L6.573,13.831 L1.146,8.533 L8.607,7.425 L12,0.587 Z"
                                          id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Guest Reviews</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_current_route('settings.*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g id="settings" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="cog" transform="translate(12.000000, 12.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <path class="color-background"
                                          d="M22.2857143,13.7142857 L22.2857143,10.2857143 L19.2857143,9.51428571 C19.0285714,8.61428571 18.6857143,7.75714286 18.2571429,6.94285714 L20.0571429,4.28571429 L17.7142857,1.94285714 L15.0571429,3.74285714 C14.2428571,3.31428571 13.3857143,2.97142857 12.4857143,2.71428571 L11.7142857,0 L8.28571429,0 L7.51428571,2.71428571 C6.61428571,2.97142857 5.75714286,3.31428571 4.94285714,3.74285714 L2.28571429,1.94285714 L0,4.28571429 L1.8,6.94285714 C1.37142857,7.75714286 1.02857143,8.61428571 0.771428571,9.51428571 L0,10.2857143 L0,13.7142857 L2.71428571,14.4857143 C2.97142857,15.3857143 3.31428571,16.2428571 3.74285714,17.0571429 L1.94285714,19.7142857 L4.28571429,22.0571429 L6.94285714,20.2571429 C7.75714286,20.6857143 8.61428571,21.0285714 9.51428571,21.2857143 L10.2857143,24 L13.7142857,24 L14.4857143,21.2857143 C15.3857143,21.0285714 16.2428571,20.6857143 17.0571429,20.2571429 L19.7142857,22.0571429 L22.0571429,19.7142857 L20.2571429,17.0571429 C20.6857143,16.2428571 21.0285714,15.3857143 21.2857143,14.4857143 L24,13.7142857 L22.2857143,13.7142857 Z M12,16.2857143 C9.6,16.2857143 7.71428571,14.4 7.71428571,12 C7.71428571,9.6 9.6,7.71428571 12,7.71428571 C14.4,7.71428571 16.2857143,9.6 16.2857143,12 C16.2857143,14.4 14.4,16.2857143 12,16.2857143 Z"
                                          id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Website Settings</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-4 ">
        <div class="card border-radius-md" id="sidenavCard">
            <div class="card-body  text-start  p-3 w-100">
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="text-primary"
                         viewBox="0 0 24 24" fill="currentColor" id="sidenavCardIcon">
                        <path
                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                        <path
                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                    </svg>
                </div>
                <div class="docs-info">
                    <h6 class="font-weight-bold up mb-2">Need help?</h6>
                    <p class="text-sm font-weight-normal">Please check our docs.</p>
                    <a href="{{ route('docs') }}"
                       target="_blank" class="font-weight-bold text-sm mb-0 icon-move-right mt-auto w-100 mb-0">
                        Documentation
                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
