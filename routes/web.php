<?php

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
    return view('welcome');
});

Route::get('/logout', function () {
  Auth::logout();
  return redirect()->route('login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'formularioLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/registro', [RegistroController::class, 'formularioRegistro'])->name('formularioRegistro');
Route::post('/registrar', [RegistroController::class, 'registrar'])->name('registrar');;
Route::get('/logeados', [LoginController::class, 'logeados'])->name('logeados');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
Route::get('/buscar-paises', [PaisController::class, 'buscarPaises'])->name('buscar.paises');
Route::get('/buscar-departamentos', [DepartamentoController::class, 'buscarDepartamentos'])->name('buscar.departamentos');
Route::get('/buscar-ciudades', [CiudadController::class, 'buscarCiudades'])->name('buscar.ciudades');
Route::get('/filtrar-usuarios', [UserController::class, 'filtrarUsuarios'])->name('filtrar-usuarios');
