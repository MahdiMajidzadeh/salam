@extends('master-dashboard')

@section('title', 'افزودن کاربر دست جمعی')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/user/bulk') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" rows="10" name="users"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection