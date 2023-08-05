<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  protected $redirectTo = RouteServiceProvider::HOME;

  public function __construct()
  {
    $this->middleware('guest');
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'nombre' => ['required', 'string', 'max:100'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'identificacion' => ['required', 'string', 'max:11'],
      'fecha_nacimiento' => ['required', 'string', 'max:10'],
      'ciudad_id' => ['required', 'integer'],
    ]);
  }

  protected function crear(array $data)
  {
    return User::create([
      'nombre' => $data['nombre'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'identificacion' => $data['identificacion'],
      'fecha_nacimiento' => $data['fecha_nacimiento'],
      'ciudad_id' => $data['ciudad_id'],
      'celular' => $data['celular'],
      'perfil_id' => $data['perfil_id'],
    ]);
  }

  public function formularioRegistro() {
    return view('auth.registro');
  }
}
