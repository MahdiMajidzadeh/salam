@extends('template.master-dashboard')

@section('title', 'حساب ماهیانه کاربران')

@section('inner-content')
    {{--<div class="card my-4">--}}
        {{--<div class="card-body p-3 row">--}}
            {{--<div class="col-9">--}}
            {{--</div>--}}
            {{--<div class="col-3">--}}
                {{--<a href="{{ url('/admin/users-bill-export?'. http_build_query(request()->all())) }}"--}}
                   {{--class="btn btn-primary btn-sm">اکسل</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">پرسنلی</th>
            <th scope="col">نام</th>
            <th scope="col">جمع حساب</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usersBill as $userBill)
            <tr class="@if(!is_null($userBill->deactivated_at)) text-muted @endif">
                <td>{{$userBill->employment_id}}</td>
                <td>{{ $userBill->name }}</td>
                <td dir="ltr">
                    {{ number_format($userBill->balance,0,".",",") }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
