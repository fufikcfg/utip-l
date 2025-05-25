<?php

use App\Kernel\Http\Middleware\AdminOnly;
use App\Kernel\Http\Middleware\LogChangeRequests;
use App\Modules\Posts\UI\API\V1\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/posts')->middleware('api')->group(function () {

    Route::get('/', [PostController::class, 'index']);

    Route::get('/{id}', [PostController::class, 'show']);

    Route::middleware(['auth:sanctum', AdminOnly::class, LogChangeRequests::class])->group(function () {

        Route::post('/', [
            PostController::class, 'store'
        ]);

        Route::put('/{id}', [
            PostController::class, 'update'
        ]);

        Route::delete('/{id}', [
            PostController::class, 'destroy'
        ]);
    });
});
