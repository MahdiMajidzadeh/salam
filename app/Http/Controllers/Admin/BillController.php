<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BillExport;
use App\Model\TahdigReservation;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    public function usersBill()
    {
        is_allowed('billing_view');

        $data = getMonthDays();

        $data['usersBill'] = TahdigReservation::query()
            ->with('user')
            ->join('tahdig_bookings', 'tahdig_reservations.booking_id', 'tahdig_bookings.id')
            ->whereBetween('tahdig_bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->orderBy('user_id')
            ->get()
            ->groupBy('user_id');

        return view('admin_bill.users-bill', $data);
    }

    public function exportUsersBill()
    {
        is_allowed('billing_view');

        return Excel::download(new BillExport(), 'tahdig.xlsx');
    }

    public function restaurantsBill()
    {
        is_allowed('billing_view');

        $data = getMonthDays();

        $data['restaurantsBill'] = TahdigReservation::query()
            ->with('food.restaurant')
            ->join('tahdig_bookings', 'tahdig_reservations.booking_id', 'tahdig_bookings.id')
            ->whereBetween('tahdig_bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->get()
            ->groupBy('food.restaurant_id');

        return view('admin_bill.restaurants-bill', $data);
    }
}
