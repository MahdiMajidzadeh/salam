<?php

namespace App\Http\Controllers;

use App\Model\AvailableFood;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard()
    {
        $data['availableFood'] = AvailableFood::with(['food','meal','type'])->get();
//        dd($data);
        return view('pages.dashboard');
    }
}
