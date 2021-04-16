<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LibraryController extends Controller
{
    public function add(Request $request)
    {
        return view('admin.library.add');
    }
}
