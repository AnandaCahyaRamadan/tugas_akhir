<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('template/') }}" data-template="vertical-menu-template-free" >

<head>
    @include('includes.meta')

    <title>@yield('title') | DPS</title>

    @stack('before-style')

    @include('includes.style')

    @stack('after-style')
</head>

<body>
    @yield('content')

    @stack('before-script')

    @include('includes.script')

    @stack('after-script')
</body>
</html>
