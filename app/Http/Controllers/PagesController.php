<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard()
    {
//        dd($data);
        return view('pages.dashboard');
    }
}
