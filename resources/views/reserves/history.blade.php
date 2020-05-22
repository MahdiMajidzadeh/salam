@extends('master-dashboard')

@section('title', 'تاریخچه')

@section('inner-content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">تاریخ</th>
            <th scope="col">وعده</th>
            <th scope="col">غذا</th>
            <th scope="col">رستوران</th>
            <th scope="col">قیمت</th>
            <th scope="col">ما به التفاوت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>{{ jdfw($reservation->booking->booking_date) }}</td>
                <td>{{ $reservation->booking->meal->name }}</td>
                <td>{{ $reservation->food->name }}</td>
                <td>{{ $reservation->food->restaurant->name }}</td>
                <td>{{ $reservation->price }}</td>
                <td style="direction: ltr">{{ sprintf("%+d",$reservation->price - $reservation->price_default) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection