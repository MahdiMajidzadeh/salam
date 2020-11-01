<?php

namespace App\Http\Controllers\Ajax;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\TahdigReservation;
use App\Http\Controllers\Controller;

class TagDigController extends Controller
{
    public function receivedReservation(Request $request, $id)
    {
        $reservation = TahdigReservation::find($id);
        $reservation->update(['received_at' => Carbon::now()]);

        return true;
    }
}
