<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Chapter;
use App\Models\TahdigSalon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function user(Request $request)
    {
        $data['user']     = auth()->user();
        $data['teams']    = Team::where('is_active', true)->get();
        $data['chapters'] = Chapter::where('is_active', true)->get();

        return view('setting.user', $data);
    }

    public function userSubmit(Request $request)
    {
        $request->validate([
            'employee_id'   => 'integer|nullable',
            'team'          => 'exists:teams,id',
            'chapter'       => 'exists:chapters,id',
            'email'         => 'email|nullable',
            'email_basalam' => 'email|nullable',
            'biography'     => 'nullable',
            'linkedin_url'  => 'url|nullable',
            'virgool_url'   => 'url|nullable',
        ]);

        $user                = auth()->user();
        $user->team_id       = $request->get('team', null);
        $user->chapter_id    = $request->get('chapter', null);
        $user->email         = $request->get('email', null);
        $user->email_basalam = $request->get('email_basalam', null);
        $user->biography     = $request->get('biography', null);
        $user->linkedin_url  = $request->get('linkedin_url', null);
        $user->virgool_url   = $request->get('virgool_url', null);
        $user->save();

        return redirect()->back()->with('msg-ok', __('msg.change_ok'));
    }

    public function tahdig(Request $request)
    {
        $data['salons'] = TahdigSalon::where('is_active', true)->get();

        return view('setting.tahdig', $data);
    }

    public function tahdigSubmit(Request $request)
    {
        $user                   = auth()->user();
        $user->default_salon_id = $request->get('salon');
        $user->save();

        return redirect()->back()->with('msg-ok', __('msg.change_ok'));
    }

    public function passwordReset(Request $request)
    {
        return view('setting.password_reset');
    }

    public function passwordResetSubmit(Request $request)
    {
        $request->validate([
            'password_old'        => 'required|min:6',
            'password_new'        => 'required|min:6',
            'password_double_new' => 'required|same:password_new',
        ]);

        if (!Hash::check(
            $request->get('password_old'),
            auth()->user()->password)
        ) {
            return redirect()->back()->with('msg-error', __('msg.password_wrong'));
        }

        $user           = auth()->user();
        $user->password = Hash::make($request->get('password_new'));
        $user->save();

        return redirect()->back()->with('msg-ok', __('msg.password_ok'));
    }
}
