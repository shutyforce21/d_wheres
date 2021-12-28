<?php

use App\Http\Controllers\SpotController;
use Illuminate\Http\Request;
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

//練習スポット
Route::resource('/spots', SpotController::class)->only(['index', 'store']);


// 新規登録
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
// ログイン
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
// プロフィール設定
Route::post('/profile/store', [\App\Http\Controllers\ProfileController::class, 'store']);
// プロフィール表示
Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show']);

// ユーザー
//Route::middleware('auth:users')->group(function() {
    Route::get('/u', function (Request $request) {
        dd(\Illuminate\Support\Facades\Auth::id());
    });
    // フォロー
    Route::get('/follow/{followed_id}', [\App\Http\Controllers\UserController::class, 'follow']);
//});

Route::get('/s', function () {

});

// CORSを許可
//Route::middleware(['cors'])->group(function () {
//    Route::get('/a', [\App\Http\Controllers\AuthController::class, 'sample']);
//});

?>

