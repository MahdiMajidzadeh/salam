<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class SarnakhController extends Controller
{
    public function index(Request $request)
    {
        $data['links'] = Link::orderBy('priority', 'asc')->get();

        return view('sarnakh.list', $data);
    }
}
