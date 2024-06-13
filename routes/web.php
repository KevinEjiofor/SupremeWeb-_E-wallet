<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController; // Add this line
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [UserController::class, 'getAllUsers']);
    Route::get('wallets', [WalletController::class, 'getAllWallets']);
    Route::get('wallets/{id}', [WalletController::class, 'getWalletDetails']);
    Route::post('wallets/transfer', [WalletController::class, 'transfer']);
});
