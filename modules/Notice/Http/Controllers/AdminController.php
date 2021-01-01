<?php

namespace Modules\Notice\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Notice\Entities\Notice;
use Illuminate\Contracts\Support\Renderable;

class AdminController extends Controller
{
    public function index()
    {
        is_allowed('notice_view');

        $data['notices'] = Notice::orderBy('id', 'desc')->paginate(30);

        return view('notice::admin.all', $data);
    }

    public function create()
    {
        is_allowed('notice_management');

        return view('notice::admin.create');
    }

    public function store(Request $request)
    {
        is_allowed('notice_management');

        // validation

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

        return redirect('admin/notices');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('notice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('notice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
