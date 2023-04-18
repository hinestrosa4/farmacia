<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AtributoController;
use App\Http\Controllers\CalendarioController;

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

    //Calendario
    Route::get('/calendario', CalendarioController::class)->name('calendario');

    //Producto
    Route::get('/listaProductos', [ProductoController::class, 'listar'])->name('listaProductos');
    Route::delete('/borrarProducto/{producto}', [ProductoController::class, 'borrarProducto'])->name('borrarProducto');
    Route::post('createProduct', [ProductoController::class, 'store'])->name('createProduct');

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

    //Atributos
    Route::get('/gestionAtributos', AtributoController::class)->name('gestionAtributos');

    //Laboratorio
    Route::post('createLab', [AtributoController::class, 'storeLab'])->name('createLab');
    Route::delete('/borrarLab/{laboratorio}', [AtributoController::class, 'borrarLab'])->name('borrarLab');
    Route::post('editLab/{laboratorio}', [AtributoController::class, 'updateLab'])->name('editLab');

    //Tipo
    Route::post('createTipo', [AtributoController::class, 'storeTipo'])->name('createTipo');
    Route::delete('/borrarTipo/{tipo}', [AtributoController::class, 'borrarTipo'])->name('borrarTipo');
    Route::post('editTipo/{tipo}', [AtributoController::class, 'updateTipo'])->name('editTipo');

    //Presentacion
    Route::post('createPresentacion', [AtributoController::class, 'storePresentacion'])->name('createPresentacion');
    Route::delete('/borrarPre/{presentacion}', [AtributoController::class, 'borrarPre'])->name('borrarPre');
    Route::post('editPre/{presentacion}', [AtributoController::class, 'updatePre'])->name('editPre');

});
