@extends('template.master-dashboard')

@section('title', $user->name)

@section('inner-content')
    <div class="row">
        <div class="col-md-2 col-12">
            @if(!is_null($user->avatar))
                <img src="{{ asset(Illuminate\Support\Facades\Storage::url($user->avatar)) }}"
                     class="img-thumbnail">
            @else
                <img src="{{ asset('img/default-user-image.png') }}" class="card-img">
            @endif
        </div>
        <div class="col-md-8 col-12">
            <h1 class="h3 mt-3">{{ $user->name }}</h1>
            {{ optional($user->team)->name }}
            -
            {{ optional($user->chapter)->name }}
            -
            ورود:
            {{ jdfw_name($user->started_at) }}
            <div class="my-3">
                {!! nl2br($user->biography)  !!}
            </div>
            @isset($user->email)
            <div class="info-box">
                {{ $user->email }}
            </div>
            @endisset
            @isset($user->email_basalam)
            <div class="info-box">
                {{ $user->email_basalam }}
            </div>
            @endisset
            <div class="info-box">
                {{ $user->mobile }}
            </div>
            @isset($user->linkedin_url)
            <div class="info-box">
                {{ $user->linkedin_url }}
            </div>
            @endisset
            @isset($user->virgol_url)
                <div class="info-box">
                    {{ $user->virgol_url }}
                </div>
            @endisset
        </div>
        <div class="col-md-2 col-12">

        </div>
    </div>
@endsection