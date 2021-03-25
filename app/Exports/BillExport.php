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
        $data = getMonthDays();

        return DB::select("SELECT u.id, u.employee_id, u.NAME, ff.cost, uu.credits,( uu.credits - ff.cost ) balance,
started_at,
uu.cday , (u.tahdig_credits - ff.cost) n_balance, u.credits
FROM
	users u
	JOIN (
	SELECT
		u.id,
		sum( d.charge_amount ) credits,
		count(*) cday 
	FROM
		users u
		LEFT JOIN days d ON u.started_at <= d.DAY 
	GROUP BY
		u.id,
		u.started_at 
	) uu ON u.id = uu.id
	LEFT JOIN (
	SELECT
		u.id,
		sum( tr.price * tr.quantity ) cost 
	FROM
		`users` u
		LEFT JOIN tahdig_reservations tr ON u.id = tr.user_id
		LEFT JOIN tahdig_bookings tb ON tr.booking_id = tb.id 
	WHERE
		tb.booking_date >= '2020-10-30' 
	GROUP BY
	u.id 
	) ff ON u.id = ff.id");
    }

    public function headings(): array
    {
        return [
            'ID',
            'Employee ID',
            'Name',
            'Total Cost',
            'Credits',
            'Balance',
        ];
    }
}
