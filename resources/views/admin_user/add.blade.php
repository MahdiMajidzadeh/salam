@extends('master-dashboard')

@section('title', 'افزودن کاربر')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/user/add') }}">
                        @csrf
                        <div class="form-group">
                            <label>اسم</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>موبایل</label>
                            <input type="text" class="form-control" name="mobile">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_inter"
                                       id="is_inter">
                                <label class="custom-control-label" for="is_inter">کارآموز</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
