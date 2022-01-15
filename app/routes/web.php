<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| 管理画面
|--------------------------------------------------------------------------
*/

Route::get('/admin/spots', [\App\Http\Controllers\Admin\SpotController::class, 'index']);
Route::get('/admin/spots/activate', [\App\Http\Controllers\Admin\SpotController::class, 'activate']);
Route::get('/admin/spots/inactivate', [\App\Http\Controllers\Admin\SpotController::class, 'inactivate']);

