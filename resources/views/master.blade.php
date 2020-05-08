<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="{{ mix('css/nahar.css') }}" rel="stylesheet">
    {{--<link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">--}}
</head>

<body class="rtl">

<main class="container">
   @yield('content')
</main>

<script src="{{ mix('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ mix('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ mix('js/shards.min.js') }}"></script>
</body>
</html>
