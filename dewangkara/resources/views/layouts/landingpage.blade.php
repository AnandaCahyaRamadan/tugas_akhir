<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('template/') }}" data-template="vertical-menu-template-free">

<head>
    @include('includes.landingpage.meta')

    <title>@yield('title')</title>

    @stack('before-style')

    @include('includes.landingpage.style')

    @stack('after-style')
</head>

<body>
    <!-- Preloader Start -->
    <div class="page-loading active">
        <div class="page-loading-inner">
          <div class="page-spinner"></div>
          <span>Loading...</span>
        </div>
      </div>
    <!-- Preloader Start -->

    <!-- Layout -->
    @include('includes.landingpage.navbar')
    
    <main>

        @yield('content')

    </main>

        @include('includes.landingpage.footer')

        <!-- Back to top button -->
        <a href="#top" class="btn-scroll-top" data-scroll>
            <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
            <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
          </a>

    @stack('before-script')

    @include('includes.landingpage.script')

    @stack('after-script')

</body>


</html>
