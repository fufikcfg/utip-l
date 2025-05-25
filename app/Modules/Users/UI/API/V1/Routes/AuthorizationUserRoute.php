<?php

use App\Modules\Users\UI\API\V1\Controllers\AuthorizationUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/users/authorization')->middleware('api')->group(function () {

    Route::post('/registration', [AuthorizationUserController::class, 'registration']);

    Route::post('/login', [AuthorizationUserController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/exit', [
            AuthorizationUserController::class, 'exit'
        ]);

        Route::get('/verify', [
            AuthorizationUserController::class, 'verify'
        ]);

        Route::post('/avatar', [
            AuthorizationUserController::class, 'avatar'
        ]);

    });
});
