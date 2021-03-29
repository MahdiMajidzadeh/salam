<?php

namespace App\Http\Controllers;

use App\Model\Day;
use App\Model\Food;
use Carbon\Carbon;
use App\Model\TahdigSalon;
use App\Model\TahdigBooking;
use Illuminate\Http\Request;
use App\Model\TahdigReservation;
use Illuminate\Support\Facades\DB;

class TahDigController extends Controller
{
    public function foodList()
    {
        $data['bookings'] = TahdigBooking::with(['reservationsForUser', 'foods.restaurant', 'meal'])
            ->where('booking_date', '>',
                Carbon::now()->addDays(config('nahar.gap_day'))->startOfDay()->format('Y-m-d')
            )->orderBy('booking_date', 'asc')->get();

        $data['salons'] = TahdigSalon::where('is_active', true)->get();

        return view('tahdig.day_list', $data);
    }

    public function foodListSubmit(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data['booking'] as $booking_id => $booking) {
            foreach ($booking as $food_id => $quantity) {
                if ($quantity == 0) {
                    TahdigReservation::where('user_id', auth()->id())
                        ->where('booking_id', $booking_id)
                        ->where('food_id', $food_id)
                        ->delete();
                } else {
                    $food = Food::find($food_id);

                    TahdigReservation::updateOrCreate(
                        [
                            'user_id'    => auth()->id(),
                            'booking_id' => $booking_id,
                            'food_id'    => $food_id,
                        ],
                        [
                            'quantity'      => $quantity,
                            'price'         => $food->price,
                            'price_default' => 0,
                            'salon_id'      => $data['salon'][$booking_id],
                        ]
                    );
                }
            }
        }

        return redirect('tahdig/history');
    }

    public function history(Request $request)
    {
        $data['reservations'] = TahdigReservation::with([
            'booking',
            'booking.meal',
            'food.restaurant',
            'salon',
        ])
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->paginate(30);

        $totalCost = TahdigReservation::with(['booking'])->whereHas('booking', function($query) {
            $query->where('booking_date', '>', auth()->user()->settlement_at);
        })->where('user_id', auth()->id())
            ->sum(DB::raw('price * quantity'));
        $credits   = Day::where('day', '>=', auth()->user()->settlement_at)->sum('charge_amount');

        $data['sum'] = $credits - $totalCost;

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
