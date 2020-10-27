<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminList()
    {
        $data['admins'] = User::has('permissions')->get();

        return view('admin.acl.admin_list', $data);
    }

    public function adminPermissions($id)
    {
        $data['user']            = User::find($id);
        $data['permissions']     = Permission::all();
        $data['userPermissions'] = $data['user']->permissions->pluck('id');

        return view('admin.acl.edit', $data);
    }

    public function adminPermissionsSubmit(Request $request)
    {
        $user = User::find($request->get('user_id'));
        $user->permissions()->sync($request->get('permissions'));

        cache()->delete('u_per_' . $user->id);
        cache()->delete('u_is_ad_' . $user->id);

        return redirect('admin/acl/' . $user->id);
    }
}
