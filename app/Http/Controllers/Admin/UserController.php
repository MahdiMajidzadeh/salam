<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function add(Request $request)
    {
        is_allowed('user_management');

        $data['teams']    = Team::where('is_active', true)->get();
        $data['chapters'] = Chapter::where('is_active', true)->get();

        return view('admin.user.add', $data);
    }

    public function addSubmit(Request $request)
    {
        is_allowed('user_management');

        $request->validate([
            'name'          => 'required',
            'employee_id'   => 'integer|nullable',
            'mobile'        => 'required|digits:11|unique:users,mobile',
            //            'team'          => 'nullable|integer',
            //            'chapter'       => 'nullable|digits_between:1,2',
            'email'         => 'email|nullable',
            'email_basalam' => 'email|nullable',
        ]);

        $user                = new User();
        $user->name          = $request->get('name');
        $user->mobile        = $request->get('mobile');
        $user->password      = Hash::make($request->get('mobile'));
        $user->is_inter      = $request->has('is_inter');
        $user->employee_id   = $request->get('employee_id', null);
        $user->team_id       = $request->get('team', null);
        $user->chapter_id    = $request->get('chapter', null);
        $user->email         = $request->get('email', null);
        $user->email_basalam = $request->get('email_basalam', null);
        $user->settlement_at = Carbon::now();
        $user->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    public function usersList(Request $request)
    {
        is_allowed('user_view');

        $query = User::query();

        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%'.$request->get('mobile').'%');
        } elseif ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->get('name').'%');
        }

        $data['users'] = $query->orderBy('employee_id', 'asc')
            ->paginate(60);

        return view('admin.user.users_list', $data);
    }

    public function edit(Request $request, $id)
    {
        is_allowed('user_management');

        $data['user']     = User::find($id);
        $data['teams']    = Team::where('is_active', true)->get();
        $data['chapters'] = Chapter::where('is_active', true)->get();

        return view('admin.user.edit', $data);
    }

    public function editSubmit(Request $request)
    {
        is_allowed('user_management');

        $request->validate([
            'employee_id'   => 'integer|nullable',
            'team'          => 'integer|nullable',
            'chapter'       => 'integer|nullable',
            'email'         => 'email|nullable',
            'email_basalam' => 'email|nullable',
        ]);

        $user                = User::find($request->get('id'));
        $user->is_inter      = $request->has('is_inter');
        $user->employee_id   = $request->get('employee_id', null);
        $user->team_id       = $request->get('team', null);
        $user->chapter_id    = $request->get('chapter', null);
        $user->email         = $request->get('email', null);
        $user->email_basalam = $request->get('email_basalam', null);
        $user->started_at    = Carbon::createFromTimestamp($request->get('date_alt'))->toDateString();
        $user->save();

        return redirect()->back();
    }

    public function avatarSubmit(Request $request)
    {
        $user = User::find($request->get('id'));

        $path         = $request->file('avatar')->store('public/avatar');
        $user->avatar = $path;
        $user->save();

        return redirect()->back();
    }

    public function deactivateSubmit(Request $request)
    {
        is_allowed('user_management');

        $user                 = User::find($request->get('id'));
        $user->deactivated_at = Carbon::createFromTimestamp($request->get('date_alt'))->toDateString();
        $user->save();

        return redirect()->back();
    }
}
