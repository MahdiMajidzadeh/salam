<?php

if (!function_exists('jdf')) {
    function jdf($date)
    {
        return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($date));
    }
}

if (!function_exists('jdfw')) {
    function jdfw($date)
    {
        return \Morilog\Jalali\CalendarUtils::strftime('l Y/m/d', strtotime($date));
    }
}

if (!function_exists('allowed')) {
    function allowed($role)
    {
        if (!auth()->user()->role_id >= $role) {
            abort(403);
        }
    }
}