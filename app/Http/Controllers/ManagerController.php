<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Assets;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function emailVerificationPrompt(Request $request)
    {
        return $request->user('manager')->hasVerifiedEmail()
            ? redirect()->route('manager.dashboard')
            : view('manager.auth.verify-email');
    }

    public function emailVerificationNotification(Request $request)
    {
        if ($request->user('manager')->hasVerifiedEmail()) {
            return redirect()->route('manager.dashboard');
        }

        $request->user('manager')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public function Index()
    {
        return view('manager.login_form');
    }

    public function Dashboard()
    {
        return view('manager.pages.dashboard');
    }



    public function ManagerRegister()
    {
        return view('manager.manager_register');
    }

    public function ManagerRegisterStore(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'jabatan' => 'required'
        ]);

        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        }
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $pass = substr(str_shuffle($chars), 0, 8);


        $manager = Manager::create([
            'no_hp' => $nohp,
            'name' => $request->nama,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => $pass
        ]);

        return redirect()->back()->with('success', 'Berhasil menambhakan manager');
    }

    public function ManagerLogout()
    {
        Auth::guard('manager')->logout();
        return redirect()->route('login_form');
    }

    public function dataPenyewa()
    {
        $users = User::all();
        return view('manager.pages.users.index_users', compact('users', 'users'));
    }
}
