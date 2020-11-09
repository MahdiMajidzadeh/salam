<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @deprecated
     */
    public function bulk(Request $request)
    {
        is_allowed('user_management');

        return view('admin.user.bulk');
    }

    /**
     * @deprecated
     */
    public function bulkSubmit(Request $request)
    {
        is_allowed('user_management');

        $users = $request->get('users');

        $lines = explode("\r\n", $users);

        foreach ($lines as $line) {
            [$name, $mobile] = explode('|', $line);
            $this->createUser(compact('name', 'mobile'));
        }

        if ($this->isFailed) {
            return redirect()->back()->withErrors($this->errors);
        }

        return redirect()->back()->with('msg-ok', __('msg.user_bulk_ok', ['count' => count($lines)]));
    }

    private function createUser($data)
    {
        $validator = Validator::make($data->all(), [
            'name'          => 'required',
            'employment_id' => 'integer',
            'mobile'        => 'required|digits:11|unique:users,mobile',
        ]);

        if ($validator->fails()) {
            $this->isFailed = true;

            $this->errors = $validator->errors()
                ->add('data', __('msg.add_failed', [
                    'name'  => $data->get('name'),
                    'value' => $data->get('mobile'),
                ]))->merge($this->errors);

            return;
        }

        $user                = new User();
        $user->name          = $data->get('name');
        $user->mobile        = $data->get('mobile');
        $user->password      = Hash::make($data->get('mobile'));
        $user->is_inter      = $data->has('is_inter');
        $user->employment_id = $data->get('employment_id', null);
        $user->save();
    }

    public function add(Request $request)
    {
        is_allowed('user_management');

        return view('admin.user.add');
    }

    public function addSubmit(Request $request)
    {
        is_allowed('user_management');

        $request->validate([
            'name'          => 'required',
            'employment_id' => 'integer|nullable',
            'mobile'        => 'required|digits:11|unique:users,mobile',
        ]);

        $user                = new User();
        $user->name          = $request->get('name');
        $user->mobile        = $request->get('mobile');
        $user->password      = Hash::make($request->get('mobile'));
        $user->is_inter      = $request->has('is_inter');
        $user->employment_id = $request->get('employment_id', null);
        $user->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    public function usersList(Request $request)
    {
        is_allowed('user_view');

        $query = User::query();

        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%' . $request->get('mobile') . '%');
        } else if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        $data['users'] = $query->orderBy('name', 'asc')
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
            'employment_id' => 'integer|nullable',
        ]);

        $user                = User::find($request->get('id'));
        $user->is_inter      = $request->has('is_inter');
        $user->employment_id = $request->get('employment_id', null);
        $user->save();

        return redirect()->back();
    }
}
