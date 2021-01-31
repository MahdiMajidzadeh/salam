<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function add(Request $request)
    {
        is_allowed('user_management');

        return view('admin.user.add');
    }

    public function addSubmit(Request $request)
    {
        is_allowed('user_management');

        $request->validate([
            'name'        => 'required',
            'employee_id' => 'integer|nullable',
            'mobile'      => 'required|digits:11|unique:users,mobile',
        ]);

        $user                = new User();
        $user->name          = $request->get('name');
        $user->mobile        = $request->get('mobile');
        $user->password      = Hash::make($request->get('mobile'));
        $user->is_inter      = $request->has('is_inter');
        $user->employee_id   = $request->get('employee_id', null);
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

        $data['user'] = User::find($id);

        return view('admin.user.edit', $data);
    }

    public function editSubmit(Request $request)
    {
        is_allowed('user_management');

        $request->validate([
            'employee_id' => 'integer|nullable',
        ]);

        $user              = User::find($request->get('id'));
        $user->is_inter    = $request->has('is_inter');
        $user->employee_id = $request->get('employee_id', null);
        $user->save();

        return redirect()->back();
    }
}
