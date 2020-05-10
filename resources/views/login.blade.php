@extends('master')

@section('title', 'ورود')


@section('content')
    <div class="center-box">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>شماره همراه</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>رمز عبور</label>
                        <input type="password" class="form-control" >
                    </div>
                    <button type="submit" class="btn btn-primary">ورود</button>
                </form>
            </div>
        </div>
    </div>
@endsection