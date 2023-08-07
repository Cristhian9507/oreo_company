<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $usuarios = User::orderBy("id")->get();
    return view('usuarios.index', compact('usuarios'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $usuario = User::find($id);
    if(isset($usuario->id)) {
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
        'fecha_nacimiento' => 'Fecha de nacimiento',
        'ciudad_id' => 'Ciudad'
      ];
      $request->validate([
        'nombre' => 'required|string|max:100|min:3',
        'celular' => 'string|max:10',
        'fecha_nacimiento' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
      ], $messages, $attributes);
      $usuario->nombre = $request->nombre;
      $usuario->celular = $request->celular;
      $usuario->fecha_nacimiento = $request->fecha_nacimiento;
      $usuario->perfil_id = $request->perfil;
      if($usuario->save()) {
        return response()->json(["mensaje" => "El usuario ha sido modificado satisfactoriamente."], 200);
      } else {
        return response()->json(["mensaje" => "Ups, suceido un error tratando de actualizar el usuario."], 400);
      }
    } else {
      return response()->json(["mensaje" => "Ups, no se pudo encontrar este usuario"], 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function filtrarUsuarios(Request $request) {
    $filtro = $request->filtro;
    $usuarios = User::where('nombre', 'ilike', "%$filtro%")
                  ->orWhere('identificacion', 'ilike', "%$filtro%")
                  ->orWhere('celular', 'ilike', "%$filtro%")
                  ->orWhere('email', 'ilike', "%$filtro%")
                  ->orderBy("id")
                  ->get();
    return view('usuarios.tabla_usuarios_filtrados', compact('usuarios'));
  }

  public function obtenerDatosUsuario(Request $request){
    $usuario = User::find($request->idUsuario);
    if(isset($usuario->id)){
      $perfiles = Perfil::all();
      return view('usuarios.data-usuarios-modal', compact('usuario', 'perfiles'));
    } else {
      return response()->json(["mensaje" => "Ups, no se pudo encontrar este usuario"], 404);
    }
  }
}
