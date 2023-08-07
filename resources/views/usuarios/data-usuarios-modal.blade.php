<form id="edicionForm" method="POST" action="{{ route('usuarios.update', ['id' => $usuario->id]) }}">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="identificacion">Identificación*</label>
    <input type="text" class="form-control" name="identificacion" id="identificacion" value="{{ $usuario->identificacion }}" disabled readonly>
  </div>
  <div class="form-group">
    <label for="nombre">Nombre*</label>
    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $usuario->nombre }}" required>
  </div>
  <div class="form-group">
    <label for="email">Email*</label>
    <input type="email" class="form-control" name="email" id="email" value="{{ $usuario->email }}" disabled readonly>
  </div>
  <div class="form-group">
    <label for="celular">Celular</label>
    <input type="text" class="form-control" name="celular" id="celular" value="{{ $usuario->celular }}">
  </div>
  <div class="form-group">
    <label for="fecha_nacimiento">Fecha de nacimiento*</label>
    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}" required>
  </div>
  <div class="form-group">
    <label for="perfil">Perfil*</label>
    <select class="form-control select2" id="perfil" name="perfil" required>
      <option value="" disabled>Selecciona un perfil</option>
      @foreach($perfiles as $perfil)
        <option value="{{ $perfil->id }}" @if($usuario->perfil_id === $perfil->id) selected @endif>{{ $perfil->nombre }}</option>
      @endforeach
    </select>
  </div>
</form>
