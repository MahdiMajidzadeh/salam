<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Chapter;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $contacts = User::with(['team', 'chapter'])
            ->where('deactivated_at', null);

        if ($request->has('team')) {
            $contacts->where('team_id', $request->input('team'));
        }

        if ($request->has('chapter')) {
            $contacts->where('chapter_id', $request->input('chapter'));
        }

        if ($request->has('q')) {
            $contacts->where('name', 'like', '%'.$request->input('q').'%');
        }

        $data['users'] = $contacts->paginate(40);

        return view('employee.list', $data);
    }

    public function chapters(Request $request)
    {
        $data['title'] = 'چپترها';
        $data['slug']  = 'chapter';
        $data['items'] = Chapter::where('is_active', true)->get();

        return view('employee.category', $data);
    }

    public function teams(Request $request)
    {
        $data['title'] = 'تیم‌ها';
        $data['slug']  = 'team';
        $data['items'] = Team::where('is_active', true)->get();

        return view('employee.category', $data);
    }

    public function single(Request $request, $id)
    {
        $data['user'] = User::where('employee_id', $id)->firstOrFail();

        return view('employee.single', $data);
    }

    public function exportEmailActive(Request $request)
    {
        $emails = User::query()
            ->whereNull('deactivated_at')
            ->whereNotNull('email')
            ->get()
            ->pluck('email')
            ->toArray();

        return implode(',', $emails);
    }
}
