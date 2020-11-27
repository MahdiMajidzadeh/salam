@extends('template.master-dashboard')

@section('title', 'افزودن غذا')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/foods/add') }}">
                        @csrf
                        <div class="form-group">
                            <label>رستوران</label>
                            <select class="form-control" name="restaurant">
                                <option value="">----</option>
                                @foreach($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>اسم</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>قیمت</label>
                            <input type="number" class="form-control" name="price" placeholder="تومان">
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
