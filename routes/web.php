<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsuarioController;


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

// Route::get('/', function () {
//     return view('login.login');
// });

//Login
Route::get('/', App\Http\Controllers\LoginController::class)->name('login');
Route::post('/', [App\Http\Controllers\LoginController::class, 'store'])->name('login.store');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

//Registrarse
Route::get('/register', App\Http\Controllers\RegisterController::class)->name('register');
Route::get('/formRegister', App\Http\Controllers\RegisterController::class)->name('formRegister');
Route::post('formRegister', [App\Http\Controllers\RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    //Producto
    Route::get('/listaProductos', [App\Http\Controllers\ProductoController::class, 'listar'])->name('listaProductos');

    //Usuario
    Route::get('/datosPersonales', App\Http\Controllers\UsuarioController::class)->name('datosPersonales');
    Route::put('datosPersonalesUpdate/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('datosPersonalesUpdate');
    Route::put('updatePassword/{id}', [App\Http\Controllers\UsuarioController::class, 'updatePassword'])->name('updatePassword');

    //Listado de usuarios
    Route::get('/gestionUsuario', [App\Http\Controllers\UsuarioController::class, 'gestionUsuarioView'])->name('gestionUsuario');


});
