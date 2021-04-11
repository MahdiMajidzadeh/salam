<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use App\Models\Meal;
use App\Models\TahdigSalon;
use App\Models\TahdigBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class FoodBookingController extends Controller
{
    public function add(Request $request)
    {
        is_allowed('reservation_management');

        $data['meals'] = Meal::all();
        $data['foods'] = Food::with(['restaurant'])->get();

        return view('admin.tahdig.booking_add', $data);
    }

    public function addSubmit(Request $request)
    {
        is_allowed('reservation_management');

        $request->validate([
            'meal'    => 'required|exists:meals,id',
            'foods'   => 'array',
            'foods.*' => 'nullable|distinct|exists:foods,id|different:food_main',
        ]);

        $booking                  = new TahdigBooking();
        $booking->booking_date    = Carbon::createFromTimestamp($request->get('date_alt'))->toDateString();
        $booking->meal_id         = $request->get('meal');
        $booking->default_food_id = 0;
        $booking->save();

        $booking->foods()->attach($request->get('food_1'), ['for_inter' => $request->has('food_inter_1')]);
        $booking->foods()->attach($request->get('food_2'), ['for_inter' => $request->has('food_inter_2')]);
        $booking->foods()->attach($request->get('food_3'), ['for_inter' => $request->has('food_inter_3')]);
        $booking->foods()->attach($request->get('food_4'), ['for_inter' => $request->has('food_inter_4')]);

        return redirect('admin');
    }

    public function dayList(Request $request)
    {
        is_allowed('reservation_view');

        $data['meals']   = Meal::all();
        $data['salons']  = TahdigSalon::all();
        $data['hasData'] = false;

        if ($request->has('meal') && $request->has('date_alt') && $request->has('salon')) {
            $booking = TahdigBooking::with(['reservations', 'reservations.user', 'reservations.food.restaurant'])
                ->where(
                    'booking_date', Carbon::createFromTimestamp($request->get('date_alt'))->toDateString()
                )->where('meal_id', $request->get('meal'))
                ->first();

            if ($booking) {
                $data['hasData'] = true;
                $data['booking'] = $booking->reservations->where('salon_id', $request->get('salon'));
                $data['foods']   = $data['booking']->groupBy('food_id');
            }
        }

        return view('admin.tahdig.booking_day_list', $data);
    }
}
