<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\TahdigBooking;
use Illuminate\Http\Request;
use Modules\Notice\Entities\Notice;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function dashboard(Request $request)
    {
        $data    = [];
        $booking = TahdigBooking::query()
            ->where('booking_date', now()->toDateString())
            ->first();

        if ($booking !== null) {
            $data['todayReserved'] = $booking->reservations()
                ->where('user_id', auth()->id())
                ->first();
        }

        if (Module::find('Notice')) {
            $data['notices'] = Notice::where('started_at', '<', Carbon::now())
                ->where('ended_at', '>', Carbon::now())
                ->get();
        }

        return view('pages.dashboard', $data);
    }

    public function adminDashboard(Request $request)
    {
        if (!is_admin()) {
            abort(403);
        }

        return view('admin.dashboard');
    }

    public function passwordReset(Request $request)
    {
        return view('user.password_reset');
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

    public function singleNotice(Request $request, $id)
    {
        $data['notice'] = Notice::findOrFail($id);

        return view('pages.notice', $data);
    }
}
