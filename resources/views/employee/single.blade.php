@extends('template.master-dashboard')

@section('title', $user->name)

@section('inner-content')
    <div class="row text-center">
        <div class="col-12">
            @if(!is_null($user->avatar))
                <img src="{{ asset(Illuminate\Support\Facades\Storage::url($user->avatar)) }}"
                     class="rounded-circle" style="width: 160px">
            @else
                <img src="{{ asset('img/default-user-image.png') }}" class="rounded-circle" style="width: 160px">
            @endif
        </div>
        <div class="col-12 mt-3">
            <h1 class="h3">{{ $user->name }}</h1>
        </div>
        <div class="col-12 col-md-4 mx-md-auto mt-3">
            {!! nl2br($user->biography)  !!}
        </div>
        <div class="col-12 text-black mt-3">
            عضو تیم
            {{ optional($user->team)->name }}
            از چپتر
            {{ optional($user->chapter)->name }}
        </div>
        <div class="col-12 mt-3 ltr">
            <span class="info-box">
                <i class="mdi mdi-cellphone"></i>
                {{ $user->mobile }}
            </span>
        </div>
        <div class="col-12 mt-3 ltr">
            @isset($user->email_basalam)
                <span class="info-box">
                    <i class="mdi mdi-email"></i>
                    {{ $user->email_basalam }}
                </span>
            @endisset
            @isset($user->email)
                <span class="info-box">
                    <i class="mdi mdi-gmail"></i>
                    {{ $user->email }}
                </span>
            @endisset
        </div>
        <div class="col-12 mt-5 ltr">
            @isset($user->linkedin_url)
                <a href="{{ $user->linkedin_url }}" class="icon-social">
                    <i class="mdi mdi-linkedin"></i>
                </a>
            @endisset
            @isset($user->virgol_url)
                <a href="{{ $user->virgol_url }}" class="icon-social">
                    <i class="mdi mdi-comma"></i>
                </a>
            @endisset
        </div>
        <div class="col-12 mt-5">
            ورود:
            {{ jdfw_name($user->started_at) }}
        </div>
    </div>
@endsection