<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Index()
    {
        return view('login_form');
    }

    public function Login(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard')->with('error', 'Berhasil masuk admin');
        } elseif (Auth::guard('assets')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('assets.dashboard')->with('error', 'Berhasil masuk assets');
        } elseif (Auth::guard('manager')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('manager.dashboard')->with('error', 'Berhasil masuk manager');
        } else {
            return back()->with('error', 'Email atau password salah');
        }
    }
}
