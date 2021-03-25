@extends('template.master-dashboard')

@section('title', 'رفقا')

@section('inner-content')
    <div class="row">
        <div class="col-12 my-3 row">
            <div class="col-12 col-md-6">
                <h2 class="font-weight-bold">رفقا</h2>
            </div>
            <div class="col-12 col-md-6">
                <form class="form-inline float-left" method="get"
                      action="{{ url('rofagha?'.request()->getQueryString()) }}">
                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="اسم و فامیل" name="q">
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                </form>
            </div>
        </div>
        @foreach($users as $user)
            <div class="col-12 col-md-6 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-3 col-md-4">
                            @if(!is_null($user->avatar))
                                <img src="{{ asset(Illuminate\Support\Facades\Storage::url($user->avatar)) }}"
                                     class="card-img">
                            @else
                                <img src="{{ asset('img/default-user-image.png') }}" class="card-img">
                            @endif
                        </div>
                        <div class="col-9 col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">
                                    <span class="badge badge-info">{{ optional($user->team)->name }}</span>
                                    <span class="badge badge-warning">{{ optional($user->chapter)->name }}</span>
                                <hr>
                                <a href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a>
                                <a class="btn btn-light btn-sm py-1 px-2" target="_blank"
                                   href="https://wa.me/+98{{ substr($user->mobile,1) }}">
                                    <i class="mdi mdi-whatsapp"></i>
                                </a>
                                <a class="btn btn-light btn-sm py-1 px-2" target="_blank"
                                   href="mailto:{{$user->email}}">
                                    <i class="mdi mdi-gmail"></i>
                                </a>
                                <a class="btn btn-light btn-sm py-1 px-2" target="_blank"
                                   href="mailto:{{$user->email_basalam}}">
                                    <i class="mdi mdi-email-variant"></i>
                                </a>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $users->links() }}
    </div>

@endsection
