@extends('master')

@section('title', 'ورود')


@section('content')
    <div class="center-box">
        <div class="card">
            <div class="card-body">
                @if (session('msg-error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('msg-error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ url('/') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>شماره همراه</label>
                        <input type="text" name="mobile" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>رمز عبور</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">ورود</button>
                </form>
            </div>
        </div>
    </div>
@endsection