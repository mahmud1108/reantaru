<?php

use App\Http\Controllers\Admin\AtributController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LoginAdminController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\VarianController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\ShopController;
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

Route::view('admin/', 'admin.login')->name('login-admin');
Route::post('admin/login', [LoginAdminController::class, 'login'])->name('login-act');


Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin'
], function () {
    route::get('dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
    route::get('logout', [LoginAdminController::class, 'logout'])->name('admin-logout');

    route::resource('kategori', KategoriController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('produk', ProdukController::class);
    Route::resource('varian', VarianController::class);
    Route::resource('atribut', AtributController::class);
});

// SHOP
Route::get('/', [ShopController::class, 'index'])->name('shop-index');
Route::get('/kategori/{slug}', [ShopController::class, 'satu_kategori'])->name('satu-kategori');

Route::get('/login', [ShopController::class, 'login_form'])->name('login_register_customer');
Route::post('/register_act', [ShopController::class, 'register_act'])->name('register_act_customer');
Route::get('/login_act', [ShopController::class, 'login_act'])->name('login_act_customer');
Route::get('/produk', [ShopController::class, 'produk'])->name('produk');
Route::get('/kategori', [ShopController::class, 'all_kategori'])->name('all_kategori');
Route::get('/tentang', [ShopController::class, 'tentang'])->name('tentang');


Route::group([
    'middleware' => 'customer'
], function () {
    route::resource('cart', CartController::class);
});
