@extends('master')

@section('content')
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <a class="navbar-brand" href="#">باسلامیها</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">رزرو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">تاریخچه</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">مدیریت</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('inner-content')
@endsection