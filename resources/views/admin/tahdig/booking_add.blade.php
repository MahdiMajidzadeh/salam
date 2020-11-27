@extends('template.master-dashboard')

@section('title', 'افزودن غذا')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/booking/add') }}">
                        @csrf
                        <div class="form-group">
                            <label>تاریخ</label>
                            <input type="text" class="form-control" name="date" id="date">
                            <input type="hidden" class="form-control" name="date_alt" id="date_alt">
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
                            <label>غذا اول</label>
                            <select class="form-control food-list" name="food_1">
                                <option value="">----</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}
                                        - {{ $food->restaurant->name }} - {{ $food->price }}</option>
                                @endforeach
                            </select>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="food_inter_1" id="food-inter-1">
                                <label class="custom-control-label" for="food-inter-1">غذای کارآموزی</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>غذا دوم</label>
                            <select class="form-control food-list" name="food_2">
                                <option value="">----</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}
                                        - {{ $food->restaurant->name }} - {{ $food->price }}</option>
                                @endforeach
                            </select>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="food_inter_2" id="food-inter-2">
                                <label class="custom-control-label" for="food-inter-2">غذای کارآموزی</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>غذا سوم</label>
                            <select class="form-control food-list" name="food_3">
                                <option value="">----</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}
                                        - {{ $food->restaurant->name }} - {{ $food->price }}</option>
                                @endforeach
                            </select>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="food_inter_3" id="food-inter-3">
                                <label class="custom-control-label" for="food-inter-3">غذای کارآموزی</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>غذا چهارم</label>
                            <select class="form-control food-list" name="food_4">
                                <option value="">----</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}
                                        - {{ $food->restaurant->name }} - {{ $food->price }}</option>
                                @endforeach
                            </select>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="food_inter_4" id="food-inter-4">
                                <label class="custom-control-label" for="food-inter-4">غذای کارآموزی</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('css')
    <link href="{{ mix('css/persian-datepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush

@push('js')
    <script src="{{ mix('js/persian-date.min.js') }}"></script>
    <script src="{{ mix('js/persian-datepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#date").pDatepicker({
                altField: '#date_alt',
                altFormat: 'X'
            });

            $('.food-list').selectpicker({
                liveSearch: true
            });
        });
    </script>
@endpush