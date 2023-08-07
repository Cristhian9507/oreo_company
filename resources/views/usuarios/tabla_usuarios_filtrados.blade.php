@foreach($usuarios as $usuario)
<tr>
  <td>{{ $usuario->id }}</td>
  <td>{{ $usuario->nombre }}</td>
  <td>{{ $usuario->email }}</td>
  <td>{{ $usuario->celular }}</td>
  <td>{{ now()->diffInYears(\Carbon\Carbon::parse($usuario->fecha_nacimiento)); }}</td>
  <td>{{ $usuario->ciudad->nombre }}</td>
  <td>{{ $usuario->perfil->nombre }}</td>
  <td>
    <a class="btn btn-primary evt-abrir-modal-edicion" href="#" data-id-usuario="{{ $usuario->id }}">Editar</a>
    <a class="btn btn-danger evt-eliminar" href="#">Eliminar</a>
  </td>
</tr>
@endforeach
