<?php

use app\packages\Tmp;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/a', function () {
    $t = new Tmp();
    dd($t->pennant());
=======
Route::get('/map', function () {
    return view('home');
>>>>>>> 3cdd4966f5e46dab9cf65606064608784029b0b0
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
