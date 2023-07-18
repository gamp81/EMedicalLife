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
    Route::get('/tablero', [App\Http\Controllers\HomeController::class, 'index'])->name('tablero');
    Route::get('/without/breadcrumbs', [App\Http\Controllers\HomeController::class, 'about'])->name('about1');
    Route::resource('/admin/categoria',App\Http\Controllers\CategoriaController::class);
    Route::post('/categoria/registrar',[App\Http\Controllers\CategoriaController::class,'store'])->name('categoria.store');;
    Route::get('/categoria/lista',[App\Http\Controllers\CategoriaController::class,'lista'])->name('categoria.lista');
    Route::put('/categoria/actualizar',[App\Http\Controllers\CategoriaController::class,'update'])->name('categoria.actualizar');
    Route::put('/categoria/desactivar',[App\Http\Controllers\CategoriaController::class,'desactivar'])->name('categoria.desactivar');
    Route::put('/categoria/activar',[App\Http\Controllers\CategoriaController::class,'activar'])->name('categoria.activar');
    Route::resource('/admin/producto',App\Http\Controllers\ProductoController::class);
    Route::put('/producto/update', [App\Http\Controllers\ProductoController::class, 'update'])->name('producto.update');
    Route::put('/producto/delete', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('producto.delete');
    //Route::get('/api/producto/lista', [App\Http\Controllers\ProductoController::class, 'lista'])->name('producto.lista');
    Route::get('/api/producto/listarProductoVenta', [App\Http\Controllers\ProductoController::class, 'listarProductoVenta'])->name('producto.listarProductoVenta');
    Route::get('/producto/listarProducto',[App\Http\Controllers\ProductoController::class, 'listarProducto'])->name('producto.listarProducto');
    
});

Route::fallback(function () {
    abort(404);
});
