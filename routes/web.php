<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('admin/login', 'admin.login')->name('login-admin');
Route::post('admin/login', [LoginAdminController::class, 'login'])->name('login-act');

Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin'
], function () {
    route::get('dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
    route::get('logout', [LoginAdminController::class, 'logout'])->name('admin-logout');
});
