<?php

namespace App\Http\Controllers;

use App\Model\Food;
use App\Model\Meal;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function add(Request $request)
    {
        $data['meals'] = Meal::all();
        $data['foods'] = Food::with(['restaurant'])->get();

        return view('admin_booking.add', $data);
    }

    public function addSubmit(Request $request)
    {


        dd(to_en($request->get('date')));
    }
}
