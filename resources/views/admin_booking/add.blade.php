@extends('master-dashboard')

@section('title', 'افزودن غذا')

@section('inner-content')
    <div class="row">
        <div class="col-6 mx-auto">
            @include('messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/booking/add') }}">
                        @csrf
                        <div class="form-group">
                            <label>تاریخ</label>
                            <input type="text" class="form-control" name="date" placeholder="۱۳۹۹/۱۰/۱۲">
                        </div>
                        <div class="form-group">
                            <label>وعده</label>
                            <select class="form-control" name="meal">
                                <option value="">----</option>
                                @foreach($meals as $meal)
                                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>غذا اصلی</label>
                            <select class="form-control" name="food_main">
                                <option value="">----</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}
                                        - {{ $food->restaurant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>غذا دوم</label>
                            <select class="form-control" name="foods[]">
                                <option value="">----</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}
                                        - {{ $food->restaurant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>غذا سوم</label>
                            <select class="form-control" name="foods[]">
                                <option value="">----</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}
                                        - {{ $food->restaurant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection