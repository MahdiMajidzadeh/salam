<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\RoomReservation;
use App\Http\Controllers\Controller;

class OtaghController extends Controller
{
    public function check(Request $request)
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

        return view('admin.otagh.list', $data);
    }
}
