@extends('master-dashboard')

@section('title', $notice->title)

@section('inner-content')
<div class="row">
    <div class="col-12 col-md-8 mx-auto">
        <div class="card my-4">
            <div class="card-body">
                <h1 class="">
                    {{ $notice->title }}
                </h1>
                @if(!is_null($notice->banner))
                    <img src="{{ asset(Illuminate\Support\Facades\Storage::url($notice->banner)) }}"
                         class="card-img">
                @endif
                <div class="my-3"></div>
                {!! $notice->content !!}
            </div>
        </div>
    </div>
</div>

@endsection
