<?php

namespace App\Http\Controllers\Ajax;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserLite;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userList(Request $request)
    {
        $request->validate([
            'q' => 'required',
        ]);

        $users = User::where('name', 'like', '%'.$request->get('q').'%')->get();

        return UserLite::collection($users);
    }
}
