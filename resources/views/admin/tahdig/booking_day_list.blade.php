@extends('master-dashboard')

@section('title', 'لیست روز')

@section('inner-content')
    <div class="card d-print-none my-4">
        <div class="card-body">
            <form class="form-inline">
                <label>وعده: </label>
                <select class="custom-select" name="meal">
                    <option value="">---</option>
                    @foreach($meals as $meal)
                        <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                    @endforeach
                </select>
                <div class="form-group ml-3">
                    <label>تاریخ: </label>
                    <input type="text" class="form-control" id="date">
                    <input type="hidden" class="form-control" name="date_alt" id="date_alt">
                </div>

                <button type="submit" class="btn btn-primary ml-3">جستجو</button>
            </form>
        </div>
    </div>
    @if($hasData)
        <div class="card my-4">
            <div class="card-body p-3">
                @foreach($foods as $food)
                    {{ $food->first()->food->name }} : {{ $food->sum('quantity') }} <br>
                @endforeach
            </div>
        </div>
        <table class="table table-striped responsive" id="table">
            <thead>
            <tr>
                <th scope="col">پرسنلی</th>
                <th scope="col">اسم</th>
                <th scope="col">غذا</th>
                <th scope="col">رستوران</th>
                <th scope="col">دریافت</th>
            </tr>
            </thead>
            <tbody>
            @foreach($foods as $food)
                @php
                    $food = $food->sortBy('user.id')
                @endphp
                @foreach($food as $reservation)
                    <tr class="@if(!is_null($reservation->received_at)) text-black-50 line-through @endif">
                        <td>{{ $reservation->user->employment_id }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>
                            @if($reservation->quantity > 1)
                                ({{ $reservation->quantity }})
                            @endif
                            {{ $reservation->food->name }}
                        </td>
                        <td>{{ $reservation->food->restaurant->name }}</td>
                        <td>
                            <button class="btn btn-info received" data-id="{{ $reservation->id }}"
                                    @if(!is_null($reservation->received_at)) disabled @endif>
                                دریافت
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endforeach

            </tbody>
        </table>
    @endif
@endsection

@push('css')
    <link href="{{ mix('css/persian-datepicker.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ mix('js/persian-date.min.js') }}"></script>
    <script src="{{ mix('js/persian-datepicker.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#date").pDatepicker({
                altField: '#date_alt',
                altFormat: 'X'
            });
            $('#table').DataTable({
                paging:false,
                responsive: true
            });

            $('.received').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ url('admin/ajax/tahdig/received') }}/" + $(this).data('id')
                }).done(function() {

                });
                $(this).prop('disabled', true);
                $(this).parent().parent().addClass('text-black-50 line-through');
            })
        });
    </script>
@endpush
