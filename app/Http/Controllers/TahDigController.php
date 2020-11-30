<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\TahdigBooking;
use Illuminate\Http\Request;
use App\Model\TahdigReservation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TahDigController extends Controller
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

        return view('tahdig.day_list', $data);
    }

    public function foodListSubmit(Request $request)
    {
        $reserves = $request->except('_token');

        $reservations = [];
        foreach ($reserves as $key => $id) {
            [$bookingId, $type]              = explode('-', $key);
            $reservations[$bookingId][$type] = $id;
        }

        foreach ($reservations as $key => $reservationData) {
            if ($reservationData['q'] < 1 || ! isset($reservationData['f'])) {
                continue;
            }
            $booking = TahdigBooking::find($key);

            if (is_null($booking)) {
                continue;
            }

            $food = $booking->foods()->where('foods.id', $reservationData['f'])->first();

            if (is_null($food)) {
                continue;
            }

            $reservation = TahdigReservation::query()
                ->firstOrNew(['user_id' => auth()->id(), 'booking_id' => $booking->id]);

            $reservation->food_id       = $food->id;
            $reservation->price         = $food->price;
            $reservation->quantity      = $reservationData['q'];
            $reservation->price_default = 0;
            $reservation->save();
        }

        return redirect('tahdig/history');
    }

    public function history(Request $request)
    {
        $data['reservations'] = TahdigReservation::with([
            'booking',
            'booking.meal',
            'food.restaurant',
        ])
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->paginate(30);

        $totalCost = TahdigReservation::with(['booking'])->whereHas('booking', function ($query) {
            $query->where('booking_date', '>', auth()->user()->settlement_at);
        })->where('user_id', auth()->id())
            ->sum(DB::raw('price * quantity'));

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
