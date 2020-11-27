<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BillExport;
use App\Model\TahdigReservation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    public function usersBill()
    {
        is_allowed('billing_view');

        $data = getMonthDays();

        $data['usersBill'] = DB::select(
            'SELECT u.id, u.name, u.employment_id, u.deactivated_at, (u.tahdig_credits - sum(tr.price * tr.quantity)) balance FROM `users` u
            join tahdig_reservations tr on u.id = tr.user_id
            join tahdig_bookings tb on tr.booking_id = tb.id
            where tb.booking_date > u.settlement_at
            GROUP by u.id,u.name, u.employment_id,u.tahdig_credits, u.deactivated_at
            order by u.employment_id asc'
        );

        return view('admin.bill.tahdig_users', $data);
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

        return view('admin.bill.tahdig_restaurants', $data);
    }
}
