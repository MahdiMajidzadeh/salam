<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $isFailed = false;

    private $errors = [];

    /**
     * @deprecated
     */
    public function bulk(Request $request)
    {
        is_allowed('user_management');

        return view('admin_user.bulk');
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
            'name'   => 'required',
            'mobile' => 'required|digits:11|unique:users,mobile',
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

        $user = new User();
        $user->name = $data->get('name');
        $user->mobile = $data->get('mobile');
        $user->password = Hash::make($data->get('mobile'));
        $user->is_inter = $data->has('is_inter');
        $user->save();
    }

    public function add(Request $request)
    {
        is_allowed('user_management');

        return view('admin_user.add');
    }

    public function addSubmit(Request $request)
    {
        is_allowed('user_management');

        $this->createUser($request);

        if ($this->isFailed) {
            return redirect()->back()->withErrors($this->errors);
        }

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

        $data['users'] = $query->orderBy('name', 'asc')
            ->paginate(60);

        return view('admin_user.users_list', $data);
    }
}
