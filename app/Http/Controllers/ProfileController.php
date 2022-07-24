<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use App\Models\Admins;
use App\Models\Assets;
use App\Models\Manager;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function indexProfile()
    {
        $user = Auth::user();
        return view('users.pages.profile.index_profile', compact('user', 'user'));
    }

    public function indexProfileAssets(Request $request)
    {

        $user = Auth::guard('assets')->user();
        return view('assets.pages.profile.index_profile', compact('user', 'user'));
    }

    public function indexProfileAdmin(Request $request)
    {

        $user = Auth::guard('admin')->user();
        return view('admin.pages.profile.index_profile', compact('user', 'user'));
    }

    public function indexProfileManager(Request $request)
    {
        $user = Auth::guard('manager')->user();
        return view('manager.pages.profile.index_profile', compact('user', 'user'));
    }

    public function updateImagesAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'images.*' => 'max:5000'
        ]);

        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/profile/admin'), $filename);
            $admin = Admins::find($id);
            if ($admin->img != null) {
                File::delete(public_path("assets/images/profile/admin/" . $admin->img));
            }
            $admin->update([
                'img' => $filename
            ]);
        }
        return redirect()->back()->with("success", "Berhasil Update Image");
    }

    public function updateProfileAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        } else {
            $nohp = $request->no_hp;
        }

        $admin = Admins::find($id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $nohp,
        ]);

        return redirect()->back()->with('success', 'Berhasil Update Profile');
    }

    public function updatePasswordAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'oldPassword' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Admins::find($id)->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Berhasil Update Password');
    }

    public function updateImagesManager(Request $request, $id)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'images.*' => 'max:5000'
        ]);

        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/profile/manager'), $filename);
            $manager = Manager::find($id);
            if ($manager->img != null) {
                File::delete(public_path("assets/images/profile/manager/" . $manager->img));
            }
            $manager->update([
                'img' => $filename
            ]);
        }
        return redirect()->back()->with("success", "Berhasil Update Image");
    }

    public function updateProfileManager(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        } else {
            $nohp = $request->no_hp;
        }

        $manager = Manager::find($id);
        $manager->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $nohp,
        ]);

        return redirect()->back()->with('success', 'Berhasil Update Profile');
    }

    public function updatePasswordManager(Request $request, $id)
    {
        $this->validate($request, [
            'oldPassword' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Manager::find($id)->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Berhasil Update Password');
    }

    public function updateImagesAssets(Request $request, $id)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'images.*' => 'max:5000'
        ]);

        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/profile/assets'), $filename);
            $assets = Assets::find($id);
            if ($assets->img != null) {
                File::delete(public_path("assets/images/profile/assets/" . $assets->img));
            }
            $assets->update([
                'img' => $filename
            ]);
        }
        return redirect()->back()->with("success", "Berhasil Update Image");
    }

    public function updateProfileAssets(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        } else {
            $nohp = $request->no_hp;
        }

        $assets = Assets::find($id);
        $assets->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $nohp,
        ]);

        return redirect()->back()->with('success', 'Berhasil Update Profile');
    }

    public function updatePasswordAssets(Request $request, $id)
    {
        $this->validate($request, [
            'oldPassword' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Assets::find($id)->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Berhasil Update Password');
    }

    public function updateImagesUser(Request $request, $id)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'images.*' => 'max:5000'
        ]);

        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/profile/user'), $filename);
            $user = User::find($id);
            if ($user->img != null) {
                File::delete(public_path("user/images/profile/user/" . $user->img));
            }
            $user->update([
                'img' => $filename
            ]);
        }
        return redirect()->back()->with("success", "Berhasil Update Image");
    }

    public function updateProfileUser(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if ($request->no_hp[0] == 0) {
            $nohp = substr_replace($request->no_hp, "+62", 0, 1);
        } else {
            $nohp = $request->no_hp;
        }

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $nohp,
        ]);

        return redirect()->back()->with('success', 'Berhasil Update Profile');
    }

    public function updatePasswordUser(Request $request, $id)
    {
        $this->validate($request, [
            'oldPassword' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::find($id)->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Berhasil Update Password');
    }
}
