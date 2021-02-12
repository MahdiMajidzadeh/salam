<?php

namespace App\Http\Controllers;

use App\Model\TahdigSalon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $data['salons'] = TahdigSalon::where('is_active', true)->get();

        return view('setting.index', $data);
    }

    public function tahdigSubmit(Request $request)
    {
        $user = auth()->user();
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
