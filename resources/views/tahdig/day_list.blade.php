@extends('template.master-dashboard')

@section('title', 'رزرو')

@section('inner-content')
    <form action="{{ url('/tahdig/reserve') }}" method="post">
        @csrf
        <div class="row row-cols-1 row-cols-md-2 mt-4">
            @foreach($bookings as $booking)
                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title">{{ jdfw($booking->booking_date) }} {{ $booking->meal->name }}</h4>
                            <p class="card-text">
                            @foreach($booking->foods as $food)
                                <h6 class="h6 font-weight-bold">{{ $food->name }}
                                    <span class="mx-2 text-muted">/ {{ $food->restaurant->name }}</span>
                                </h6>
                                <div class="row">
                                    <div class="col-8">
                                        <span class="badge badge-dark mx-1">{{ $food->price }} تومان </span>
                                    </div>
                                    <div class="col-4">
                                        @php
                                            $value = $booking->reservationsForUser()->where('food_id', $food->id)->first();
                                        @endphp
                                        <input type="number" class="form-control form-control-sm" name="booking[{{ $booking->id }}][ {{ $food->id }}]"
                                               min="0" max="3" value="{{ $value->quantity ?? 0 }}" >
                                    </div>
                                </div>
                                @endforeach
                                </p>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row m-0 mt-2">
                                <label for="quantity" class="col-sm-3 col-form-label">ساختمان</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="salon[{{ $booking->id }}]">
                                        <option value="1">---</option>
                                        @foreach($salons as $salon)
                                            <option value="{{ $salon->id }}"
                                                @if($booking->reservationsForUser()->first())
                                                @if($salon->id == $booking->reservationsForUser()->first()->salon_id)
                                                selected
                                                @endif
                                                @else
                                                @if($salon->id == auth()->user()->default_salon_id)
                                                selected
                                                @endif
                                                @endif
                                            >
                                                {{ $salon->name }}
                                            </option>
                                        @endforeach
                                    </select>
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

@push('js')
    <script src="{{ asset('js/input-spinner.js') }}"></script>
    <script>
        $("input[type='number']").inputSpinner()
    </script>
@endpush
