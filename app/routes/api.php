<?php

use App\Http\Controllers\SpotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

//マスタデータ
Route::get('/master', [\App\Http\Controllers\MasterController::class, 'getMaster']);

//認証ユーザーのみ
Route::middleware('auth:users')->group(function() {
    //練習スポット
    Route::resource('/spots', SpotController::class)->only(['store']);
});

//ゲスト&認証ユーザーのみ
Route::resource('/spots', SpotController::class)->only(['index', 'show']);
Route::resource('/users', \App\Http\Controllers\UserController::class)->only(['index']);
// 新規登録
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
// ログイン
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
// 認証ルート
Route::middleware('auth:users')->group(function() {
    // ログアウト
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    //tokenが認証済みかどうか(api通信が無いページ用)
    Route::get('/is_authenticated', [\App\Http\Controllers\AuthController::class, 'isAuthenticated']);
    // プロフィールリソース
    Route::resource('/profiles', \App\Http\Controllers\ProfileController::class)->only(['show']);
    // プロフィール更新 ※tokenでIDを識別するためリソースから分離
    Route::put('/profiles', [\App\Http\Controllers\ProfileController::class, 'update']);
    // フォロー
    Route::get('/follow/{followed_id}', [\App\Http\Controllers\UserController::class, 'follow']);
    // アンフォロー
    Route::get('/unfollow/{followed_id}', [\App\Http\Controllers\UserController::class, 'unfollow']);
    // フォロー中のユーザーを取得する
    Route::get('/follows', [\App\Http\Controllers\FollowController::class, 'getFollows']);
    // フォロー中のユーザーを取得する
    Route::get('/followers', [\App\Http\Controllers\FollowController::class, 'getFollowers']);
});

Route::get('u', function () {

});

?>

