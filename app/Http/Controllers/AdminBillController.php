<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Model\Reservation;

class AdminBillController extends Controller
{
    public function usersBill()
    {
        allowed(Role::FOOD_MANAGER);

        $data = getMonthDays();

        $data['usersBill'] = Reservation::query()
            ->with('user')
            ->join('bookings', 'reservations.booking_id', 'bookings.id')
            ->whereBetween('bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->orderBy('user_id')
            ->get()
            ->groupBy('user_id');

        $data['sum'] = $data['usersBill']->sum(function ($userBill) {
            return $userBill->sum(function ($reservation) {
                if (($reservation->price - $reservation->price_default) < 0) {
                    return 0;
                }

                return $reservation->price - $reservation->price_default;
            });
        });

        return view('admin_bill.users-bill', $data);
    }

    public function restaurantsBill()
    {
        allowed(Role::FOOD_MANAGER);

        $data = getMonthDays();

        $data['restaurantsBill'] = Reservation::query()
            ->with('food.restaurant')
            ->join('bookings', 'reservations.booking_id', 'bookings.id')
            ->whereBetween('bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->get()
            ->groupBy('food.restaurant_id');

        return view('admin_bill.restaurants-bill', $data);
    }
}
