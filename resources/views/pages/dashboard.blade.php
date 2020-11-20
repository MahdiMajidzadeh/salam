@extends('master-dashboard')

@section('title', 'داشبورد')

@section('inner-content')

    <div class="row">
        <div class="col-md-5 order-2 order-md-1">
            <a href="{{ url('tahdig') }}">
                <div class="card overflow-hidden my-4">
                    <div class="card-img">
                        <img src="{{ asset('img/tahdig.jpg') }}" class="img-fluid">
                        <div class="card-img-overlay d-flex">
                            <h3 class="card-title align-self-center mx-auto m-0">ته دیگ</h3>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="card overflow-hidden my-4">
                    <div class="card-img">
                        <img src="{{ asset('img/otagh.jpg') }}" class="img-fluid">
                        <div class="card-img-overlay d-flex">
                            <h3 class="card-title align-self-center mx-auto m-0">اتاق (به زودی)</h3>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="card overflow-hidden my-4">
                    <div class="card-img">
                        <img src="{{ asset('img/ghafase.jpg') }}" class="img-fluid">
                        <div class="card-img-overlay d-flex">
                            <h3 class="card-title align-self-center mx-auto m-0">قفسه (به زودی)</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-7 order-1 order-md-2">
            <div class="bg-dark card text-white my-4">
                <div class="card-body">
                    <h4 class="text-white m-0">
                        سلام {{ auth()->user()->name }}
                    </h4>
                    <p>
                        کد پرسنلی: {{ auth()->user()->employment_id }}
                    </p>
                </div>
            </div>
            @foreach($notices as $notice)
                @if(!is_null($notice->banner))
                    <a href="{{ url('notices/'. $notice->id) }}">
                        <div class="card bg-dark text-white">
                            <img src="{{ asset(Illuminate\Support\Facades\Storage::url($notice->banner)) }}"
                                 class="card-img">
                        </div>
                    </a>
                @endif
            @endforeach
            @isset($todayReserved)
                <div class="bg-info card text-white my-4">
                    <div class="card-body">
                        <h4 class="text-white m-0">
                            غذای امروز : <span class="font-weight-bold">
                        {{$todayReserved->food->name}} ({{$todayReserved->food->restaurant->name}})
                    </span>
                        </h4>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
