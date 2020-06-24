@extends('master-dashboard')

@section('title', 'حساب ماهیانه کاربران')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body p-3">
            <div class="row">
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
                <div class="col-12 col-md-6">
                    {{ $sum }}
                </div>
            </div>

        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">نام</th>
            <th scope="col">جمع حساب</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usersBill as $userBill)
            <tr>
                <td>{{$userBill->first()->user->id}}</td>
                <td>{{ $userBill->first()->user->name }}</td>
                <td dir="ltr">
                    {{ $userBill->sum(function ($reservation) {return $reservation->price - $reservation->price_default;})}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
