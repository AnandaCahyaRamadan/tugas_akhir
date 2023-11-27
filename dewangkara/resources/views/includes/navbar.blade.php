<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        {{-- <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div> --}}
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <div class="d-none d-md-block">
                <span class="fw-semibold d-block">{{ Auth::user()->nama }}</span>
            </div>
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    @if (Auth::user()->avatar)
                    <img src="{{  asset('storage/'. Auth::user()->avatar)}}" alt
                        class="w-px-40 h-auto rounded-circle" />
                    @else
                    <img src="{{asset('template/img/no-image.png')}}" alt
                        class="w-px-40 h-auto rounded-circle" />
                    @endif
                </div>
              </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        @if (Auth::user()->avatar)
                                        <img src="{{  asset('storage/'. Auth::user()->avatar)}}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                        @else
                                        <img src="{{asset('template/img/no-image.png')}}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                    <span class="fw-semibold d-block">{{ Auth::user()->nama }}</span>
                                    <small class="text-muted">
                                        @if (implode(', ', Auth::user()->getRoleNames()->toArray()) == 'cover-patner')
                                        Cover Partner
                                        @endif
                                        @if (implode(', ', Auth::user()->getRoleNames()->toArray()) == 'publisher')
                                        Publisher
                                        @endif
                                        @if (implode(', ', Auth::user()->getRoleNames()->toArray()) == 'super-admin')
                                        Super Admin
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ Route('profile.edit', Crypt::encryptString(Auth::user()->id)) }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="notificationBeforeLogout(event, this).submit();"><i class="bx bx-power-off me-2"></i><span class="align-middle">Log Out</span></a>
                        <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>

<!-- / Navbar -->
