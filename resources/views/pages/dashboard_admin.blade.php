@extends('master-dashboard')

@section('title', 'ادمین')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body p-3">
            <a href="{{ url('dashboard/reserve') }}" class="btn btn-secondary">رزرو</a>
        </div>
    </div>
@endsection