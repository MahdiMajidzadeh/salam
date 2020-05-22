<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Booking;
use App\Model\Reservation;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }
}
