<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\TipoCambioLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  protected function validator(array $data)
  {
    $messages =  [
      'required' => 'El :attribute es un campo obligatorio.',
      'unique' => 'El :attribute que ingresaste ya se encuentra registrado en el sistema.',
      'max' => 'El :attribute no puede contener más de :max carácteres.',
      'min' => 'El :attribute debe de contener al menos :min carácteres.',
      'confirmed' => 'La :attribute debe de coincidir.',
      'before_or_equal' => 'La edad mínima es 18 años',
      'regex' => 'La :attribute debe de contener al menos un número'
    ];

    $attributes =
    [
      'nombre' => 'Nombre',
      'identificacion' => 'Número de Identificación',
      'email' => 'Correo electrónico',
      'password' => 'Contraseña',
      'fecha_nacimiento' => 'Fecha de nacimiento',
      'ciudad_id' => 'Ciudad'
    ];

    return Validator::make($data, [
      'nombre' => ['required', 'string', 'max:100', 'min:3'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/\d/'],
      'celular' => ['string', 'max:10'],
      'identificacion' => ['required', 'string', 'max:11'],
      'ciudad' => ['required', 'integer'],
      'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
      ]
      , $messages, $attributes
    );
  }

  protected function registrar(Request $request)
  {
    $validator = $this->validator($request->all());
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }
    $user = new User();
    $user->identificacion = $request->identificacion;
    $user->nombre = $request->nombre;
    $user->email = $request->email;
    $user->celular = $request->celular;
    $user->fecha_nacimiento = $request->fecha_nacimiento;
    $user->ciudad_id = $request->ciudad;
    $user->password = Hash::make($request->password);
    $user->perfil_id = 2;
    if($user->save()) {
      // registramos el log de tipo creación
      Log::registarLog(class_basename($user), TipoCambioLog::TIPO_CAMBIO_CREACION_ID, $user);
      return redirect()->route('usuarios')->with('success', 'Registro exitoso.');
    } else {
      dd("error");
    }
  }

  public function formularioRegistro()
  {
    return view('auth.registro');
  }
}
