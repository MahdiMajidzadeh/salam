<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Booking;
use App\Model\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function foodList()
    {
        $oldReservation = Reservation::with(['booking'])
            ->where('user_id', auth()->id())
            ->get()
            ->pluck('booking_id');

        $data['bookings'] = Booking::with(['foods.restaurant', 'defaultFood', 'meal'])
            ->where('booking_date', '>', Carbon::now()->addDays(config('nahar.gap_day'))->startOfDay()->format('Y-m-d'))
            ->whereNotIn('id', $oldReservation)
            ->get();

        return view('reserves.food-list', $data);
    }

    public function foodListSubmit(Request $request)
    {
        $reserves = $request->except('_token');

        foreach ($reserves as $key => $foodId) {
            $bookingId = substr($key, 2);
            $booking   = Booking::find($bookingId);

            if (is_null($booking)) {
                continue;
            }

            $food = $booking->foods()->where('foods.id', $foodId)->first();

            if (is_null($food)) {
                continue;
            }

            $reservation                = new Reservation();
            $reservation->user_id       = auth()->id();
            $reservation->booking_id    = $booking->id;
            $reservation->food_id       = $food->id;
            $reservation->price         = $food->price;
            $reservation->price_default = $booking->defaultFood->price;
            $reservation->save();
        }

        return redirect('dashboard');
    }

    public function history(Request $request)
    {
        $data['reservations'] = Reservation::with(['food', 'booking' => function($q) {
            $q->orderBy('booking_date', 'desc');
        }])
            ->where('user_id', auth()->id())
            ->get();

        return view('reserves.history', $data);
    }
}
