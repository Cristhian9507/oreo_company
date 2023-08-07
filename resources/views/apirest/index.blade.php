@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Listado de posts</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group py-4">
        <input id="filtro" type="number" class="form-control" name="filtro" placeholder="Filtrar por id usuario">
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
        <th>Id</th>
        <th>userId</th>
        <th>Titulo</th>
        <th>Cuerpo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="tablaPosts">
      @foreach($posts as $post)
      <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->userId }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->body }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('apirest/ver-usuario', ['id' => $post->userId]) }}">Ver usuario</a>
        </td>
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
      filtrarPosts();
    });

    $("body").on("keypress", "#filtro", function(e) {
      if (e.which === 13) {
        e.preventDefault();
        filtrarPosts();
      }
    });
    function filtrarPosts() {
      var filtro = $('#filtro').val();
      const url = '{{ route('apirest/filtrar-posts') }}' + '?filtro='+filtro;
      console.log(url)
      window.location.href = url;
    }
  });
</script>
@endsection
