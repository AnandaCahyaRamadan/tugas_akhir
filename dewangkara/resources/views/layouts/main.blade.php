<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('template/') }}" data-template="vertical-menu-template-free">

<head>
    @include('includes.meta')

    <title>@yield('title') | DPS</title>

    @stack('before-style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <!-- Tambahkan ini untuk memuat Howler.js dari CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    


    @include('includes.style')

    @stack('after-style')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-light position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="demo-inline-spacing">
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">



        <div class="layout-container">

            @include('includes.sidebar')

            <div class="layout-page">

                @include('includes.navbar')

                <div class="content-wrapper">

                    @yield('content')

                    @include('includes.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    @stack('before-script')

    @include('includes.script')

    @stack('after-script')

</body>


</html>
