<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Model\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = [];
        $booking = Booking::query()
            ->where('booking_date', now()->toDateString())
            ->first();

        if ($booking !== null) {
            $data['todayReserved'] = $booking->reservations()
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('pages.dashboard', $data);
    }

    public function adminDashboard(Request $request)
    {
        allowed(Role::ADMIN);

        return view('pages.dashboard_admin');
    }

    public function passwordReset(Request $request)
    {
        return view('pages.password_reset');
    }

    public function passwordResetSubmit(Request $request)
    {
        $request->validate([
            'password_old'        => 'required|min:6',
            'password_new'        => 'required|min:6',
            'password_double_new' => 'required|same:password_new',
        ]);

        if (! Hash::check(
            $request->get('password_old'),
            auth()->user()->password)
        ) {
            return redirect()->back()->with('msg-error', __('msg.password_wrong'));
        }

        $user = auth()->user();
        $user->password = Hash::make($request->get('password_new'));
        $user->save();

        return redirect()->back()->with('msg-ok', __('msg.password_ok'));
    }
}
