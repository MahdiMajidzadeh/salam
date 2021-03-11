<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Link;
use App\Model\Notice;
use App\Model\TahdigBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['user'] = auth()->user();
        $booking      = TahdigBooking::query()
            ->where('booking_date', now()->toDateString())
            ->first();

        if ($booking !== null) {
            $data['todayReserved'] = $booking->reservations()
                ->where('user_id', auth()->id())
                ->first();
        }

        $data['notices'] = Notice::where('started_at', '<', Carbon::now())
            ->where('ended_at', '>', Carbon::now())
            ->get();

        $data['links'] = Link::orderBy('priority', 'asc')->get();

        return view('pages.dashboard', $data);
    }

    public function adminDashboard(Request $request)
    {
        if (! is_admin()) {
            abort(403);
        }

        return view('admin.dashboard');
    }

    public function singleNotice(Request $request, $id)
    {
        $data['notice'] = Notice::findOrFail($id);

        return view('notices.show', $data);
    }
}
