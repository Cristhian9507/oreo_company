@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Registro de usuario</div>
        <div class="card-body">
          <form id="registroForm" method="POST" action="{{ route('registrar') }}">
            @csrf
            <div class="form-group">
              <label for="identificacion">Identificación</label>
              <input id="identificacion" type="text" class="form-control @error('identificacion') is-invalid @enderror" name="identificacion" value="{{ old('identificacion') }}" required>
              @error('identificacion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required>
              @error('nombre')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="email">Correo Electrónico</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="celular">Celular</label>
              <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}">
              @error('celular')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="fecha_nacimiento">Fecha de nacimiento</label>
              <input id="fecha_nacimiento" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
              @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="pais">País</label>
              <select class="form-control select2" id="pais" name="pais" required>
                <option value="">Selecciona un país</option>
              </select>
              <div class="invalid-feedback">Por favor, selecciona un país.</div>
            </div>
            <div class="form-group">
              <label for="departamento">Departamento</label>
              <select class="form-control select2" id="departamento" name="departamento" required>
                <option value="">Selecciona un departamento</option>
              </select>
              <div class="invalid-feedback">Por favor, selecciona un departamento.</div>
            </div>
            <div class="form-group">
              <label for="ciudad">Ciudad</label>
              <select class="form-control select2" id="ciudad" name="ciudad" required>
                <option value="">Selecciona un ciudad</option>
              </select>
              <div class="invalid-feedback">Por favor, selecciona un ciudad.</div>
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
              <div class="invalid-feedback">Las contraseñas no coinciden.</div>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top:20px;">Registrarse</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2({
      minimumInputLength: 1,
      ajax: {
        url: '{{ route('buscar.paises') }}',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            q: params.term // texto de la búsqueda
          };
        },
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              return {
                id: item.id,
                text: item.nombre
              };
            })
          };
        },
        cache: true
      }
    });

    $('#pais').on('change', function() {
      // obtenemos el id del país
      $('#departamento').val('').trigger('change');
      $('#departamento').select2('close');
    });

    $('#departamento').select2({
      minimumInputLength: 1,
      ajax: {
        url: '{{ route('buscar.departamentos') }}',
        dataType: 'json',
        data: function (params) {
            var query = {
              pais_id: $('#pais').val(), // Obtener el país seleccionado
              q: params.term // Texto de búsqueda ingresado por el usuario
            };
            return query;
        },
        processResults: function (data) {
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.id,
                  text: item.nombre
                };
              })
            };
        },
        cache: true
      }
    });

    $('#departamento').on('select2:open', function() {
      var pais_id = $('#pais').val();
      if (!pais_id) {
        // Si no hay país seleccionado, se muestra un error
        var $message = $('<div class="alert alert-danger" role="alert">Primero selecciona un país.</div>');
        $(this).parent().append($message);
        $(this).select2('close');
        setTimeout(function() {
          $message.remove(); // Eliminar el mensaje después de unos segundos
        }, 3000);
      }
    });

    $('#ciudad').select2({
      minimumInputLength: 1,
      ajax: {
        url: '{{ route('buscar.ciudades') }}',
        dataType: 'json',
        data: function (params) {
            var query = {
              departamento_id: $('#departamento').val(), // Obtener el país seleccionado
              q: params.term // Texto de búsqueda ingresado por el usuario
            };
            return query;
        },
        processResults: function (data) {
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.id,
                  text: item.nombre
                };
              })
            };
        },
        cache: true
      }
    });

    $('#ciudad').on('select2:open', function() {
      var departamento_id = $('#departamento').val();
      if (!departamento_id) {
        // Si no hay país seleccionado, se muestra un error
        var $message = $('<div class="alert alert-danger" role="alert">Primero selecciona un departamento.</div>');
        $(this).parent().append($message);
        $(this).select2('close');
        setTimeout(function() {
          $message.remove(); // Eliminar el mensaje después de unos segundos
        }, 3000);
      }
    });
  })
</script>
@endsection
