<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - سامانه سلام</title>
    <link href="{{ mix('css/bootstrap-rtl.css') }}" rel="stylesheet">
    <link href="{{ mix('css/shards.css') }}" rel="stylesheet">
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/materialdesignicons.min.css') }}" rel="stylesheet">
    @livewireStyles
    @stack('css')
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon96x96.png" sizes="96x96">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" >
</head>
<body class="rtl @yield('css-box')">

<main class="container">
   @yield('content')
</main>

<script src="{{ mix('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ mix('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ mix('js/shards.min.js') }}"></script>
@livewireScripts
@stack('js')
</body>
</html>
