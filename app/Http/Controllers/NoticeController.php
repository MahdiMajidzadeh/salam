<?php

namespace Modules\Notice\Http\Controllers;

use App\Model\Notice;
use Illuminate\Routing\Controller;

class NoticeController extends Controller
{
    public function show($id)
    {
        $data['notice'] = Notice::findOrFail($id);

        return view('notices.show', $data);
    }
}
