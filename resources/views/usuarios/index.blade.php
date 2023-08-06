@extends('layouts.app')

@section('content')
<div class="container">
  @if (session()->has('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif
  <h1 class="mb-4">Usuarios <a href="{{ route('formularioRegistro') }}" class="btn btn-secondary">Agregar usuario</a></h1>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group py-4">
        <input id="filtro" type="text" class="form-control" name="filtro" placeholder="Filtrar por nombre, cédula, email, celular">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group py-4">
        <a class="btn btn-success evt-filtrar" href="#">Filtrar</a>
      </div>
    </div>
  </div>
  <table class="table table-bordered" id="users-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Celular</th>
        <th>Edad</th>
        <th>Cuidad</th>
        <th>Perfil</th>
      </tr>
    </thead>
    <tbody id="tablaUsuarios">
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
    </tbody>
  </table>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    $('#users-table').DataTable();
    $("body").on("click", ".evt-filtrar", function(e) {
      e.preventDefault();
      filtrarUsuarios();
    });

    $("body").on("keypress", "#filtro", function(e) {
      if (e.which === 13) {
        e.preventDefault();
        filtrarUsuarios();
      }
    });

    function filtrarUsuarios() {
      var filtro = $('#filtro').val();

      $.ajax({
        type: 'GET',
        url: '{{ route('filtrar-usuarios') }}',
        data: {
          filtro: filtro
        },
        success: function(data) {
          $('#tablaUsuarios').html(data);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }
  });
</script>
@endsection
