<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLoginAdmin()
    {
        if (Auth::check()) {
            return redirect()->route('Admin::dashboard@index');
        }
       return view('admin.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Please input email field',
                'password.required' => 'Please input password'
            ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()-> route('Admin::dashboard@index');
        } else {
            return redirect('admin/login')->with("Notice", "Login fail");
        }
    }

    public function getLogoutAdmin()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}	
