<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Model\TahdigReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagDigController extends Controller
{
    public function receivedReservation(Request $request, $id)
    {
        $reservation = TahdigReservation::find($id);
        $reservation->update(['received_at' => Carbon::now()]);

        return true;
    }
}
