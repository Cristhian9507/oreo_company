<?php

use App\Http\Controllers\ApiRestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
  Auth::logout();
  return redirect()->route('login');
});

Route::group(['middleware' => 'admin'], function () {
  // Rutas solo acceisbles por el admin
  Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
  Route::get('/registro', [RegistroController::class, 'formularioRegistro'])->name('formularioRegistro');
  Route::post('/registrar', [RegistroController::class, 'registrar'])->name('registrar');
  Route::get('/filtrar-usuarios', [UserController::class, 'filtrarUsuarios'])->name('filtrar-usuarios');
  Route::get('/usuarios/obtener-datos-usuario', [UserController::class, 'obtenerDatosUsuario'])->name('usuarios/obtener-datos-usuario');
  Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
  Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.eliminacion');
  // Relacionado con APIREST
  Route::get('/apirest', [ApiRestController::class, 'index'])->name('apirest');
  Route::get('/apirest/filtrar-posts', [ApiRestController::class, 'filtrarPosts'])->name('apirest/filtrar-posts');
  Route::get('/apirest/ver-usuario/{id}', [ApiRestController::class, 'verUsuario'])->name('apirest/ver-usuario');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'formularioLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logeados', [LoginController::class, 'logeados'])->name('logeados');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/buscar-paises', [PaisController::class, 'buscarPaises'])->name('buscar.paises');
Route::get('/buscar-departamentos', [DepartamentoController::class, 'buscarDepartamentos'])->name('buscar.departamentos');
Route::get('/buscar-ciudades', [CiudadController::class, 'buscarCiudades'])->name('buscar.ciudades');

