@foreach($usuarios as $usuario)
<tr>
  <td>{{ $usuario->id }}</td>
  <td>{{ $usuario->nombre }}</td>
  <td>{{ $usuario->email }}</td>
  <td>{{ $usuario->celular }}</td>
  <td>{{ now()->diffInYears(\Carbon\Carbon::parse($usuario->fecha_nacimiento)); }}</td>
  <td>{{ $usuario->ciudad->nombre }}</td>
  <td>{{ $usuario->perfil->nombre }}</td>
</tr>
@endforeach
