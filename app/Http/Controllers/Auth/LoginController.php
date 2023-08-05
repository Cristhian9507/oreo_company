<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  protected $redirectTo = '/home';

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function formularioLogin($data = [])
  {
    return view('auth.login', $data);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $credenciales = $request->only('email', 'password');

    if (Auth::attempt($credenciales)) {
      return redirect()->intended('logeados')
        ->withSuccess('Usuario hizo login correctamente');
    }

    return $this->formularioLogin(['error' => 'Los datos introducidos no son correctos']);
  }

  public function logeados()
  {
    return view('welcome');
  }
}
