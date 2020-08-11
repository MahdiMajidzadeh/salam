<?php

namespace App\Http\Controllers;

use App\Model\Booking;
use App\Model\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function foodList()
    {
        $data['reserved'] = Reservation::query()
            ->where('user_id', auth()->id())
            ->where('created_at', '>', Carbon::now()->subMonth()->startOfDay())
            ->get();

        $data['bookings'] = Booking::with(['foods.restaurant', 'defaultFood', 'meal'])
            ->where('booking_date', '>', Carbon::now()->addDays(config('nahar.gap_day'))->startOfDay()->format('Y-m-d'))
            ->orderBy('booking_date', 'asc')
            ->get();

        return view('reserves.food-list', $data);
    }

    public function foodListSubmit(Request $request)
    {
        $reserves = $request->except('_token');

        foreach ($reserves as $key => $foodId) {
            $bookingId = substr($key, 2);
            $booking = Booking::find($bookingId);

            if (is_null($booking)) {
                continue;
            }

            $food = $booking->foods()->where('foods.id', $foodId)->first();

            if (is_null($food)) {
                continue;
            }

            $reservation = Reservation::query()
                ->firstOrNew(['user_id' => auth()->id(), 'booking_id' => $booking->id]);

            $reservation->food_id = $food->id;
            $reservation->price = $food->price;
            $reservation->price_default = $booking->defaultFood->price;
            $reservation->save();
        }

        return redirect('dashboard');
    }

    public function history(Request $request)
    {
        $data = getMonthDays();

        $data['reservations'] = Reservation::with(['food'])
            ->join('bookings', 'reservations.booking_id', '=', 'bookings.id')
            ->where('user_id', auth()->id())
            ->whereBetween('bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->orderBy('bookings.booking_date', 'desc')
            ->get([
                DB::raw('reservations.*'),
                'bookings.booking_date',
            ]);

        $data['sum'] = $data['reservations']->sum(function ($reservation) {
            return $reservation->price - $reservation->price_default;
        });

        return view('reserves.history', $data);
    }

    /**
     * @param Reservation $reservation
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteReservation(Reservation $reservation)
    {
        if (
            (auth()->id() === $reservation->user_id)
            &&
            ($reservation->booking->booking_date > now()->addDays(config('nahar.gap_day'))->startOfDay())
        ) {
            $reservation->delete();
        }

        return back();
    }
}
