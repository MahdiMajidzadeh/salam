@extends('master-dashboard')

@section('title', 'ادمین')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body p-3">
            <a href="{{ url('dashboard/reserve') }}" class="btn btn-secondary">رزرو</a>
        </div>
    </div>
    @if(auth()->user()->role_id >= \App\Enum\Role::FOOD_MANAGER)
        <div class="card my-4">
            <div class="card-body p-3">
                <a href="{{ url('admin/restaurant/add') }}" class="btn btn-secondary">افزودن رستوران</a>
            </div>
        </div>
    @endif
    @if(auth()->user()->role_id >= \App\Enum\Role::USER_MANAGER)
    <div class="card my-4">
        <div class="card-body p-3">
            <a href="{{ url('admin/user/bulk') }}" class="btn btn-secondary">افزودن دست جمعی کاربر</a>
            <a href="{{ url('admin/user/add') }}" class="btn btn-secondary">افزودن کاربر</a>
        </div>
    </div>
    @endif
@endsection