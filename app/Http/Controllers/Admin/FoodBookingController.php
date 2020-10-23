<?php

namespace App\Http\Controllers\Admin;

use App\Enum\Role;
use App\Model\Food;
use App\Model\Meal;
use App\Model\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class FoodBookingController extends Controller
{
    public function add(Request $request)
    {
        allowed(Role::FOOD_MANAGER);

        $data['meals'] = Meal::all();
        $data['foods'] = Food::with(['restaurant'])->get();

        return view('admin_booking.add', $data);
    }

    public function addSubmit(Request $request)
    {
        allowed(Role::FOOD_MANAGER);

        $request->validate([
            'meal' => 'required|exists:meals,id',
            'food_main' => 'required|exists:foods,id',
            'foods' => 'array',
            'foods.*' => 'nullable|distinct|exists:foods,id|different:food_main',
        ]);

        $booking = new Booking();
        $booking->booking_date = Carbon::createFromTimestamp($request->get('date_alt'))->toDateString();
        $booking->meal_id = $request->get('meal');
        $booking->default_food_id = $request->get('food_main');
        $booking->save();

        $booking->foods()->attach($request->get('food_main'));

        foreach ($request->get('foods') as $food) {
            if (! is_null($food)) {
                $booking->foods()->attach($food);
            }
        }

        return redirect('admin');
    }

    public function dayList(Request $request)
    {
        $data['meals'] = Meal::all();
        $data['hasData'] = false;

        if ($request->has('meal') && $request->has('date_alt')) {
            $booking = Booking::with(['foods', 'reservations'])
                ->where(
                    'booking_date', Carbon::createFromTimestamp($request->get('date_alt'))->toDateString()
                )->where('meal_id', $request->get('meal'))
                ->first();

            if ($booking) {
                $data['hasData'] = true;

                $data['booking'] = $booking;
                $data['foods'] = $booking->reservations->groupBy('food_id');
            }
        }

        return view('admin_booking.day_list', $data);
    }
}
