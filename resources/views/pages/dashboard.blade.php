@extends('template.master-dashboard')

@section('title', 'داشبورد')

@section('inner-content')

    <div class="row home">
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-3 col-md-4">
                        @if(!is_null($user->avatar))
                            <img src="{{ asset(Illuminate\Support\Facades\Storage::url($user->avatar)) }}" class="card-img">
                        @else
                            <img src="{{ asset('img/default-user-image.png') }}" class="card-img">
                        @endif
                    </div>
                    <div class="col-9 col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">سلام {{ $user->name }}</h5>
                            <p class="card-text">
                                <a href="{{ url('setting') }}" class="btn btn-outline-light">
                                    تنظیمات
                                    <span class="badge badge-danger">جدید</span>
                                </a>
                                <a href="{{ url('logout') }}" class="btn btn-outline-light">خروج</a>
                            </p>
                            <div>
                                کد پرسنلی: {{ $user->employee_id }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            @forelse($notices as $notice)
                @if(!is_null($notice->banner))
                    <a href="{{ url('notices/'. $notice->id) }}">
                        <div class="card bg-dark text-white mb-4">
                            <img src="{{ asset(Illuminate\Support\Facades\Storage::url($notice->banner)) }}"
                                 class="card-img">
                        </div>
                    </a>
                @endif
            @empty
                <div class="card d-none d-md-block mb-4">
                    <img src="{{ asset('img/default-notice.jpg') }}" class="card-img">
                </div>
            @endforelse
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{ asset('img/tahdig_3.jpg') }}" class="card-img">
                    </div>
                    <div class="col-md-9">
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
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{ asset('img/otagh_3.jpg') }}" class="card-img">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">اتاق (آزمایشی)</h5>
                            <p class="card-text">
                                <a href="{{ url('otagh/reserve') }}" class="btn btn-outline-light">رزرو</a>
                                {{--<a href="{{ url('tahdig/history') }}" class="btn btn-outline-light">تاریخچه</a>--}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{ asset('img/links_3.jpg') }}" class="card-img">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">لینک‌ها</h5>
                            <p class="card-text">
                                @foreach($links as $link)
                                    <a href="{{ $link->url }}" class="btn btn-outline-light"
                                       target="_blank">{{ $link->title }}</a>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{ asset('img/contact_3.jpg') }}" class="card-img">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">دفترچه تلفن</h5>
                            <p class="card-text">
                                <a href="{{ url('contacts/chapters') }}" class="btn btn-outline-light">چپترها</a>
                                <a href="{{ url('contacts/teams') }}" class="btn btn-outline-light">تیم‌ها</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
