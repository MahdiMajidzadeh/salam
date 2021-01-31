@extends('template.master-dashboard')

@section('title', 'ادمین')

@section('inner-content')
    @if(allowed('reservation_view'))
        <div class="card my-4">
            <div class="card-body p-3">
                <a href="{{ url('admin/booking/day-list') }}" class="btn btn-secondary">لیست روز</a>
                <a href="{{ url('admin/booking/add') }}" class="btn btn-secondary">افزودن روزغذا</a>
            </div>
        </div>
        @endif
        @if(allowed('food_view'))
        <div class="card my-4">
            <div class="card-body p-3">
                <a href="{{ url('admin/restaurant/add') }}" class="btn btn-secondary">افزودن رستوران</a>
                <a href="{{ url('admin/foods/add') }}" class="btn btn-secondary">افزودن غذا</a>
                <a href="{{ url('notice') }}" class="btn btn-secondary">لیست رستوران</a>
                <a href="{{ url('admin/foods') }}" class="btn btn-secondary">لیست غذا ها</a>
            </div>
        </div>
    @endif
    @if(allowed('billing_view'))
        <div class="card my-4">
            <div class="card-body p-3">
                <a href="{{ url('admin/users-bill') }}" class="btn btn-secondary">حساب ماهیانه کاربران</a>
                <a href="{{ url('admin/restaurants-bill') }}" class="btn btn-secondary">حساب ماهیانه رستوران ها</a>
            </div>
        </div>
    @endif
    @if(allowed('user_view'))
    <div class="card my-4">
        <div class="card-body p-3">
            {{--<a href="{{ url('admin/user/bulk') }}" class="btn btn-secondary">افزودن دست جمعی کاربر</a>--}}
            <a href="{{ url('admin/users/add') }}" class="btn btn-secondary">افزودن کاربر</a>
            <a href="{{ url('admin/users') }}" class="btn btn-secondary">لیست کاربران</a>
        </div>
    </div>
    @endif
    @if(allowed('notice_view'))
        <div class="card my-4">
            <div class="card-body p-3">
                <a href="{{ url('notice') }}" class="btn btn-secondary">لیست اطلاعیه ها</a>
            </div>
        </div>
    @endif
    @if(allowed('otagh_view'))
        <div class="card my-4">
            <div class="card-body p-3">
                <a href="{{ url('admin/otagh/list') }}" class="btn btn-secondary">لیست رزرو ها</a>
            </div>
        </div>
    @endif
    @if(allowed('admin'))
        <div class="card my-4">
            <div class="card-body p-3">
                <a href="{{ url('admin/acl') }}" class="btn btn-secondary">مدیریت دسترسی</a>
            </div>
        </div>
    @endif
@endsection
