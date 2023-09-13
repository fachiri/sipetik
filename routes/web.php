<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
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
Route::get('/public_dashboard', [DashboardController::class, 'public_dashboard'])->name('dashboard.public_dashboard');
Route::view('/about', 'about')->name('about');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
Route::get('/chat/read/{reportId}', [ChatController::class, 'read_chats'])->name('chat.read');
Route::get('/get-chats/{reportId}', [ChatController::class, 'get_chats']);
Route::get('/get-total-chat/{userId}', [ChatController::class, 'get_total_chat'])->name('chat.total');

Route::group(["middleware" => ['role:PENGGUNA']], function() {
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
});

Route::group(["middleware" => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'redirect.if.user']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/report/verified/{reportId}', [ReportController::class, 'report_verified'])->name('report.verified');
    Route::post('/report/process/{reportId}', [ReportController::class, 'report_process'])->name('report.process');
    Route::post('/report/finish/{reportId}', [ReportController::class, 'report_finish'])->name('report.finish');

    Route::get('/pengaduan', [ReportController::class, 'pengaduan'])->name('pengaduan');
    Route::get('/pengaduan/detail/{reportId}', [ReportController::class, 'pengaduan_detail'])->name('pengaduan.detail');
    Route::get('/pengaduan/edit/{reportId}', [ReportController::class, 'pengaduan_edit'])->name('pengaduan.edit');
    Route::get('/permintaan', [ReportController::class, 'permintaan'])->name('permintaan');
    Route::get('/permintaan/detail/{reportId}', [ReportController::class, 'pengaduan_detail'])->name('permintaan.detail');
    Route::get('/permintaan/edit/{reportId}', [ReportController::class, 'pengaduan_edit'])->name('permintaan.edit');
    Route::get('/saran', [ReportController::class, 'saran'])->name('saran');
    Route::get('/saran/detail/{reportId}', [ReportController::class, 'pengaduan_detail'])->name('saran.detail');
    Route::get('/saran/edit/{reportId}', [ReportController::class, 'pengaduan_edit'])->name('saran.edit');

    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::get('/user/edit/{userId}', [UserController::class, "user_edit" ])->name('user.edit');
    Route::post('/user/update/{userId}', [UserController::class, "user_update" ])->name('user.update');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/export-laporan', [LaporanController::class, 'export_laporan'])->name('export.laporan');
    Route::get('/export-user', [LaporanController::class, 'export_user'])->name('export.user');
});
