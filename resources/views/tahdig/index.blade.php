@extends('master-dashboard')

@section('title', 'ته دیگ')

@section('inner-content')

    <div class="row">
        <div class="col-md-3 order-2 order-md-1">
            <a href="{{ url('tahdig') }}">
                <div class="card overflow-hidden my-4">
                    <div class="card-img">
                        <img src="{{ asset('img/tahdig.jpg') }}" class="img-fluid">
                        <div class="card-img-overlay d-flex">
                            <h4 class="card-title align-self-center mx-auto m-0">ته دیگ</h4>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="card overflow-hidden my-4">
                    <div class="card-img">
                        <img src="{{ asset('img/otagh.jpg') }}" class="img-fluid">
                        <div class="card-img-overlay d-flex">
                            <h4 class="card-title align-self-center mx-auto m-0">اتاق (به زودی)</h4>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="card overflow-hidden my-4">
                    <div class="card-img">
                        <img src="{{ asset('img/ghafase.jpg') }}" class="img-fluid">
                        <div class="card-img-overlay d-flex">
                            <h4 class="card-title align-self-center mx-auto m-0">قفسه (به زودی)</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-9 order-1 order-md-2">
            <div class="card my-4">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ url('tahdig/reserve') }}" class="btn btn-secondary">رزرو</a>
                            <a href="{{ url('tahdig/history') }}" class="btn btn-secondary">تاریخچه</a>
                        </div>
                    </div>
                </div>
            </div>
            @isset($todayReserved)
                <div class="bg-info card text-white my-4">
                    <div class="card-body">
                        <h4 class="text-white m-0">
                            غذای امروز : <span class="font-weight-bold">
                        {{$todayReserved->food->name}} ({{$todayReserved->food->restaurant->name}})
                    </span>
                        </h4>
                    </div>
                </div>
            @endisset
            <div class="card my-4">
                <div class="card-body p-3">
                    در سامانه‌ی «ته‌دیگ» می‌توانید غذای هفتگی خود را از منوی متنوع خانگی و رستوران انتخاب نمائید.
                    <br>
                    هزینه‌ی غذای خانگی بعنوان هزینه پایه در نظر گرفته شده و توسط باسلام پرداخت می‌شود. اما درصورتی که مایل باشید
                    از غذای رستوران استفاده کنید، مابه‌التفاوت موارد انتخابی، در انتهای ماه بصورت خودکار از حقوق شما کسر خواهد
                    شد.
                    <br>
                    برای ثبت و یا ویرایش غذای مورد نظر، نهایتا تا سه روز پیش از آن وعده فرصت خواهید داشت.
                    <br>
                    لطفا توجه داشته باشید که عدم ثبت وعده‌ها در سامانه ته‌دیگ، به منزله «انصراف» از سفارش و دریافت غذا خواهد
                    بود.
                </div>
            </div>
        </div>
    </div>
@endsection
