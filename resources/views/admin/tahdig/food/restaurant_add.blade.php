@extends('master-dashboard')

@section('title', 'افزودن رستوران')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/restaurant/add') }}">
                        @csrf
                        <div class="form-group">
                            <label>اسم</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection