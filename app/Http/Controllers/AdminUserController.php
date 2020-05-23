<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $lines = explode("\r\n", $users);

        $count = 0;
        foreach ($lines as $line) {
            list($name, $mobile) = explode('|', $line);

            $user           = new User();
            $user->name     = $name;
            $user->mobile   = $mobile;
            $user->password = Hash::make($mobile);
            $user->role_id  = Role::USER;
            $user->save();
            $count++;
        }

        return redirect()->back()->with('msg-ok', __('msg.user_bulk_ok', ['count' => $count]));
    }

    public function add(Request $request)
    {
        allowed(Role::USER_MANAGER);

        return view('admin_user.add');
    }

    public function addSubmit(Request $request)
    {
        allowed(Role::USER_MANAGER);

        // todo: validation

        $user           = new User();
        $user->name     = $request->get('name');
        $user->mobile   = $request->get('mobile');
        $user->password = Hash::make($request->get('mobile'));
        $user->role_id  = Role::USER;
        $user->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }
}
