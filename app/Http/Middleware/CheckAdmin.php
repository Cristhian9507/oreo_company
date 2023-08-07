<?php

namespace App\Http\Middleware;

use App\Models\Perfil;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (auth()->check() && auth()->user()->perfil_id === Perfil::PERFIL_ADMINISTRADOR_ID) {
      return $next($request);
    }
    abort(403, 'Acceso no autorizado. Solo para usuarios con perfil de administrador.');
  }
}
