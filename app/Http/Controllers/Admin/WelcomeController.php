<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WelcomeNote;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function noteAll(Request $request)
    {
        is_allowed('welcome_management');

        $data['notes'] = WelcomeNote::orderBy('day', 'asc')->get();

        return view('admin.welcome.note_all', $data);
    }

    public function noteAdd(Request $request)
    {
        is_allowed('welcome_management');

        return view('admin.welcome.note_create');
    }

    public function noteAddSubmit(Request $request)
    {
        is_allowed('welcome_management');

        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'day'     => 'required|integer',
        ]);

        $note          = new WelcomeNote();
        $note->title   = $request->get('title');
        $note->content = $request->get('content');
        $note->day     = $request->get('day');
        $note->save();

        return redirect('/admin/welcome/notes');
    }

    public function noteEdit(Request $request, $id)
    {
        is_allowed('welcome_management');

        $data['note'] = WelcomeNote::findOrFail($id);

        return view('admin.welcome.note_edit', $data);
    }

    public function noteEditSubmit(Request $request)
    {
        is_allowed('welcome_management');

        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'day'     => 'required|integer',
        ]);

        $note          = WelcomeNote::findOrFail($request->get('id'));
        $note->title   = $request->get('title');
        $note->content = $request->get('content');
        $note->day     = $request->get('day');
        $note->save();

        return redirect('/admin/welcome/notes');
    }
}
