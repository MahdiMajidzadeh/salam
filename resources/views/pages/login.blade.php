@extends('template.master')

@section('title', 'ورود')

@section('css-box', 'login-bg')

@section('content')
    <div class="row justify-content-center align-items-center h100">
        <div class="col-12 col-md-4">
            <div class="text-white text-center">
                <h3 class="text-white">
                    باسلامیها
                </h3>
                <p class="text-white">پورتال اهالی باسلام</p>
            </div>
            @if (session('msg-error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('msg-error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <form action="{{ url('/login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>شماره همراه</label>
                                <input type="text" name="mobile" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>رمز عبور</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">ورود</button>
                        </form>
                    </div>
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection