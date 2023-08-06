<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $usuarios = User::all();
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
    //
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
                  ->get();
    return view('usuarios.tabla_usuarios_filtrados', compact('usuarios'));
  }
}
