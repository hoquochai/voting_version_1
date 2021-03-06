<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        $input = $request->only('email', 'password', 'remember');
        $user = User::where('email', $input['email'])->where('is_active', config('settings.is_active'))->first();

        if ($user && Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $input['remember'])) {
            if ($user->isAdmin()) {
                return redirect()->route('admin.user.index');
            }

            return redirect()->to(url('/'))->withMessage(trans('user.login_successfully'));
        }

        return redirect()->to(url('/login'))->withMessages(trans('user.account_unactive'));
    }
}
