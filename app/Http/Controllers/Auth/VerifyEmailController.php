<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\Assets;
use App\Models\Manager;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
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

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
