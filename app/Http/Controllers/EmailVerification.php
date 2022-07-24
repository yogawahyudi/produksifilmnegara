<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Assets;
use App\Models\Manager;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class EmailVerification extends Controller

{
    public function verifyEmail(Request $request)
    {

        if ($request->user('manager') != null) {
            $user = Manager::findOrFail($request->id);

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
            if ($request->user('manager')->hasVerifiedEmail()) {
                return redirect()->route('manager.dashboard');
            }

            if ($request->user('manager')->markEmailAsVerified()) {
                event(new Verified($request->user('manager')));
            }

            return redirect()->route('manager.dashboard');
        }

        if ($request->user('assets') != null) {
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

        if ($request->user('assets') != null) {
            $user = Admins::findOrFail($request->id);
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
            if ($request->user('admin')->hasVerifiedEmail()) {
                return redirect()->route('admin.dashboard');
            }

            if ($request->user('admin')->markEmailAsVerified()) {
                event(new Verified($request->user('admin')));
            }

            return redirect()->route('admin.dashboard');
        }
    }
}
