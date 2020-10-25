@extends('master-dashboard')

@section('title', 'تاریخچه')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-12 col-md-6 my-auto">
                    جمع ما به التفاوت این ماه:
                    <span style="font-weight: bold;">{{ $sum }}</span>
                </div>
                <div class="col-12 col-md-6">
                    <form class="form-inline">
                        <div class="form-group ml-3">
                            <label>ماه: </label>
                            <select class="custom-select form-control-sm" name="month">
                                @foreach(jMonths() as $monthNumber=>$monthName)
                                    <option value="{{ $monthNumber }}" {{$monthNumber == $month ? 'selected' : '' }}>
                                        {{ $monthName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ml-3">
                            <label>سال: </label>
                            <select class="custom-select form-control-sm" name="year">
                                @foreach(range(1399,1450) as $yearNumber)
                                    <option value="{{$yearNumber}}" {{$yearNumber==$year ?'selected':''}}>
                                        {{ $yearNumber }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3 btn-sm">فیلتر کن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">تاریخ</th>
            <th scope="col">وعده</th>
            <th scope="col">غذا</th>
            <th scope="col">رستوران</th>
            <th scope="col">قیمت</th>
            <th scope="col">ما به التفاوت</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ jdfw($reservation->booking->booking_date) }}</td>
                <td>{{ $reservation->booking->meal->name }}</td>
                <td>{{ $reservation->food->name }}</td>
                <td>{{ $reservation->food->restaurant->name }}</td>
                <td>{{ $reservation->price }}</td>
                <td style="direction: ltr">{{ sprintf("%+d",$reservation->price - $reservation->price_default) }}</td>
                <td>
                    @if($reservation->booking->booking_date > now()->addDays(config('nahar.gap_day'))->startOfDay())
                        <a href="{{ url('/dashboard/reserve/delete/'.$reservation->id)}}" class="btn-danger btn btn-sm">
                            حذف
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
