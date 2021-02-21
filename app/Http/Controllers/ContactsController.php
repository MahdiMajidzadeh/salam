<?php

namespace App\Http\Controllers;

use App\Model\Team;
use App\Model\User;
use App\Model\Chapter;
use Illuminate\Http\Request;

class ContactsController extends Controller
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

        $data['users'] = $contacts->get();

        return view('contacts.list', $data);
    }

    public function chapters(Request $request)
    {
        $data['title'] = 'چپترها';
        $data['slug']  = 'chapter';
        $data['items'] = Chapter::where('is_active', true)->get();

        return view('contacts.category', $data);
    }

    public function teams(Request $request)
    {
        $data['title'] = 'تیم‌ها';
        $data['slug']  = 'team';
        $data['items'] = Team::where('is_active', true)->get();

        return view('contacts.category', $data);
    }
}