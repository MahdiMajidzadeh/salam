@extends('master-dashboard')

@section('title', 'لیست روز')

@section('inner-content')
    <div class="card  d-print-none">
        <div class="card-body">
            <form class="form-inline">
                <label>وعده: </label>
                <select class="custom-select" name="meal">
                    <option value="">---</option>
                    @foreach($meals as $meal)
                        <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                    @endforeach
                </select>
                <div class="form-group ml-3">
                    <label>تاریخ: </label>
                    <input type="text" class="form-control" id="date">
                    <input type="hidden" class="form-control" name="date_alt" id="date_alt">
                </div>

                <button type="submit" class="btn btn-primary ml-3">جستجو</button>
            </form>
        </div>
    </div>
    @if($hasData)
        <div class="card my-4">
            <div class="card-body p-3">
                @foreach($foods as $food)
                    {{ $food->first()->food->name }} : {{ $food->count() }} <br>
                @endforeach
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">اسم</th>
                <th scope="col">غذا</th>
                <th scope="col">رستوران</th>
            </tr>
            </thead>
            <tbody>
            @foreach($foods as $food)
                @php
                    $food = $food->sortBy('user.id')
                @endphp
                @foreach($food as $reservation)
                    <tr>
                        <td>{{ $reservation->user->id }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->food->name }}</td>
                        <td>{{ $reservation->food->restaurant->name }}</td>
                    </tr>
                @endforeach
            @endforeach

            </tbody>
        </table>
    @endif
@endsection

@push('css')
    <link href="{{ mix('css/persian-datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ mix('js/persian-date.min.js') }}"></script>
    <script src="{{ mix('js/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#date").pDatepicker({
                altField: '#date_alt',
                altFormat: 'X'
            });
        });
    </script>
@endpush
