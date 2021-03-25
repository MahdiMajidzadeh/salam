<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (! is_admin()) {
            abort(403);
        }

        return view('admin.dashboard');
    }

    public function adminList()
    {
        is_allowed('admin');
        $data['admins'] = User::has('permissions')->get();

        return view('admin.acl.admin_list', $data);
    }

    public function adminPermissions($id)
    {
        is_allowed('admin');

        $data['user']            = User::find($id);
        $data['permissions']     = Permission::all();
        $data['userPermissions'] = $data['user']->permissions->pluck('id');

        return view('admin.acl.edit_permission', $data);
    }

    public function adminPermissionsSubmit(Request $request)
    {
        is_allowed('admin');

        $user = User::find($request->get('user_id'));
        $user->permissions()->sync($request->get('permissions'));

        cache()->delete('u_per_'.$user->id);
        cache()->delete('u_is_ad_'.$user->id);

        return redirect('admin/acl/'.$user->id);
    }
}
