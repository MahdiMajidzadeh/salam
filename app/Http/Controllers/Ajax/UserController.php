<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserLite;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList(Request $request)
    {
        $request->validate([
            'q' => 'required'
        ]);

        $users = User::where('name', 'like', '%'.$request->get('q').'%')->get();

        return UserLite::collection($users);
    }
}
