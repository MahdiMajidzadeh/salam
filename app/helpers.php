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

if (! function_exists('jdfw_name')) {
    function jdfw_name($date)
    {
        return \Morilog\Jalali\Jalalian::fromDateTime($date)->format('%A: %d %B %y');
    }
}

if (! function_exists('jdf_format')) {
    function jdf_format($date, $format)
    {
        return \Morilog\Jalali\Jalalian::fromDateTime($date)->format($format);
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

if (! function_exists('is_allowed')) {
    function is_allowed($action)
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
            return abort(403);
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

        return false;
    }
}

if (! function_exists('to_en')) {
    function to_en($number)
    {
        $fmt = numfmt_create('en', NumberFormatter::DECIMAL);

        return (int) $fmt->parse($number);
    }
}
