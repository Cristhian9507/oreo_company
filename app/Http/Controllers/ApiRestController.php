<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiRestController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    try {
      $client = new Client();
      $response = $client->get($url);
      $posts = json_decode($response->getBody(), false);
      // dd($posts);
      return view('apirest.index')->with('posts', $posts);
    } catch (\Exception $e) {
        // Manejar el error y retornar una vista de error si es necesario
        return view('error')->with('message', 'Error al obtener la data del apirest');
    }
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

  public function filtrarPosts(Request $request) {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    if($request->filtro !== "" && $request->filtro !== null) {
      $url .= '?userId='.$request->filtro;
    }
    try {
      $client = new Client();
      $response = $client->get($url);
      $posts = json_decode($response->getBody(), false);
      // return response()->json(["data" => $posts], 200);
      return view('apirest.index')->with('posts', $posts);
    } catch (\Exception $e) {
      return response()->json(["mensaje" => "Error al obtener la data del apirest"], 400);
    }
  }

  public function verUsuario(Request $request, $id) {
    try {
      $url = 'https://jsonplaceholder.typicode.com/users/'.$id;
      $client = new Client();
      $response = $client->get($url);
      $usuario = json_decode($response->getBody(), false);
      return view('apirest.detalle-usuario')->with('usuario', $usuario);
    } catch (\Exception $e) {
      return response()->json(["mensaje" => "Error al obtener la data del apirest"], 400);
    }
  }
}
