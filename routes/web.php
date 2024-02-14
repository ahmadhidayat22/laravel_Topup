<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gameController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminCategoryController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/' , [ProductController::class, 'index'])->name('home');
Route::get('get_produk', [ProductController::class, 'get_produk'])->name('get_produk');
// Route::post('/product' , [gameController::class, 'store'])->name('home');
Route::get('/test' , [ProductController::class, 'test']);



Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('home');

Route::get('/cekPesanan' , function(){
    return view('cekPesanan');
})->name('cekpesanan');
Route::get('/cekPesanan/bayar' , [TransactionController::class, 'search'])->name('cekpesanan');




// Route::get('/cekPesanan/bayar' , function(){
//     return view('bayar');
// })->name('cekpesanan');
// Route::get('/cekPesanan/bayar' , function(){
//     return view('bayar');
// })->name('cekpesanan');




Route::get('/kalkulator' , function(){
    return view('kalkulator');
});
Route::get('/login' , [LoginController::class , 'index'])->name('sign')->middleware('guest');
Route::post('/login' , [LoginController::class , 'auth']);
Route::post('/logout' , [LoginController::class , 'logout']);

Route::get('/sign-up' ,[RegistrationController::class , 'index']);
Route::post('/sign-up' ,[RegistrationController::class , 'store']);


Route::get('/dashboard', function(){
    return view('user.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/dashboard/transaksi', function(){
    return view('user.transaksi');
})->name('transaksi')->middleware('auth');

Route::get('/dashboard/deposit', [DepositController::class , 'index'])->name('deposit')->middleware('auth');
Route::get('/deposit/detailDeposit/{transaksi:transaction_code}', [DepositController::class, 'show'])->name('deposit')->middleware('auth');

Route::get('/dashboard/mutasi', function(){
    return view('user.mutasi');
})->name('mutasi')->middleware('auth');

Route::get('/dashboard/laporan', function(){
    return view('user.laporan');
})->name('laporan')->middleware('auth');

Route::get('/dashboard/deposit/topup', function(){
    return view('user.topup');
})->name('deposit')->middleware('auth');

Route::post('/bayar', [DepositController::class, 'deposit']);
// Route::resource('/' , [TransactionController::class]);

// Route::get('game', function(){
//     return view('game');
// });

Route::get('admin', function(){
    return view('admin.dashboard');
})->name('dashboard-admin');

Route::get('admin/order', function(){
    return view('admin.order');
})->name('order-admin');

Route::get('admin/product/create/checkslug', [AdminProductController::class, 'checkslug']);
Route::get('admin/category/create/checkslugCategory', [AdminCategoryController::class, 'checkslugCategory']);
Route::resource('admin/product', AdminProductController::class);
Route::resource('admin/category', AdminCategoryController::class);

Route::get('admin/user', function(){
    return view('admin.user');
})->name('user-admin');

Route::get('admin/reports', function(){
    return view('admin.report');
})->name('reports-admin');




Route::get('/get-cat', [ProductController::class, 'sluggable']);