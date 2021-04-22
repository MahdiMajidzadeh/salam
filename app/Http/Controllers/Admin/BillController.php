<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BillExport;
use App\Models\TahdigReservation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    public function usersBill()
    {
        is_allowed('billing_view');


        $data['usersBill'] = DB::select(
            'SELECT u.id, u.employee_id, u.deactivated_at, u.name, ff.cost, uu.credits,( uu.credits - Ifnull(ff.cost, 0)) balance FROM users u JOIN(SELECT u.id, Sum(d.charge_amount) credits, Count(*) cday FROM users u LEFT JOIN days d ON u.settlement_at <= d.day and (u.deactivated_at > d.day or u.deactivated_at is null) GROUP BY u.id, u.started_at) uu ON u.id = uu.id LEFT JOIN (SELECT u.id, Sum(tr.price * tr.quantity) cost FROM `users` u LEFT JOIN tahdig_reservations tr ON u.id = tr.user_id LEFT JOIN tahdig_bookings tb ON tr.booking_id = tb.id WHERE tb.booking_date >= u.settlement_at GROUP BY u.id) ff ON u.id = ff.id'
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

        $data['restaurantsBill'] = TahdigReservation::query()
            ->with('food.restaurant')
            ->join('tahdig_bookings', 'tahdig_reservations.booking_id', 'tahdig_bookings.id')
            ->whereBetween('tahdig_bookings.booking_date', [$data['firstDayOfMonth'], $data['lastDayOfMonth']])
            ->get()
            ->groupBy('food.restaurant_id');

        return view('notice.bill.tahdig_restaurants', $data);
    }
}
