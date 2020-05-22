@extends('master-dashboard')

@section('title', 'تغییر رمز')

@section('inner-content')
    <div class="row">
        <div class="col-6 mx-auto">
            @include('messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('dashboard/password-reset') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">رمز عبور</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password_old">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">رمز جدید</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password_new">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">تکرار رمز</label>
                            <input type="password" class="form-control" id="exampleInputPassword3"
                                   name="password_double_new">
                        </div>
                        <button type="submit" class="btn btn-primary">تغییر</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection