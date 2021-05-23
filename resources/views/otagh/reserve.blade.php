@extends('template.master-dashboard')

@section('title', 'رزرو')

@section('inner-content')
    @include('template.messages')
    <div class="card d-print-none mb-4">
        <div class="card-body">
            <form class="form-inline">
                <label class="mb-2 mr-sm-2" for="room-list">اتاق: </label>
                <select class="custom-select mb-2 mr-sm-2" name="room" id="room-list">
                    <option value="">---</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary  mb-2 ml-sm-2">انتخاب</button>
            </form>
        </div>
    </div>
    @if($show)
        <div class="row">
            <div class="col-12">
                <h4 class="font-weight-bold mb-3">اتاق {{ $roomCurrent->name }}</h4>
            </div>
            <div class="col-md-12">
                <div class="dayview-container">
                    @include('otagh.template.dayview_hour')
                    <div class="dayview-grid-container">
                        <div class="dayview-grid">
                            @include('otagh.template.dayview_tiles')
                            <div class="dayview-now-marker"></div>
                            <div class="dayview-grid-marker-start"></div>
                            @forelse($reservations as $reservationDays)
                            <div class="dayview-gridcell-container">
                                <div class="dayview-gridcell">
                                    @forelse($reservationDays as $reservation)
                                        @php
                                            $start = (
                                            (\Morilog\Jalali\Jalalian::fromDateTime($reservation->started_at)->getHour() - 8)*60  +
                                             \Morilog\Jalali\Jalalian::fromDateTime($reservation->started_at)->getMinute()
                                              ) / 15 + 1;

                                            $end = ceil((
                                            (\Morilog\Jalali\Jalalian::fromDateTime($reservation->ended_at)->getHour() - 8)*60  +
                                             \Morilog\Jalali\Jalalian::fromDateTime($reservation->ended_at)->getMinute()
                                              ) / 15 + 1);

                                        @endphp
                                        <div class="dayview-cell border-info @if($reservation->user_id == auth()->id()) bg-info text-white @endif" style="grid-row: {{ $start }} / {{ $end }};"
                                             data-toggle="tooltip" data-placement="top" title="{{ jdf_format($reservation->started_at, '%A: %d %B %y %H:%M') }} - {{ jdf_format($reservation->ended_at, '%H:%M') }}">
                                            <div class="dayview-cell-title">
                                                {{ $reservation->user->name }}
                                            </div>
                                            {{--<div class="dayview-cell-desc">Description</div>--}}
                                        </div>
                                        @endforeach
                                </div>
                            </div>
                            @endforeach
                            <div class="dayview-grid-marker-end"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card d-print-none mb-4">
                    <div class="card-body">
                        <form action="{{ url('otagh/reserve') }}" method="post">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $roomCurrent->id }}">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>روز: </label>
                                        <input type="text" class="form-control" id="date_day">
                                        <input type="hidden" class="form-control" name="date_day_alt"
                                               id="date_day_alt">
                                    </div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <div class="form-group">
                                        <label>ساعت شروع:</label>
                                        <select class="custom-select" name="date_start_hour">
                                            @foreach($hours as $hour)
                                                <option value="{{ $hour }}">{{ $hour }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <div class="form-group">
                                        <label> دقیقه: </label>
                                        <select class="custom-select" name="date_start_minute">
                                            @foreach($minutes as $minute)
                                                <option value="{{ $minute }}">{{ $minute }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <div class="form-group">
                                        <label>ساعت پایان:</label>
                                        <select class="custom-select" name="date_end_hour">
                                            @foreach($hours as $hour)
                                                <option value="{{ $hour }}">{{ $hour }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <div class="form-group">
                                        <label> دقیقه: </label>
                                        <select class="custom-select" name="date_end_minute">
                                            @foreach($minutes as $minute)
                                                <option value="{{ $minute }}">{{ $minute }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">یادداشت (امکانات و پذیرایی)</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary my-1">رزرو</button>
                        </form>
                    </div>
                </div>
            </div>
    @endif
@endsection

@push('css')
    <link href="{{ mix('css/persian-datepicker.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ mix('js/persian-date.min.js') }}"></script>
    <script src="{{ mix('js/persian-datepicker.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const d = new Date();
            if(d.getHours() < 8 || d.getHours()> 20){
               // $('.dayview-now-marker').hide();
            }
            document.querySelector(".dayview-now-marker").style.top =
                (document
                        .querySelector(".dayview-gridcell-container")
                        .getBoundingClientRect().height /
                    24) *
                (d.getHours() + 8 + d.getMinutes() / 60) +
                "px";
        });

        $(document).ready(function () {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
            $("#date_day").pDatepicker({
                altField: '#date_day_alt',
                altFormat: 'X',
                autoClose: true,
                format: 'D MMMM YYYY',
                toolbox: {
                    calendarSwitch: {
                        enabled: false
                    }
                }
            });
        });
    </script>
@endpush
