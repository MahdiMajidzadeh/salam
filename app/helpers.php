<?php

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
    function allowed($role)
    {
        if (! auth()->user()->role_id >= $role) {
            abort(403);
        }
    }
}

if (! function_exists('to_en')) {
    function to_en($number)
    {
        $fmt = numfmt_create('en', NumberFormatter::DECIMAL);

        return (int) $fmt->parse($number);
    }
}

if (! function_exists('roleName')) {
    function roleName($roleId)
    {
        $roles = [
            \App\Enum\Role::USER => 'کاربر',
            \App\Enum\Role::ADMIN => 'ادمین',
            \App\Enum\Role::FOOD_MANAGER => 'مدیر غذا',
            \App\Enum\Role::USER_MANAGER => 'مدیر کاربران',
            \App\Enum\Role::SUPER_ADMIN => 'سوپر ادمین',
        ];

        return \Illuminate\Support\Arr::get($roles, $roleId);
    }
}

if (!function_exists('faldom')) {
    /**
     * First And Last Day of Month with Year and Month
     * @return array
     */
    function faldom()
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

if (!function_exists('jMonths')) {
    function jMonths()
    {
        return [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند',
        ];
    }
}
