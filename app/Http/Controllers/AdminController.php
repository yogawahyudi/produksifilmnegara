<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Assets;
use App\Models\Manager;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function emailVerificationPrompt(Request $request)
    {
        return $request->user('admin')->hasVerifiedEmail()
            ? redirect()->route('admin.dashboard')
            : view('admin.auth.verify-email');
    }

    public function emailVerificationNotification(Request $request)
    {
        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        $request->user('admin')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public function verifyEmail(Request $request)
    {
    }


    public function Index()
    {
        return view('admin.login_form');
    }

    public function Dashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function Login(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard')->with('error', 'Berhasil masuk');
        } else {
            return back()->with('error', 'Email atau password salah');
        }
    }

    public function AdminRegister()
    {
        return view('admin.admin_register');
    }

    public function AdminRegisterStore(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|confirmed|min:8'
        // ]);

        Admins::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login_form')->with('error', 'Berhasil menambhakan admin');
    }

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form');
    }

    public function adminManager()
    {
        $managers = Manager::all();
        return view('admin.pages.manager.index_manager', compact('managers', 'managers'));
    }

    public function adminStoreManager(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
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
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => $pass
        ]);

        return redirect()->back()->with('success', 'Berhasil menambhakan manager');
    }

    public function adminEditManager(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'jabatan' => 'required'
        ]);
        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        }

        $manager = Manager::find($id);

        $manager->update([
            'no_hp' => $nohp,
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengupdate manager');
    }

    public function adminAssets()
    {
        $assets = Assets::all();
        return view('admin.pages.assets.index_assets', compact('assets', 'assets'));
    }


    public function adminStoreAssets(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'jabatan' => 'required'
        ]);

        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        }
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $pass = substr(str_shuffle($chars), 0, 8);


        $assets = Assets::create([
            'no_hp' => $nohp,
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => $pass
        ]);

        return redirect()->back()->with('success', 'Berhasil menambhakan manager');
    }
    public function adminEditAssets(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'jabatan' => 'required'
        ]);
        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        }

        $assets = Assets::find($id);

        $assets->update([
            'no_hp' => $nohp,
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengupdate manager');
    }
}
