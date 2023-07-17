<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\UserController;
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
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/shop', function () {
    return view('shop');
});
Route::get('/shop-single', function () {
    return view('shop-single');
});
Auth::routes(['verify' => true]);
// Private Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/1home', [App\Http\Controllers\HomeController::class, 'index'])->name('1home');
    Route::get('/without/breadcrumbs', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
});

Route::fallback(function () {
    abort(404);
});
