@extends('master-dashboard')

@section('title', 'رزرو')

@section('inner-content')
    <form action="{{ url('/tahdig/reserve') }}" method="post">
        @csrf
        <div class="row row-cols-1 row-cols-md-2 mt-4">
            @foreach($bookings as $booking)

                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">{{ jdfw($booking->booking_date) }} {{ $booking->meal->name }}</h3>
                            <p class="card-text">
                            @php
                                if (auth()->user()->is_inter) {
                                    $foods = $booking->foodsForInter;
                                }else{
                                    $foods = $booking->foods;
                                }
                            @endphp
                            @foreach($foods as $food)
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="{{ $booking->id.'-'.$food->id }}"
                                           name="{{ $booking->id }}-f"
                                           value="{{ $food->id }}"
                                           @if(
                                           $reserved->where('booking_id',$booking->id)
                                           ->where('food_id',$food->id)
                                           ->isNotEmpty()
                                           )
                                           checked
                                           @endif
                                           class="custom-control-input">
                                    <label class="custom-control-label pb-3" for="{{ $booking->id.'-'.$food->id }}">
                                        <span class="h6 font-weight-bold">{{ $food->name }}</span>
                                        <span class="badge badge-dark mx-1">{{ $food->price }} تومان </span>
                                        <span class="mx-2">/</span>
                                        {{ $food->restaurant->name }}

                                    </label>
                                </div>
                                @endforeach

                                </p>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row m-0">
                                <label for="quantity" class="col-sm-2 col-form-label">تعداد</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="{{ $booking->id }}-q" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav class="navbar fixed-bottom navbar-light bg-light">
            <div class="container text-left">
                <button class="btn btn-primary ml-auto" type="submit">ثبت</button>
            </div>
        </nav>
    </form>
@endsection
