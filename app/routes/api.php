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
Route::get('/a', function () {
    return response()->json(['messaege' => 'ok'], 200);
});

?>

