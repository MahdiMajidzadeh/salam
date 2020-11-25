@extends('master-dashboard')

@section('title', 'تاریخچه')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-12 col-md-6 my-auto">
                    تراز حساب:
                    <span style="font-weight: bold;">{{ number_format($sum,0,".",",") }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">تاریخ</th>
            <th scope="col">وعده</th>
            <th scope="col">غذا</th>
            <th scope="col">تعداد</th>
            <th scope="col">رستوران</th>
            <th scope="col">قیمت</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>{{ jdfw($reservation->booking->booking_date) }}</td>
                <td>{{ $reservation->booking->meal->name }}</td>
                <td>{{ $reservation->food->name }}</td>
                <td>{{ $reservation->quantity }}</td>
                <td>{{ $reservation->food->restaurant->name }}</td>
                <td>{{ $reservation->price }}</td>
                <td>
                    @if($reservation->booking->booking_date > now()->addDays(config('nahar.gap_day'))->startOfDay())
                        <a href="{{ url('/tahdig/reserve/delete/'.$reservation->id)}}" class="btn-danger btn btn-sm">
                            حذف
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {{ $reservations->links() }}
    </div>
@endsection
