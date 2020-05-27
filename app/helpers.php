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
