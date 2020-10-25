<?php

namespace App\Http\Controllers\Admin;

use App\Enum\Role;
use App\Model\TahdingReservation;
use App\Exports\BillExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    public function usersBill()
    {
        allowed(Role::ACCOUNTANT_MANAGER);

        $data = getMonthDays();

        $data['usersBill'] = TahdingReservation::query()
            ->with('user')
            ->join('bookings', 'reservations.booking_id', 'bookings.id')
            ->whereBetween('bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->orderBy('user_id')
            ->get()
            ->groupBy('user_id');

        return view('admin_bill.users-bill', $data);
    }

    public function exportUsersBill()
    {
        return Excel::download(new BillExport(), 'tahdig.xlsx');
    }

    public function restaurantsBill()
    {
        allowed(Role::ACCOUNTANT_MANAGER);

        $data = getMonthDays();

        $data['restaurantsBill'] = TahdingReservation::query()
            ->with('food.restaurant')
            ->join('bookings', 'reservations.booking_id', 'bookings.id')
            ->whereBetween('bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->get()
            ->groupBy('food.restaurant_id');

        return view('admin_bill.restaurants-bill', $data);
    }
}
