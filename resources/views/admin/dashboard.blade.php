@extends('template.master-dashboard')

@section('title', 'ادمین')

@section('inner-content')
    <div class="card-columns">
        @if(allowed('reservation_view'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-food"></i>
                        ته‌دیگ
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/booking/day-list') }}" class="btn btn-block btn-primary">لیست روز</a>
                        <a href="{{ url('admin/booking/add') }}" class="btn btn-block btn-outline-primary">افزودن
                            روزغذا</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('food_view'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-food"></i>
                        مدیریت غذا
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/restaurant/add') }}" class="btn btn-block btn-outline-primary">افزودن
                            رستوران</a>
                        <a href="{{ url('admin/foods/add') }}" class="btn btn-block btn-outline-primary">افزودن غذا</a>
                        <a href="{{ url('admin/restaurants') }}" class="btn btn-block btn-outline-primary">لیست
                            رستوران</a>
                        <a href="{{ url('admin/foods') }}" class="btn btn-block btn-outline-primary">لیست غذا ها</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('billing_view'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-bank"></i>
                        مالی
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/users-bill') }}" class="btn btn-block btn-primary">حساب ماهیانه
                            کاربران</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('user_view'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-account-group"></i>
                        کارمندان
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/users') }}" class="btn btn-block btn-primary">لیست کاربران</a>
                        <a href="{{ url('admin/users/add') }}" class="btn btn-block btn-outline-primary">افزودن
                            کاربر</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('notice_view'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-bullhorn"></i>
                        اطلاعیه ها
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/notices') }}" class="btn btn-block btn-outline-primary">لیست اطلاعیه
                            ها</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('shelf_view'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-book-open-variant"></i>
                        کتابخونه
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/shelves') }}" class="btn btn-block btn-primary">لیست کتاب‌ها</a>
                        <a href="{{ url('admin/shelves/add') }}" class="btn btn-block btn-outline-primary">افزودن
                            کتاب</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('otagh_view'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-home-automation"></i>
                        رزرو اتاق
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/otagh/list') }}" class="btn btn-block btn-outline-primary">لیست رزرو
                            ها</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('welcome_management'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-message-bulleted"></i>
                        یادداشت‌های آنبوردینگ
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/welcome/notes') }}" class="btn btn-block btn-outline-primary">لیست
                            یادداشت‌ها</a>
                    </p>
                </div>
            </div>
        @endif
        @if(allowed('admin'))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-shield-account"></i>
                        ادمین
                    </h5>
                    <p class="card-text">
                        <a href="{{ url('admin/acl') }}" class="btn btn-block btn-outline-primary">مدیریت دسترسی</a>
                    </p>
                </div>
            </div>
        @endif
    </div>
@endsection
