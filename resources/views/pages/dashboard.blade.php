@extends('template.master-dashboard')

@section('title', 'داشبورد')

@section('inner-content')

    <div class="home">
        @if(!is_null($note))
            <div class="card mb-3,,,,">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ $note->title }}
                    </h3>
                    <div class="card-text mb-0">
                        {!! $note->content !!}
                    </div>
                </div>
            </div>
        @endif
        <div class="card-columns">
            @foreach($notices as $notice)
                @if($notice->banner)
                    <a href="{{ url('notices/'. $notice->id) }}">
                        <div class="card bg-dark text-white mb-4">
                            <img src="{{ asset(Illuminate\Support\Facades\Storage::url($notice->banner)) }}"
                                 class="card-img">
                        </div>
                    </a>
                @else
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">{{ $notice->title }}</h4>
                            <a href="{{ url('notices/'. $notice->id) }}" class="btn btn-outline-secondary btn-sm">
                                بیشتر
                            </a>
                        </div>
                    </div>
                @endif
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
                        <a href="{{ url('ghafase') }}" class="btn btn-primary btn-block disabled">لیست</a>
                        <a href="{{ url('ghafase/history') }}" class="btn btn-outline-primary btn-block disabled">تاریخچه</a>
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
