<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AssetsController extends Controller
{

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function emailVerificationPrompt(Request $request)
    {

        return $request->user('assets')->hasVerifiedEmail()
            ? redirect()->route('assets.dashboard')
            : view('assets.auth.verify-email');
    }

    public function emailVerificationNotification(Request $request)
    {
        if ($request->user('assets')->hasVerifiedEmail()) {
            return redirect()->route('assets.dashboard');
        }

        $request->user('assets')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public function verifyEmail(Request $request)
    {
        $user = Assets::findOrFail($request->id);
        if (!hash_equals(
            (string) $request->route('id'),
            (string) $user->getKey()
        )) {
            return false;
        }

        if (!hash_equals(
            (string) $request->route('hash'),
            sha1($user->getEmailForVerification())
        )) {
            return false;
        }
        if ($request->user('assets')->hasVerifiedEmail()) {
            return redirect()->route('assets.dashboard');
        }

        if ($request->user('assets')->markEmailAsVerified()) {
            event(new Verified($request->user('assets')));
        }

        return redirect()->route('assets.dashboard');
    }

    public function Index()
    {
        return view('assets.login_form');
    }

    public function Dashboard()
    {
        return view('assets.pages.dashboard');
    }

    public function Login(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('assets')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('assets.dashboard')->with('error', 'Berhasil masuk');
        } else {
            return back()->with('error', 'Email atau password salah');
        }
    }

    public function AssetsRegister()
    {
        return view('assets.assets_register');
    }

    public function AssetsRegisterStore(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|confirmed|min:8'
        // ]);

        $user =   Assets::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return redirect()->route('login_form')->with('error', 'Berhasil menambhakan admin');
    }

    public function AssetsLogout()
    {
        Auth::guard('assets')->logout();
        return redirect()->route('login_form');
    }

    public function storeUser(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        }
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $pass = substr(str_shuffle($chars), 0, 8);


        $user = User::create([
            'no_hp' => $nohp,
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $pass
        ]);

        session([
            'userId' => $user->id
        ]);

        return redirect()->route('pilihStudio.transaksi');
    }
}
