<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "api", "prefix" => "v1"], function ($router) {
    Route::prefix("auth")->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::middleware("auth:api")->group(function () {
        Route::prefix("auth")->group(function () {
            Route::post("/logout", [AuthController::class, 'logout']);
        });

        Route::prefix("user")->group(function () {
            Route::post("/", [UserController::class, 'store']);
            Route::put("/{id}", [UserController::class, 'update']);
            Route::get("/", [UserController::class, 'index']);
            Route::get("/{id}", [UserController::class, 'show']);
            Route::delete("/{id}", [UserController::class, 'destroy']);
        });
    });

});