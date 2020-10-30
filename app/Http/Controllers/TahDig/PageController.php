<?php

namespace App\Http\Controllers\TahDig;

use App\Model\TahdigBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $data    = [];
        $booking = TahdigBooking::query()
            ->where('booking_date', now()->toDateString())
            ->first();

        if ($booking !== null) {
            $data['todayReserved'] = $booking->reservations()
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('tahdig.index', $data);
    }
}
