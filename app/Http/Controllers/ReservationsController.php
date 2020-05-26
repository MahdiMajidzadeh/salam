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
        $data['reserved'] = Reservation::query()
            ->where('user_id', auth()->id())
            ->where('created_at', '>', Carbon::now()->subWeek()->startOfDay())
            ->get();

        $data['bookings'] = Booking::with(['foods.restaurant', 'defaultFood', 'meal'])
            ->where('booking_date', '>', Carbon::now()->subDays(2)->startOfDay())
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

            $reservation = Reservation::query()
                ->firstOrNew(['user_id' => auth()->id(), 'booking_id' => $booking->id]);

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
        }])->where('user_id', auth()->id())
            ->get();

        return view('reserves.history', $data);
    }

    /**
     * @param Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteReservation(Reservation $reservation)
    {
        $reservation->delete();

        return back();
    }
}
