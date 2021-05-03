@extends('template.master-dashboard')

@section('title', 'حساب ماهیانه رستوران ها')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body p-3">
            <form class="form-inline">
                <div class="form-group ml-3">
                    <label>ماه: </label>
                    <select class="custom-select form-control-sm" name="month">

                    </select>
                </div>
                <div class="form-group ml-3">
                    <label>سال: </label>
                    <select class="custom-select form-control-sm" name="year">

                    </select>
                </div>
                <button type="submit" class="btn btn-primary ml-3 btn-sm">فیلتر کن</button>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">رستوران</th>
            <th scope="col">جمع حساب</th>
        </tr>
        </thead>
        <tbody>
        @foreach($restaurantsBill as $restaurantBill)
            <tr>
                <td>{{$restaurantBill->first()->food->restaurant->name}}</td>
                <td dir="ltr">
                    {{ $restaurantBill->sum(function ($reservation) {return $reservation->price;})}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
