@extends('template.master-dashboard')

@section('title', 'داشبورد')

@section('inner-content')

    <div class="home">
        <div class="card-columns">
            {{--<div class="card">--}}
            {{--@if(!is_null($user->avatar))--}}
            {{--<img src="{{ asset(Illuminate\Support\Facades\Storage::url($user->avatar)) }}" class="card-img-top">--}}
            {{--@else--}}
            {{--<img src="{{ asset('img/default-user-image.png') }}" class="card-img-top img-thumbnail">--}}
            {{--@endif--}}
            {{--<div class="card-body">--}}
            {{--<h5 class="card-title">سلام {{ $user->name }}</h5>--}}
            {{--<p class="card-text">--}}
            {{--<a href="{{ url('setting') }}" class="btn btn-outline-primary">--}}
            {{--تنظیمات--}}
            {{--</a>--}}
            {{--<a href="{{ url('logout') }}" class="btn btn-outline-primary">خروج</a>--}}
            {{--</p>--}}
            {{--<div>--}}
            {{--کد پرسنلی: {{ $user->employee_id }}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            @foreach($notices as $notice)
                <a href="{{ url('notices/'. $notice->id) }}">
                    <div class="card bg-dark text-white mb-4">
                        <img src="{{ asset(Illuminate\Support\Facades\Storage::url($notice->banner)) }}"
                             class="card-img">
                    </div>
                </a>
            @endforeach
            <div class="card">
                <img src="{{ asset('img/tahdig_3.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-food"></i>
                        ته‌دیگ
                    </h5>
                    @isset($todayReserved)
                        <div>
                            غذای امروز:
                            <br>
                            <strong>{{$todayReserved->food->name}} ({{$todayReserved->food->restaurant->name}}
                                )</strong>
                        </div>
                    @endisset
                    <p class="card-text">
                        <a href="{{ url('tahdig/reserve') }}" class="btn btn-primary btn-block">رزرو</a>
                        <a href="{{ url('tahdig/history') }}" class="btn btn-outline-primary btn-block">تاریخچه</a>
                    </p>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('img/otagh_3.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-home-automation"></i>
                        اتاق (آزمایشی)
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('otagh/reserve') }}" class="btn btn-block btn-primary">رزرو</a>
                        {{--<a href="{{ url('tahdig/history') }}" class="btn btn-outline-light">تاریخچه</a>--}}
                    </p>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('img/ghafase_3.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-bookshelf"></i>
                        قفسه (آزمایشی)
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('ghafase') }}" class="btn btn-primary btn-block">لیست</a>
                        <a href="{{ url('ghafase/history') }}" class="btn btn-outline-primary btn-block">تاریخچه</a>
                    </p>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('img/links_3.jpg') }}" class="card-img">

                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-link-variant"></i>
                        سرنخ
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('sarnakh/') }}" class="btn btn-outline-primary btn-block">دیدن همه</a>
                    </p>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('img/contact_3.jpg') }}" class="card-img">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-account-group"></i>
                        رفقا
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('rofagha') }}" class="btn btn-block btn-outline-primary">همگی</a>
                        <a href="{{ url('rofagha/chapters') }}" class="btn btn-block btn-outline-primary">چپترها</a>
                        <a href="{{ url('rofagha/teams') }}" class="btn btn-block btn-outline-primary">تیم‌ها</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
