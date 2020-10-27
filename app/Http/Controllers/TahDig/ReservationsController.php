<?php

namespace App\Http\Controllers\TahDig;

use App\Http\Controllers\Controller;
use App\Model\TahdigBooking;
use App\Model\TahdigReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function foodList()
    {
        $data['reserved'] = TahdigReservation::query()
            ->where('user_id', auth()->id())
            ->where('created_at', '>', Carbon::now()->subMonth()->startOfDay())
            ->get();

        $bookings = TahdigBooking::where('booking_date', '>',
            Carbon::now()->addDays(config('nahar.gap_day'))->startOfDay()->format('Y-m-d')
        );

        if (auth()->user()->is_inter) {
            $bookings->with(['foodsForInter.restaurant', 'meal']);
        } else {
            $bookings->with(['foods.restaurant', 'meal']);
        }

        $data['bookings'] = $bookings->orderBy('booking_date', 'asc')->get();

        return view('tahdig.food-list', $data);
    }

    public function foodListSubmit(Request $request)
    {
        $reserves = $request->except('_token');

        foreach ($reserves as $key => $foodId) {
            $bookingId = substr($key, 2);
            $booking = TahdigBooking::find($bookingId);

            if (is_null($booking)) {
                continue;
            }

            $food = $booking->foods()->where('foods.id', $foodId)->first();

            if (is_null($food)) {
                continue;
            }

            $reservation = TahdigReservation::query()
                ->firstOrNew(['user_id' => auth()->id(), 'booking_id' => $booking->id]);

            $reservation->food_id = $food->id;
            $reservation->price = $food->price;
            $reservation->price_default = 0;
            $reservation->save();
        }

        return redirect('tahdig/history');
    }

    public function history(Request $request)
    {
        $data = getMonthDays();

        $data['reservations'] = TahdigReservation::with(['food'])
            ->join('tahdig_bookings', 'tahdig_reservations.booking_id', '=', 'tahdig_bookings.id')
            ->where('user_id', auth()->id())
            ->whereBetween('tahdig_bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->orderBy('tahdig_bookings.booking_date', 'desc')
            ->get([
                DB::raw('tahdig_reservations.*'),
                'tahdig_bookings.booking_date',
            ]);

        $data['sum'] = $data['reservations']->sum(function ($reservation) {
            return $reservation->price - $reservation->price_default;
        });

        return view('tahdig.history', $data);
    }

    public function deleteReservation(TahdigReservation $reservation)
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
