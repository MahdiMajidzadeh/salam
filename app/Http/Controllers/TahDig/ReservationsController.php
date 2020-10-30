<?php

namespace App\Http\Controllers\TahDig;

use App\Http\Controllers\Controller;
use App\Model\TahdigBooking;
use App\Model\TahdigReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function foodList()
    {
        $data['reserved'] = TahdigReservation::query()
            ->where('user_id', auth()->id())
            ->whereHas('booking', function ($query) {
                $query->where('booking_date', '>', Carbon::now()->subDays(14));
            })
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

        $data['reservations'] = TahdigReservation::with(['booking.meal', 'food.restaurant'])
            ->where('user_id', auth()->id())
            ->whereHas('booking', function ($query) use ($data) {
                $query->whereBetween('booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']]);
            })
            ->get()
            ->sortByDesc('booking.booking_date');

        $totalCost = TahdigReservation::with(['booking'])->whereHas('booking', function ($query) {
            $query->where('booking_date', '>', auth()->user()->settlement_at);
        })->where('user_id', auth()->id())
            ->sum('price');

        $data['sum'] = auth()->user()->tahdig_credits - $totalCost;

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
