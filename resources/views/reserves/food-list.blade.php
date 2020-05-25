@extends('master-dashboard')

@section('title', 'رزرو')

@section('inner-content')
    <form action="{{ url('/dashboard/reserve') }}" method="post">
        @csrf
        @foreach($bookings as $booking)
            <div class="card my-3">
                <div class="card-body">
                    <h3 class="card-title">{{ jdfw($booking->booking_date) }} {{ $booking->meal->name }}</h3>
                    <p class="card-text">
                    @foreach($booking->foods as $food)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ $booking->id.'-'.$food->id }}" name="b-{{ $booking->id }}"
                                   value="{{ $food->id }}"
                                   class="custom-control-input">
                            <label class="custom-control-label pb-3" for="{{ $booking->id.'-'.$food->id }}">
                                <span class="h6 font-weight-bold">{{ $food->name }}</span>
                                <span class="badge badge-dark mx-1">{{ $food->price }} تومان </span>
                                <span class="mx-2">/</span>
                                {{ $food->restaurant->name }}
                                @if($booking->default_food_id == $food->id)
                                    <span class="pl-2"> </span>
                                    <span class="badge badge-pill badge-light text-dark">غذای پایه</span>
                                @else
                                    <span class="pl-2"> </span>
                                    <span class="badge badge-pill badge-light text-dark ltr">{{ sprintf("%+d", ($food->price - $booking->defaultFood->price)) }}</span>
                                @endif
                            </label>
                        </div>
                        @endforeach
                        </p>
                </div>
            </div>
        @endforeach
        <nav class="navbar fixed-bottom navbar-light bg-light">
            <div class="container text-left">
                <button class="btn btn-primary ml-auto" type="submit">ثبت</button>
            </div>
        </nav>
    </form>
@endsection
