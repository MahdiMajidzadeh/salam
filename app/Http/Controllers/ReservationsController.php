<?php

namespace App\Http\Controllers;

use App\Model\AvailableFood;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function foodList()
    {
        $availableFood = AvailableFood::with(['food','meal','type','food.restaurant'])->get();
        $data['foodByDay'] = $availableFood->groupBy('reserve_day');
//        dd($data);
        return view('reserves.food-list', $data);
    }
}
