<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <img src="{{ asset ('template/img/logo.png') }}" alt="" width="100px">
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

    @if(Auth::user()->hasRole('super-admin')||Auth::user()->hasRole('publisher')||Auth::user()->hasRole('cover-patner'))
    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard</span></li>
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Katalog Lagu</span></li>
        <!-- Cards -->
        <li class="menu-item {{ Request::is('dashboard/katalog-lagu*') ? 'active' : '' }}">
            <a href="{{ Route('katalog.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-playlist'></i>
                <div data-i18n="Basic">Katalog Lagu</div>
            </a>
        </li>
        @if(Auth::user()->hasRole('super-admin'))
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Akun</span></li>
        <!-- Cards -->
        <li class="menu-item {{ Request::is('dashboard/user/cover-patner*') || Request::is('dashboard/user/publisher*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Form Layouts">Kelola Akun</div>
            </a>
            <ul class="menu-sub" style="{{ Request::is('dashboard/user/cover-patner*') || Request::is('dashboard/user/publisher*') ? 'display:block' : '' }}">
                <li class="menu-item {{ Request::is('dashboard/user/cover-patner*') ? 'active' : '' }}">
                <a href="{{ route('user_cover_patner.index') }}" class="menu-link">
                    <div data-i18n="Vertical Form">Cover Partner</div>
                </a>
                </li>
                <li class="menu-item {{ Request::is('dashboard/user/publisher*') ? 'active' : '' }}">
                <a href="{{ route('user_publisher.index') }}" class="menu-link">
                    <div data-i18n="Horizontal Form">Publisher</div>
                </a>
                </li>
            </ul>
        </li>
        @endif
        <!-- Components -->
        @if(Auth::user()->hasRole('publisher'))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Member Cover Patner</span></li>
        <!-- Cards -->
        <li class="menu-item {{ Request::is('dashboard/pengajuan-cover*') ? 'active' : '' }}">
            <a href="{{ Route('pengajuan-cover.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-microphone-alt'></i>
                <div data-i18n="Basic">Member Cover Partner</div>
            </a>
        </li>
        @else
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengajuan Cover</span></li>
        <!-- Cards -->
        <li class="menu-item {{ Request::is('dashboard/pengajuan-cover*') ? 'active' : '' }}">
            <a href="{{ Route('pengajuan-cover.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-microphone-alt'></i>
                <div data-i18n="Basic">Pengajuan Cover</div>
            </a>
        </li>
        @endif
        <!-- Components -->
        @if(Auth::user()->hasRole('super-admin')||Auth::user()->hasRole('cover-patner'))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pembayaran</span></li>
        @endif
        <!-- Cards -->
        @if(Auth::user()->hasRole('super-admin'))
        <li class="menu-item {{ Request::is('dashboard/pembayaran/cover-patner*') || Request::is('dashboard/analisis-pembayaran*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Form Layouts">Pembayaran</div>
            </a>
            <ul class="menu-sub" style="{{ Request::is('dashboard/pembayaran/cover-patner*') ||  Request::is('dashboard/analisis-pembayaran*') ? 'display: block;' : '' }}">
                <li class="menu-item {{ Request::is('dashboard/pembayaran/cover-patner*') ? 'active' : '' }}">
                <a href="{{ route('pembayaran_cover_patner.index') }}" class="menu-link">
                    <div data-i18n="Vertical Form">Cover Partner</div>
                </a>
                </li>
                <li class="menu-item {{ Request::is('dashboard/analisis-pembayaran*') ? 'active' : '' }}">
                <a href="{{ route('analisis_pembayaran') }}" class="menu-link">
                    <div data-i18n="Horizontal Form">Analisis Pendapatan</div>
                </a>
                </li>
            </ul>
        </li>
        @endif
        @if(Auth::user()->hasRole('cover-patner'))
        <li class="menu-item {{ Request::is('dashboard/pembayaran/cover-patner*') ||  Request::is('dashboard/analisis-pembayaran*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Form Layouts">Pembayaran</div>
            </a>
            <ul class="menu-sub" style="{{ Request::is('dashboard/pembayaran/cover-patner*') ||  Request::is('dashboard/analisis-pembayaran*') ? 'display:block' : '' }}">
                <li class="menu-item {{ Request::is('dashboard/pembayaran/cover-patner*') ? 'active' : '' }}">
                    <a href="{{ route('pembayaran_cover_patner.riwayatCover',  Crypt::encryptString(Auth::user()->id)) }}" class="menu-link">
                    <div data-i18n="Vertical Form">Riwayat Pembayaran</div>
                </a>
                </li>
                <li class="menu-item {{ Request::is('dashboard/analisis-pembayaran*') ? 'active' : '' }}">
                <a href="{{ route('analisis_pembayaran') }}" class="menu-link">
                    <div data-i18n="Horizontal Form">Analisis Pendapatan</div>
                </a>
                </li>
            </ul>
        </li>
        @endif
        @if(Auth::user()->hasRole('super-admin'))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Testimoni</span></li>
        <!-- Cards -->
        <li class="menu-item {{ Request::is('dashboard/testimoni*') ? 'active' : '' }}">
            <a href="{{ Route('testimoni.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-message-dots'></i>
                <div data-i18n="Basic">Testimoni</div>
            </a>
        </li>
        @endif
        @if(Auth::user()->hasRole('super-admin'))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Top Hits</span></li>
        <!-- Cards -->
        <li class="menu-item {{ Request::is('dashboard/tophits*') ? 'active' : '' }}">
            <a href="{{ Route('tophits.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-music'></i>
                <div data-i18n="Basic">Top Hits</div>
            </a>
        </li>
        @endif
    @endif
    </ul>
</aside>
<!-- / Menu -->
