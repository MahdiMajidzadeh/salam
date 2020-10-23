<?php

use Illuminate\Support\Facades\Cache;

if (! function_exists('jdf')) {
    function jdf($date)
    {
        return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($date));
    }
}

if (! function_exists('jdfw')) {
    function jdfw($date)
    {
        return \Morilog\Jalali\CalendarUtils::strftime('l Y/m/d', strtotime($date));
    }
}

if (! function_exists('allowed')) {
    function allowed($action)
    {
        $userId = auth()->id();

        $permissions = Cache::remember('u_per_'.$userId, 60 * 60, function () {
            return auth()
                ->user()
                ->permissions()
                ->pluck('slug')
                ->toArray();
        });

        if (! in_array($action, $permissions)) {
            return false;
        }

        return true;
    }
}

if (! function_exists('is_admin')) {
    function is_admin()
    {
        $userId = auth()->id();

        $permissions = Cache::remember('u_is_ad_'.$userId, 60 * 60, function () {
            return auth()
                ->user()
                ->permissions
                ->count();
        });

        if ($permissions > 0) {
            return true;
        }

        return false();
    }
}

if (! function_exists('to_en')) {
    function to_en($number)
    {
        $fmt = numfmt_create('en', NumberFormatter::DECIMAL);

        return (int) $fmt->parse($number);
    }
}

if (! function_exists('getMonthDays')) {
    /**
     * First And Last Day of Month with Year and Month.
     *
     * @return array
     */
    function getMonthDays(): array
    {
        $jdate = jdate(now());
        $year = $jdate->getYear();
        $month = $jdate->getMonth();

        if (request()->filled('month')) {
            $month = request()->get('month');
        }
        if (request()->filled('year')) {
            $year = request()->get('year');
        }

        $firstDayOfMonth = new \Morilog\Jalali\Jalalian($year, $month, 1);
        $lastDayOfMonth = $firstDayOfMonth->addMonths()->subDays()->toCarbon()->toDateString();
        $firstDayOfMonth = $firstDayOfMonth->toCarbon()->toDateString();

        return compact('firstDayOfMonth', 'lastDayOfMonth', 'year', 'month');
    }
}

if (! function_exists('jMonths')) {
    /**
     * @return array
     */
    function jMonths(): array
    {
        return [
            1  => 'فروردین',
            2  => 'اردیبهشت',
            3  => 'خرداد',
            4  => 'تیر',
            5  => 'مرداد',
            6  => 'شهریور',
            7  => 'مهر',
            8  => 'آبان',
            9  => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند',
        ];
    }
}
