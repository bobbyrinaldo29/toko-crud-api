<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'api'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::group(['middleware' => ['auth']], function() {
        Route::apiResource('barang', BarangController::class);
        Route::apiResource('penjualan', PenjualanController::class);
        // Route::get('penjualan/page', [PenjualanController::class, 'getByDate'])->name('penjualan.getByDate');
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });
});

