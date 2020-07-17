<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BillExport implements FromArray, WithHeadings
{
    use Exportable;

    public function array(): array
    {
        $data = getMonthDays();

        return DB::select("SELECT
	u.employment_id,
	u.NAME,
IF
	(
		(sum( r.price ) - sum( r.price_default )) > 0,
		sum( r.price ) - sum( r.price_default ),
		0 
	) total
FROM
	reservations r
	JOIN users u ON u.id = r.user_id
	JOIN bookings b ON b.id = r.booking_id 
WHERE
	b.booking_date BETWEEN '2020-06-21' 
	AND '2020-07-21' 
GROUP BY
    u.employment_id,
	u.NAME,
	r.user_id
	order by 1 asc");
    }

    public function headings(): array
    {
        return [
            'Employment ID',
            'Name',
            'Total',
        ];
    }
}
