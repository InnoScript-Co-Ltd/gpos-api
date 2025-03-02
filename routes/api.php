<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::get('/profile', [AuthController::class, 'profile']);
        });

        Route::prefix('user')->group(function () {
            Route::post('/', [UserController::class, 'store']);
            Route::post('/{id}', [UserController::class, 'update']);
            Route::get('/', [UserController::class, 'index']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });

        Route::prefix('category')->group(function () {
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('/{id}', [CategoryController::class, 'update']);
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/{id}', [CategoryController::class, 'show']);
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
        });

        Route::prefix('item')->group(function () {
            Route::post('/', [ItemController::class, 'store']);
            Route::post('/{id}', [ItemController::class, 'update']);
            Route::get('/', [ItemController::class, 'index']);
            Route::get('/{id}', [ItemController::class, 'show']);
            Route::delete('/{id}', [ItemController::class, 'destroy']);
        });

        Route::prefix('invoice')->group(function () {
            Route::post('/', [InvoiceController::class, 'store']);
            Route::get('/', [InvoiceController::class, 'index']);
            Route::get('/{id}', [InvoiceController::class, 'show']);
        });

        Route::prefix('setting')->group(function () {
            Route::post('/', [SettingController::class, 'update']);
            Route::get('/', [SettingController::class, 'show']);
        });

        Route::prefix('invoice-item')->group(function () {
            Route::get('/', [InvoiceItemController::class, 'index']);
            Route::get('/{id}', [InvoiceItemController::class, 'show']);
        });
        Route::prefix('customer')->group(function () {
            Route::post('/', [CustomerController::class, 'store']);
            Route::get('/', [CustomerController::class, 'index']);
            Route::get('/{id}', [CustomerController::class, 'show']);
            Route::delete('/{id}', [CustomerController::class, 'destroy']);
            Route::post('/{id}', [CustomerController::class, 'update']);
        });
    });
});
