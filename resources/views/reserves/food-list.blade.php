@extends('master-dashboard')

@section('title', 'رزرو')

@section('inner-content')
    @foreach($foodByDay as $day => $foods)
    <div class="card mt-4">
        <div class="card-body">
            <h3 class="card-title">{{ jdfw($day) }}</h3>
            <p class="card-text">
            @foreach($foods as $key => $item)
            <div class="custom-control custom-radio">
                <input type="radio" id="{{ jdf($day). $key }}" name="{{ jdf($day) }}" class="custom-control-input">
                <label class="custom-control-label pb-3" for="{{ jdf($day). $key }}">
                    <span class="font-weight-bold">
                        {{ $item->food->name }}
                    </span>
                    <span class="px-2">/</span>
                    {{ $item->food->restaurant->name }}
                    @if($item->type_id == 1)
                        <span class="pl-2"> </span>
                        <span class="badge badge-pill badge-light text-dark">{{ $item->type->name }}</span>
                    @endif
                </label>
            </div>
            @endforeach
            </p>
        </div>
    </div>
    @endforeach
@endsection