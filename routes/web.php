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
Route::get('/', LoginController::class)->name('login');
Route::post('/', [LoginController::class, 'store'])->name('login.store');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Registrarse
Route::get('/register', RegisterController::class)->name('register');
Route::get('/formRegister', RegisterController::class)->name('formRegister');
Route::post('formRegister', [RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    //Producto
    Route::get('/listaProductos', [ProductoController::class, 'listar'])->name('listaProductos');

    //Usuario
    Route::get('/datosPersonales/{id}', UsuarioController::class)->name('datosPersonales');
    Route::post('createUser', [UsuarioController::class, 'store'])->name('createUser');
    Route::put('datosPersonalesUpdate/{id}', [UsuarioController::class, 'update'])->name('datosPersonalesUpdate');
    Route::put('updatePassword/{id}', [UsuarioController::class, 'updatePassword'])->name('updatePassword');

    //Listado de usuarios
    Route::get('/gestionUsuario', [UsuarioController::class, 'gestionUsuarioView'])->name('gestionUsuario');

    //borrar usuario
    Route::delete('/borrarUsuario/{usuario}', [UsuarioController::class, 'borrarUsuario'])->name('borrarUsuario');

    //ascender
    Route::put('ascenderUsuario/{usuario_id}', [UsuarioController::class, 'ascenderUsuario'])->name('ascenderUsuario');

    //descender
    Route::put('descenderUsuario/{usuario_id_des}', [UsuarioController::class, 'descenderUsuario'])->name('descenderUsuario');
});