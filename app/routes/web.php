<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| 管理画面
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    //TODO csrf_tokenがmatchしていない！！
    // karnel/verfyCrsfToken->tokensMatchがおかしい

    Route::get('/v-login', function () {
        return view('admin.login');
    });

    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
    Route::get('/spots', [\App\Http\Controllers\Admin\SpotController::class, 'index']);

//    Route::middleware('auth:admin_users')->group(function() {
        Route::get('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout']);
        Route::get('/spots/{spot_id}/activate', [\App\Http\Controllers\Admin\SpotController::class, 'activate']);
        Route::get('/spots/{spot_id}/inactivate', [\App\Http\Controllers\Admin\SpotController::class, 'inactivate']);
//    });
});



