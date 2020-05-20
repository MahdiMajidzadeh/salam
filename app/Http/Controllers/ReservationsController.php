<?php

namespace App\Http\Controllers;

use App\Model\Booking;
use App\Model\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function foodList()
    {
        $data['bookings'] = Booking::with(['foods','defaultFood', 'meal'])
            ->where('booking_date', '>', Carbon::now()->subDays(2)->startOfDay())
            ->get();

//        dd($data);
        return view('reserves.food-list', $data);
    }

    public function foodListSubmit(Request $request)
    {
        $reserves = $request->except('_token');

//        foreach ($reserves as $reserve) {
//            $available                 = AvailableFood::find($reserve);
//            $reservation               = new Reservation();
//            $reservation->user_id      = auth()->id();
//            $reservation->food_id      = $available->food_id;
//            $reservation->meal_id      = $available->meal_id;
//            $reservation->available_id = $available->id;
//            $reservation->reserve_day  = $available->reserve_day;
//            $reservation->price        = $available->food->price;
//
//            if ($available->type_id == 1) {
//                $reservation->default_price = $available->food->price;
//            } else {
//                $default                    = AvailableFood::where('meal_id', $available->meal_id)
//                    ->where('reserve_day', $available->reserve_day)
//                    ->where('type_id', 1)
//                    ->first();
//                $reservation->default_price = $default->food->price;
//            }
//            $reservation->save();
//        }

        return redirect('dashboard');
    }
}
