<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| 管理画面
|--------------------------------------------------------------------------
*/

Route::get('redis1', [\App\Http\Controllers\RedisController::class, 'redis1']);
Route::get('redis2', [\App\Http\Controllers\RedisController::class, 'redis2']);

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

Route::get('s', function () {
//    $redis = new \Illuminate\Support\Facades\Redis();
    $redis = new Redis();
    $redis->connect('redis', 6379);
//    $redis->set('key', 'value', 10);
    dd($redis->get('key'));
});



