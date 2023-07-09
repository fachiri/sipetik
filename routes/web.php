<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ReportController::class, 'landing'])->name('home');
Route::view('/about', 'about')->name('about');

Route::group(["middleware" => ['role:PENGGUNA']], function() {
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
});

Route::group(["middleware" => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'redirect.if.user']], function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::post('/report/verified/{reportId}', [ReportController::class, 'report_verified'])->name('report.verified');

    Route::get('/pengaduan', [ReportController::class, 'pengaduan'])->name('pengaduan');
    Route::get('/pengaduan/detail/{reportId}', [ReportController::class, 'pengaduan_detail'])->name('pengaduan.detail');
    Route::get('/pengaduan/edit/{reportId}', [ReportController::class, 'pengaduan_edit'])->name('pengaduan.edit');
    Route::get('/permintaan', [ReportController::class, 'permintaan'])->name('permintaan');
    Route::get('/permintaan/detail/{reportId}', [ReportController::class, 'permintaan_detail'])->name('permintaan.detail');
    Route::get('/permintaan/edit/{reportId}', [ReportController::class, 'permintaan_edit'])->name('permintaan.edit');
    Route::get('/saran', [ReportController::class, 'saran'])->name('saran');
    Route::get('/saran/detail/{reportId}', [ReportController::class, 'saran_detail'])->name('saran.detail');
    Route::get('/saran/edit/{reportId}', [ReportController::class, 'saran_edit'])->name('saran.edit');

    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::view('/laporan', "pages.laporan.laporan-data")->name('laporan');
});
