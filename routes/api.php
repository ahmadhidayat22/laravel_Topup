<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\DigiflazController;
use App\Http\Controllers\Api\MidtransController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(DigiflazController::class)->prefix('product')->group(function(){
    Route::post('/get-saldo','get_saldo');
    Route::post('/get-product-prepaid','get_product_prepaid');
    Route::post('/get-product-pasca','get_product_pasca');
});

Route::controller(MidtransController::class)->prefix('transaction')->group(function (){
    Route::post('/tes' , 'create')->name('Deposit');
    Route::post('/topUp', 'topUp')->name('topup');

});


Route::post('/midtrans-webhook',[MidtransController::class , 'midtrans_hook']);

