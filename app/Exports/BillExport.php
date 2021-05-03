<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BillExport implements FromArray, WithHeadings
{
    use Exportable;

    public function array(): array
    {
        return DB::select("SELECT u.id, u.employee_id, u.deactivated_at, u.name, ff.cost, uu.credits,( uu.credits - Ifnull(ff.cost, 0)) balance FROM users u JOIN(SELECT u.id, Sum(d.charge_amount) credits, Count(*) cday FROM users u LEFT JOIN days d ON u.settlement_at <= d.day and (u.deactivated_at > d.day or u.deactivated_at is null) GROUP BY u.id, u.started_at) uu ON u.id = uu.id LEFT JOIN (SELECT u.id, Sum(tr.price * tr.quantity) cost FROM `users` u LEFT JOIN tahdig_reservations tr ON u.id = tr.user_id LEFT JOIN tahdig_bookings tb ON tr.booking_id = tb.id WHERE tb.booking_date >= u.settlement_at GROUP BY u.id) ff ON u.id = ff.id");
    }

    public function headings(): array
    {
        return [
            'ID',
            'Employee ID',
            'Name',
            'Balance',
        ];
    }
}
