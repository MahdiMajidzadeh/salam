@extends('template.master-dashboard')

@section('title', 'داشبورد')

@section('inner-content')

    <div class="row home">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <img src="{{ asset('img/default-user-image.png') }}" class="card-img">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">سلام {{ auth()->user()->name }}</h5>
                            <p class="card-text">
                                <a href="{{ url('dashboard/password-reset') }}" class="btn btn-outline-light">تغییر رمز</a>
                                <a href="{{ url('logout') }}" class="btn btn-outline-light">خروج</a>
                            </p>
                            <div>
                                کد پرسنلی: {{ auth()->user()->employment_id }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <img src="{{ asset('img/tahdig.jpg') }}" class="card-img">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">ته‌دیگ</h5>
                            <p class="card-text">
                                <a href="{{ url('tahdig/reserve') }}" class="btn btn-outline-light">رزرو</a>
                                <a href="{{ url('tahdig/history') }}" class="btn btn-outline-light">تاریخچه</a>
                            </p>
                            @isset($todayReserved)
                                <div>
                                    غذای امروز:
                                    <strong>{{$todayReserved->food->name}} ({{$todayReserved->food->restaurant->name}}
                                        )</strong>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <img src="{{ asset('img/otagh.jpg') }}" class="card-img">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">اتاق</h5>
                            <p class="card-text">
                                <a href="{{ url('otagh/reserve') }}" class="btn btn-outline-light">رزرو</a>
                                {{--<a href="{{ url('tahdig/history') }}" class="btn btn-outline-light">تاریخچه</a>--}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <img src="{{ asset('img/ghafase.jpg') }}" class="card-img">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">قفسه</h5>
                            <p class="card-text">
                                (به زودی)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--@foreach($notices as $notice)--}}
    {{--@if(!is_null($notice->banner))--}}
    {{--<a href="{{ url('notices/'. $notice->id) }}">--}}
    {{--<div class="card bg-dark text-white">--}}
    {{--<img src="{{ asset(Illuminate\Support\Facades\Storage::url($notice->banner)) }}"--}}
    {{--class="card-img">--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--@endif--}}
    {{--@endforeach--}}
@endsection
