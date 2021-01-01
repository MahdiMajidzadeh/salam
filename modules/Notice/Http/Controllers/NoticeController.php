<?php

namespace Modules\Notice\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Notice\Entities\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        return view('notice::index');
    }

    public function show($id)
    {
        $data['notice'] = Notice::findOrFail($id);

        return view('notice::show', $data);
    }
}
