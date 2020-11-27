@extends('template.master')

@section('content')
    <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark">
        <a class="navbar-brand" href="{{ url('dashboard') }}">سامانه باسلامی‌ها</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if(is_admin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin') }}">مدیریت</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="content">
        @yield('inner-content')
    </div>
@endsection