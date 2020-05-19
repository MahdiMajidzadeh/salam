@extends('master-dashboard')

@section('title', 'رزرو')

@section('inner-content')
    <form action="{{ url('/dashboard/reserve') }}" method="post">
        @csrf
        @foreach($foodByDay as $day => $foods)
            <div class="card my-3">
                <div class="card-body">
                    <h3 class="card-title">{{ jdfw($day) }}</h3>
                    <p class="card-text">
                    @foreach($foods as $key => $item)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{ jdf($day). $key }}" name="{{ jdf($day) }}" value="{{ $item->id }}"
                                   class="custom-control-input">
                            <label class="custom-control-label pb-3" for="{{ jdf($day). $key }}">
                                <span class="h6 font-weight-bold">{{ $item->food->name }}</span>
                                <span class="badge badge-dark mx-1">{{ $item->food->price }} تومان </span>
                                <span class="mx-2">/</span>
                                {{ $item->food->restaurant->name }}
                                @if($item->type_id == 1)
                                    <span class="pl-2"> </span>
                                    <span class="badge badge-pill badge-light text-dark">{{ $item->type->name }}</span>
                                @else
                                    <span class="pl-2"> </span>
                                    <span class="badge badge-pill badge-light text-dark ltr">{{ sprintf("%+d", ($item->food->price - $foods->where('type_id', 1)[0]->food->price)) }}</span>
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