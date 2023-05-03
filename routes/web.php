<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AtributoController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\CompraController;

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

    /*------ Calendario ------*/
    Route::get('/calendario', CalendarioController::class)->name('calendario');

    /*------ Tramitar compra ------*/
    Route::get('/tramitarCompra', CompraController::class)->name('tramitarCompra');

    /*------ Producto ------*/
    Route::get('/listaProductos', [ProductoController::class, 'listar'])->name('listaProductos');
    Route::get('/listaProductosBaja', [ProductoController::class, 'listarBaja'])->name('listaProductosBaja');
    Route::delete('/borrarProducto/{producto}', [ProductoController::class, 'borrarProducto'])->name('borrarProducto');
    Route::post('createProduct', [ProductoController::class, 'store'])->name('createProduct');
    Route::post('editProducto/{producto}', [ProductoController::class, 'updateProducto'])->name('editProducto');
    Route::get('/detallesProducto/{id}', [ProductoController::class, 'detallesProducto'])->name('detallesProducto');
    Route::put('detallesProductoUpdate/{id}', [ProductoController::class, 'update'])->name('detallesProductoUpdate');
    Route::delete('/altaProducto/{producto}', [ProductoController::class, 'altaProducto'])->name('altaProducto');
    Route::post('addLote/{producto}', [ProductoController::class, 'addLote'])->name('addLote');

    /*------ Lotes ------*/
    Route::get('/listaLotes', LoteController::class)->name('listaLotes');
    Route::delete('/borrarLote/{lote}', [LoteController::class, 'borrarLote'])->name('borrarLote');
    Route::post('createLote', [LoteController::class, 'store'])->name('createLote');
    Route::get('/editarLote/{id}', [LoteController::class, 'editarLote'])->name('editarLote');
    Route::put('editarLoteUpdate/{id}', [LoteController::class, 'update'])->name('editarLoteUpdate');
    Route::get('/gestionLotesEliminados', [LoteController::class, 'gestionLotesEliminados'])->name('gestionLotesEliminados');
    Route::delete('/altaLote/{lote}', [LoteController::class, 'altaLote'])->name('altaLote');

    /*------ Proveedor ------*/
    Route::get('/listaProveedores', ProveedorController::class)->name('listaProveedores');
    Route::get('/perfilProveedor/{id}', [ProveedorController::class, 'perfilProveedor'])->name('perfilProveedor');
    Route::delete('/borrarProveedor/{proveedor}', [ProveedorController::class, 'borrarProveedor'])->name('borrarProveedor');
    Route::post('createProveedor', [ProveedorController::class, 'store'])->name('createProveedor');
    Route::get('/listaProveedoresBaja', [ProveedorController::class, 'listaProveedoresBaja'])->name('listaProveedoresBaja');
    Route::delete('/altaProveedor/{proveedor}', [ProveedorController::class, 'altaProveedor'])->name('altaProveedor');
    Route::put('editarProveedor/{id}', [ProveedorController::class, 'update'])->name('editarProveedor');

    /*------ Usuario ------*/
    Route::get('/datosPersonales/{id}', UsuarioController::class)->name('datosPersonales');
    Route::post('createUser', [UsuarioController::class, 'store'])->name('createUser');
    Route::put('datosPersonalesUpdate/{id}', [UsuarioController::class, 'update'])->name('datosPersonalesUpdate');
    Route::put('updatePassword/{id}', [UsuarioController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/gestionUsuario', [UsuarioController::class, 'gestionUsuarioView'])->name('gestionUsuario');
    Route::get('/gestionUsuarioBaja', [UsuarioController::class, 'gestionUsuarioBaja'])->name('gestionUsuarioBaja');
    Route::delete('/altaUsuario/{usuario}', [UsuarioController::class, 'altaUsuario'])->name('altaUsuario');
    Route::delete('/borrarUsuario/{usuario}', [UsuarioController::class, 'borrarUsuario'])->name('borrarUsuario');
    Route::put('ascenderUsuario/{usuario_id}', [UsuarioController::class, 'ascenderUsuario'])->name('ascenderUsuario');
    Route::put('descenderUsuario/{usuario_id_des}', [UsuarioController::class, 'descenderUsuario'])->name('descenderUsuario');

    /*------ Atributos ------*/
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

    /*------ Configuracion ------*/
    Route::get('/configuracion', ConfiguracionController::class)->name('configuracion');
    Route::get('/listarImagenes', [ConfiguracionController::class, 'listarImagenes'])->name('listarImagenes');

    //cambiarImagen
    Route::patch('/actualizarImagen', [ProductoController::class, 'actualizarImagen'])->name('actualizarImagen');

    //subirImagen
    Route::patch('/subirImagen', [ConfiguracionController::class, 'subirImagen'])->name('subirImagen');

    //eliminarImagen
    Route::patch('/eliminarImagen', [ConfiguracionController::class, 'eliminarImagen'])->name('eliminarImagen');
});
