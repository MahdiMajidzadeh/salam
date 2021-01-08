<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Room;
use Illuminate\Http\Request;
use App\Model\RoomReservation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OtaghController extends Controller
{
    public function reserve(Request $request)
    {
        $data['rooms']   = Room::where('is_active', true)->get();
        $data['hours']   = range(8, 19);
        $data['minutes'] = [0, 15, 30, 45];

        if (! $request->has('room')) {
            $data['show'] = false;

            return view('otagh.reserve', $data);
        }

        $data['show']         = true;
        $data['roomCurrent']  = Room::findOrFail($request->get('room'));
        $data['reservations'] = RoomReservation::with('user')
            ->where('room_id', $request->get('room'))
            ->where('ended_at', '>', Carbon::now())
            ->take(10)
            ->get();

        return view('otagh.reserve', $data);
    }

    public function reserveSubmit(Request $request)
    {
        $data = [
            'start_date' => $this->makeDate(
                $request->get('date_start_alt'),
                $request->get('date_start_hour'),
                $request->get('date_start_minute')
            ),
            'end_date'   => $this->makeDate(
                $request->get('date_end_alt'),
                $request->get('date_end_hour'),
                $request->get('date_end_minute') - 1
            ),
        ];
        $data = array_merge($data, $request->toArray());

        Validator::make($data, [
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after:start_date',
            'date_start_hour'   => ['required', Rule::in(range(8, 19))],
            'date_start_minute' => ['required', Rule::in([0, 15, 30, 45])],
            'date_end_hour'     => ['required', Rule::in(range(8, 19))],
            'date_end_minute'   => ['required', Rule::in([0, 15, 30, 45])],
            'room_id'           => 'required|exists:rooms,id',
        ])->validate();

        if ($this->isReserved($data['start_date'], $data['end_date'], $data['room_id']) > 0) {
            return redirect()->back()->with('msg-error', __('msg.room_reserved'));
        }

        if ($data['end_date']->diffInHours($data['start_date']) > 12) {
            return redirect()->back()->with('msg-error', __('msg.reserved_to_long'));
        }

        $roomReservation             = new RoomReservation();
        $roomReservation->room_id    = $request->get('room_id');
        $roomReservation->user_id    = auth()->id();
        $roomReservation->started_at = $data['start_date'];
        $roomReservation->ended_at   = $data['end_date'];
        $roomReservation->note       = $request->get('note');
        $roomReservation->save();

        return redirect('otagh/reserve?room='.$request->get('room_id'));
    }

    private function makeDate($date, $hour, $minute)
    {
        $newDate         = Carbon::createFromTimestamp($date);
        $newDate->hour   = $hour;
        $newDate->minute = $minute;
        $newDate->second = 0;

        return $newDate;
    }

    private function isReserved($start, $end, $roomId)
    {
        return RoomReservation::where(function ($query) use ($start, $end) {
            $query->where(function ($query) use ($start) {
                $query->where('started_at', '>=', $start)
                    ->where('ended_at', '<', $start);
            })
                ->orWhere(function ($query) use ($end) {
                    $query->where('started_at', '<', $end)
                        ->where('ended_at', '>=', $end);
                });
        })->where('room_id', $roomId)
            ->count();
    }
}
