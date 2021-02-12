@extends('template.master-dashboard')

@section('title', 'تنظیمات ته دیگ')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <nav class="nav">
                <a class="nav-link" href="{{ url('/setting/') }} ">کاربر</a>
                <a class="nav-link btn btn-secondary" href="{{ url('/setting/tahdig') }} ">ته دیگ</a>
                <a class="nav-link" href="{{ url('/setting/password-reset') }}">تغیر رمز</a>
            </nav>
        </div>
        <div class="col-12 col-md-6 offset-md-3">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('setting/tahdig') }}">
                        @csrf
                        <div class="form-group">
                            <label>سالن پیشفرض</label>
                            <select class="form-control" name="salon">
                                <option>--</option>
                                @foreach($salons as $salon)
                                    <option value="{{ $salon->id }}"
                                            @if(auth()->user()->default_salon_id == $salon->id) selected @endif
                                    >{{ $salon->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">تغییر</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection