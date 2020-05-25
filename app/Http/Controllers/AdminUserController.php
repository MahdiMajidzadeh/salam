<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function bulk(Request $request)
    {
        allowed(Role::USER_MANAGER);

        return view('admin_user.bulk');
    }

    public function bulkSubmit(Request $request)
    {
        allowed(Role::USER_MANAGER);

        $users = $request->get('users');

        $lines = preg_split('/\R/', $users);

        foreach ($lines as $line) {
            list($name, $mobile) = explode('|', $line);
            $this->createUser(compact('name', 'mobile'));
        }

        return redirect()->back()->with('msg-ok', __('msg.user_bulk_ok', ['count' => count($lines)]));
    }

    public function add(Request $request)
    {
        allowed(Role::USER_MANAGER);

        return view('admin_user.add');
    }

    public function addSubmit(Request $request)
    {
        allowed(Role::USER_MANAGER);

        $this->createUser($request->all());

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    private function createUser($data)
    {
        Validator::make($data, [
            'name' => 'required|alpha',
            'mobile' => 'required|digits:11|unique:users,mobile'
        ])->validate();

        $user = new User();
        $user->name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->password = Hash::make($data['mobile']);
        $user->role_id = Role::USER;
        $user->save();
    }

    public function usersList()
    {
        allowed(Role::USER_MANAGER);

        $users = User::query()->orderByDesc('id')->paginate(30);

        return view('admin_user.users_list', compact('users'));
    }
}
