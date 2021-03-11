@extends('template.master-dashboard')

@section('title', 'دفترچه تلفن')

@section('inner-content')
    <div class="row">
        <div class="col-12 my-3">
            <h2 class="font-weight-bold">دفترچه تلفن</h2>
        </div>
        @foreach($users as $user)
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
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">
                                    <span class="badge badge-info">{{ $user->team->name }}</span>
                                    <span class="badge badge-warning">{{ $user->chapter->name }}</span>
                                    <hr>
                                    <a href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
