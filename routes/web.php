<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BOTTelegramController;
use App\Http\Controllers\BoyerMooreController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\emailController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NBCController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TextProcessingController;
use App\Http\Controllers\TransaksiController;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('admin/dashboard')->group(function () {
    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
    // Route::post('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::post('/register/create', [AdminController::class, 'AdminRegisterStore'])->name('admin.register.store');
    Route::get('/', [AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware(['admin', 'admin.verified']);

    Route::get('/profile', [ProfileController::class, 'indexProfileAdmin'])->name('index.profile.admin')->middleware(['admin', 'admin.verified']);
    Route::post('/profile/{id}/update-img', [ProfileController::class, 'updateImagesAdmin'])->name('update.images.admin')->middleware(['admin', 'admin.verified']);
    Route::post('/profile/{id}/update-profile', [ProfileController::class, 'updateProfileAdmin'])->name('update.profile.admin')->middleware(['admin', 'admin.verified']);
    Route::post('/profile/{id}/update-password', [ProfileController::class, 'updatePasswordAdmin'])->name('update.password.admin')->middleware(['admin', 'admin.verified']);


    Route::get('/manager', [AdminController::class, 'adminManager'])->name('index.admin.manager')->middleware(['admin', 'admin.verified']);
    Route::post('/manager/store', [AdminController::class, 'adminStoreManager'])->name('store.admin.manager')->middleware(['admin', 'admin.verified']);
    Route::post('/manager/{id}/update', [AdminController::class, 'adminEditManager'])->name('update.admin.manager')->middleware(['admin', 'admin.verified']);
    Route::get('/assets', [AdminController::class, 'adminAssets'])->name('index.admin.assets')->middleware(['admin', 'admin.verified']);
    Route::post('/assets/{id}/update', [AdminController::class, 'adminEditAssets'])->name('update.admin.assets')->middleware(['admin', 'admin.verified']);
    Route::post('/assets/store', [AdminController::class, 'adminStoreAssets'])->name('store.admin.assets')->middleware(['admin', 'admin.verified']);
});


Route::prefix('assets/dashboard')->group(function () {
    Route::prefix('nbc')->group(function () {
        Route::get('view', [NBCController::class, 'view'])->name('nbc.view')->middleware(['assets', 'assets.verified']);
    });

    Route::get('/register', [AssetsController::class, 'AssetsRegister'])->name('assets.register');
    // Route::post('/logout', [AssetsController::class, 'AssetsLogout'])->name('assets.logout');
    Route::post('/register/create', [AssetsController::class, 'AssetsRegisterStore'])->name('assets.register.store');
    Route::get('/', [AssetsController::class, 'Dashboard'])->name('assets.dashboard')->middleware(['assets', 'assets.verified']);

    Route::get('/profile', [ProfileController::class, 'indexProfileAssets'])->name('index.profile.assets')->middleware(['assets', 'assets.verified']);
    Route::post('/profile/{id}/update-img', [ProfileController::class, 'updateImagesAssets'])->name('update.images.assets')->middleware(['assets', 'assets.verified']);
    Route::post('/profile/{id}/update-profile', [ProfileController::class, 'updateProfileAssets'])->name('update.profile.assets')->middleware(['assets', 'assets.verified']);
    Route::post('/profile/{id}/update-password', [ProfileController::class, 'updatePasswordAssets'])->name('update.password.assets')->middleware(['assets', 'assets.verified']);


    Route::get('/knowledge', [KnowledgeController::class, 'indexKnowledge'])->name('index.knowledge')->middleware(['assets', 'assets.verified']);
    Route::post('/knowledge/store', [KnowledgeController::class, 'store'])->name('store.knowledge')->middleware(['assets', 'assets.verified']);
    Route::post('/knowledge/update/{id}', [KnowledgeController::class, 'update'])->name('update.knowledge')->middleware(['assets', 'assets.verified']);
    Route::delete('/knowledge/delete/{id}', [KnowledgeController::class, 'delete'])->name('delete.knowledge')->middleware(['assets', 'assets.verified']);

    Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('index.pertanyaan')->middleware(['assets', 'assets.verified']);
    Route::get('/pertanyaan/create', [PertanyaanController::class, 'create'])->name('create.pertanyaan')->middleware(['assets', 'assets.verified']);
    Route::post('/pertanyaan/store', [PertanyaanController::class, 'store'])->name('store.pertanyaan')->middleware(['assets', 'assets.verified']);
    Route::post('/pertanyaan/update/{id}', [PertanyaanController::class, 'update'])->name('update.pertanyaan')->middleware(['assets', 'assets.verified']);
    Route::delete('/pertanyaan/delete/{id}', [PertanyaanController::class, 'delete'])->name('delete.pertanyaan')->middleware(['assets', 'assets.verified']);

    Route::get('/respon', [ResponController::class, 'index'])->name('index.respon')->middleware(['assets', 'assets.verified']);
    Route::get('/respon/create', [ResponController::class, 'create'])->name('create.respon')->middleware(['assets', 'assets.verified']);
    Route::post('/respon/store', [ResponController::class, 'store'])->name('store.respon')->middleware(['assets', 'assets.verified']);
    Route::post('/respon/update/{id}', [ResponController::class, 'update'])->name('update.respon')->middleware(['assets', 'assets.verified']);
    Route::delete('/respon/delete/{id}', [ResponController::class, 'delete'])->name('delete.respon')->middleware(['assets', 'assets.verified']);

    Route::get('/studio', [StudioController::class, 'index'])->name('index.studio')->middleware(['assets', 'assets.verified']);
    Route::get('/studio/create', [StudioController::class, 'create'])->name('create.studio')->middleware(['assets', 'assets.verified']);
    Route::post('/studio/store', [StudioController::class, 'store'])->name('store.studio')->middleware(['assets', 'assets.verified']);
    Route::post('/studio/{id}/images/store', [StudioController::class, 'storeImagesStudio'])->name('store.image.studio')->middleware(['assets', 'assets.verified']);
    Route::get('/studio/{id}/images', [StudioController::class, 'imageStudio'])->name('index.imageStudio')->middleware(['assets', 'assets.verified']);
    Route::post('/studio/images/{img_id}/update', [StudioController::class, 'updateImagesStudio'])->name('update.imageStudio')->middleware(['assets', 'assets.verified']);
    Route::delete('/studio/images/{img_id}/delete', [StudioController::class, 'deleteImagesStudio'])->name('delete.imageStudio')->middleware(['assets', 'assets.verified']);

    Route::get('/bot', [ChatbotController::class, 'Index_assets'])->name('index.bot.assets')->middleware(['assets', 'assets.verified']);
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('index.transaksi')->middleware(['assets', 'assets.verified']);
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('create.transaksi')->middleware(['assets', 'assets.verified']);
    Route::get('/transaksi/studio', [TransaksiController::class, 'pilihStudio'])->name('pilihStudio.transaksi')->middleware(['assets', 'assets.verified']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'view'])->name('view.transaksi')->middleware(['assets', 'assets.verified']);
    Route::get('/transaksi/user/{id}', [TransaksiController::class, 'IndexUser'])->name('indexUser.transaksi')->middleware(['assets', 'assets.verified']);
    Route::post('/transaksi/users/store', [AssetsController::class, 'storeUser'])->name('storeUser.transaksi')->middleware(['assets', 'assets.verified']);
    Route::get('/transaksi/create/user/{id_user}/studio/{studio}', [TransaksiController::class, 'formPemesanan'])->name('formPemesanan.transaksi')->middleware(['assets', 'assets.verified']);
    Route::get('/transaksi/{id}/cancel', [TransaksiController::class, 'transaksiCancelAssets'])->name('cancel.transaksi.assets')->middleware(['assets', 'assets.verified']);
    Route::post('/transaksi/store/{id_studio}/{id_user}', [TransaksiController::class, 'storeTransaksiAsset'])->name('store.transaksi.assets')->middleware(['assets', 'assets.verified']);
    Route::post('/transaksi/{id}/extends', [TransaksiController::class, 'extends'])->name('extends.transaksi.assets')->middleware(['assets', 'assets.verified']);
    Route::post('/transaksi/{id}/selesai', [TransaksiController::class, 'selesai'])->name('selesai.transaksi.assets')->middleware(['assets', 'assets.verified']);

    Route::get('/pembayaran', [PembayaranController::class, 'indexAssets'])->name('index.assets.pembayaran')->middleware(['assets', 'assets.verified']);
    Route::post('/pembayaran/{id}/verif', [PembayaranController::class, 'assetsVerif'])->name('verif.assets.pembayaran')->middleware(['assets', 'assets.verified']);
});


Route::prefix('manager/dashboard')->group(function () {
    Route::get('/register', [ManagerController::class, 'ManagerRegister'])->name('manager.register');
    // Route::post('/logout', [ManagerController::class, 'ManagerLogout'])->name('manager.logout');
    Route::post('/register/create', [ManagerController::class, 'ManagerRegisterStore'])->name('manager.register.store');
    Route::get('/', [ManagerController::class, 'Dashboard'])->name('manager.dashboard')->middleware(['manager', 'manager.verified']);

    Route::get('/profile', [ProfileController::class, 'indexProfileManager'])->name('index.profile.manager')->middleware(['manager', 'manager.verified']);
    Route::post('/profile/{id}/update-img', [ProfileController::class, 'updateImagesManager'])->name('update.images.manager')->middleware(['manager', 'manager.verified']);
    Route::post('/profile/{id}/update-profile', [ProfileController::class, 'updateProfileManager'])->name('update.profile.manager')->middleware(['manager', 'manager.verified']);
    Route::post('/profile/{id}/update-password', [ProfileController::class, 'updatePasswordManager'])->name('update.password.manager')->middleware(['manager', 'manager.verified']);

    Route::get('/data-penyewa', [ManagerController::class, 'dataPenyewa'])->name('index.dataPenyewa.manager')->middleware(['manager', 'manager.verified']);
    Route::get('/transaksi', [TransaksiController::class, 'indexMangerTransaksi'])->name('index.manager.transaksi')->middleware(['manager', 'manager.verified']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'viewTransaksiManager'])->name('view.manager.transaksi')->middleware(['manager', 'manager.verified']);

    Route::get('/report', [ReportController::class, 'index'])->name('index.report')->middleware(['manager', 'manager.verified']);
    Route::get('/report/{id}', [ReportController::class, 'report'])->name('get.report')->middleware(['manager']);
    Route::post('/report/period', [ReportController::class, 'customPeriod'])->name('custom.report')->middleware(['manager']);
    Route::post('/report/pdf', [ReportController::class, 'pdf'])->name('pdf.report')->middleware(['manager', 'manager.verified']);
});






Route::get('/', function () {
    return view('users.pages.home.index_user');
})->name('dashboard');

Route::get('/studio', [StudioController::class, 'index_user'])->name('user.studio');
Route::get('/studio/{id}', [StudioController::class, 'detailStudioUser'])->name('detail.studio.user');
Route::get('/order-summary/{id}', [OrderController::class, 'indexOrder'])->name('order.studio.user')->middleware(['auth', 'verified']);
Route::get('/transaksi', [TransaksiController::class, 'indexTransaksiUser'])->name('index.transaksi.user')->middleware(['auth', 'verified']);
Route::get('/transaksi/{id}', [TransaksiController::class, 'viewTransaksiUser'])->name('view.transaksi.user')->middleware(['auth', 'verified']);
Route::post('/transaksi/store/{id}', [TransaksiController::class, 'storeTransaksiUser'])->name('store.transaksi.user')->middleware(['auth', 'verified']);

Route::post('/tagihan/{id}/payments', [PembayaranController::class, 'userStore'])->name('store.pembayaran.user')->middleware(['auth', 'verified']);

Route::get('/inv', [TransaksiController::class,  'viewInvoice'])->name('view.invoice');

Route::get('/profile', [ProfileController::class, 'indexProfile'])->name('index.profile')->middleware(['auth', 'verified']);
Route::post('/profile/{id}/update-img', [ProfileController::class, 'updateImagesUser'])->name('update.images.user')->middleware(['auth', 'verified']);
Route::post('/profile/{id}/update-profile', [ProfileController::class, 'updateProfileUser'])->name('update.profile.user')->middleware(['auth', 'verified']);
Route::post('/profile/{id}/update-password', [ProfileController::class, 'updatePasswordUser'])->name('update.password.user')->middleware(['auth', 'verified']);

Route::get('/dashboard/login', [LoginController::class, 'Index'])->name('login_form');
Route::post('dashboard/auth', [LoginController::class, 'Login'])->name('dashboard.login');

Route::get('/chatbot', [ChatbotController::class, 'Index'])->name('index.chatbot')->middleware('auth');
Route::post('/chatbot/stemming', [TextProcessingController::class, 'Stemmingg'])->name('stemming.chatbot');
Route::post('/chatbot/get', [ClassificationController::class, 'classification'])->name('index.class');
Route::post('/chatbot/listen', [ChatbotController::class, 'listening'])->name('listen');
Route::post('/chatbot/bm', [BoyerMooreController::class, 'hasilBooyerMore'])->name('bm');

Route::get('/setWebhook', [BOTTelegramController::class, 'setWebhook']);
Route::post('/{token}/webhook', [BOTTelegramController::class, 'commandHandlerWebhook']);
Route::get('send-mail', [emailController::class, 'sendInvoice']);



require __DIR__ . '/auth.php';
