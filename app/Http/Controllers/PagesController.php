<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Notice;
use Illuminate\Http\Request;
use App\Models\TahdigBooking;

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

        return view('pages.dashboard', $data);
    }

    public function singleNotice(Request $request, $id)
    {
        $data['notice'] = Notice::findOrFail($id);

        return view('notices.show', $data);
    }
}
