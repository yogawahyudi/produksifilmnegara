<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\EmailVerification;
use App\Http\Controllers\ManagerController;
use App\Models\Manager;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware('admin')->group(function () {
    Route::get('admin/verify-email', [AdminController::class, 'emailVerificationPrompt'])
        ->name('admin.verification.notice');

    Route::post('admin/email/verification-notification', [AdminController::class, 'emailVerificationNotification'])
        ->middleware('throttle:6,1')
        ->name('admin.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('admin/logout', [AdminController::class, 'AdminLogout'])
        ->name('admin.logout');
});

Route::middleware('assets')->group(function () {
    Route::get('assets/verify-email', [AssetsController::class, 'emailVerificationPrompt'])
        ->name('assets.verification.notice');

    Route::post('assets/email/verification-notification', [AssetsController::class, 'emailVerificationNotification'])
        ->middleware('throttle:6,1')
        ->name('assets.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('assets/logout', [AssetsController::class, 'AssetsLogout'])
        ->name('assets.logout');
});

Route::middleware('manager')->group(function () {
    Route::get('manager/verify-email', [ManagerController::class, 'emailVerificationPrompt'])
        ->name('manager.verification.notice');

    Route::post('manager/email/verification-notification', [ManagerController::class, 'emailVerificationNotification'])
        ->middleware('throttle:6,1')
        ->name('manager.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('manager/logout', [ManagerController::class, 'ManagerLogout'])
        ->name('manager.logout');
});

// Route::get('auth/verify-email/{id}/{hash}', [EmailVerification::class, 'verifyEmail'])
//     ->middleware(['signed', 'throttle:6,1'])
//     ->name('verification.verify');
