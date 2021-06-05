<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function all(Request $request)
    {
        is_allowed('notice_view');

        $data['notices'] = Notice::orderBy('id', 'desc')->paginate(30);

        return view('admin.notice.all', $data);
    }

    public function add(Request $request)
    {
        is_allowed('notice_management');

        return view('admin.notice.create');
    }

    public function addSubmit(Request $request)
    {
        is_allowed('notice_management');

        $notice             = new Notice();
        $notice->title      = $request->get('title');
        $notice->content    = $request->get('content');
        $notice->started_at = Carbon::createFromTimestamp($request->get('date_start_alt'))->toDateTimeString();
        $notice->ended_at   = Carbon::createFromTimestamp($request->get('date_end_alt'))->toDateTimeString();
        $notice->user_id    = auth()->id();
        $notice->save();

        if ($request->has('banner')) {
            $path = $request->file('banner')->store('public/banner');

            $notice->banner = $path;
            $notice->save();
        }

        return redirect('notices/'.$notice->id);
    }
}
