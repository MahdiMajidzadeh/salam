@extends('master-dashboard')

@section('title', 'ویرایش غذا')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/foods/edit') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $food->id }}">
                        <div class="form-group">
                            <label>اسم</label>
                            <input type="text" class="form-control" value="{{ $food->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>رستوران</label>
                            <input type="text" class="form-control" value="{{ $food->restaurant->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>قیمت</label>
                            <input type="number" class="form-control" name="price" placeholder="تومان" value="{{ $food->price }}">
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
