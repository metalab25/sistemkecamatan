<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name') . ' v.' . config('app.version') }} | {{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="{{ config('app.name') . ' v.' . config('app.version') }} | {{ $title }}" />
    <meta name="author" content="{{ config('app.author') }}" />
    <meta name="description" content="Sistem Informasi Kecamatan media aplikasi pusat kelola data kecamatan" />
    <meta name="keywords" content="teka desa, desa, teka, sistem informasi desa, sistem, sistem informasi, kecamatan" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Nunito:400,500,600,700" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Poppins:400,500,600,700" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Quicksand:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayscrollbars/css/overlayscrollbars.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-icons/bootstrap-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/dataTables/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}" />
    @stack('css')
    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.0.min.js') }}"></script>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    @include('sweetalert::alert')
    <div class="app-wrapper">
        @include('dashboard.layouts.topbar')
        @include('dashboard.layouts.sidebar')
        <main class="app-main">
            @include('dashboard.layouts.breadcrumb')
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('dashboard.layouts.footer')
