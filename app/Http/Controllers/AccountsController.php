<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    public function loginSubmit(Request $request)
    {
        $mobile = $request->get('mobile');
        $password = $request->get('password');

        $user = User::where('mobile', $mobile)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user, true);

                return redirect()->intended('/dashboard');
            }
        }

        return redirect()->back()->with('msg-error', __('msg.login_wrong'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
