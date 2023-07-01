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
    Route::view('/report', 'report')->name('report');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
});

Route::group(["middleware" => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'redirect.if.user']], function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');
});
