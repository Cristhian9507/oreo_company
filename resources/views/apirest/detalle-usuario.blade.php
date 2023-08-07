@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Datos usuario apirest</div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><strong>id:</strong> {{ $usuario->id }}</li>
            <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->name }}</li>
            <li class="list-group-item"><strong>Username:</strong> {{ $usuario->username }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $usuario->email }}</li>
            <li class="list-group-item"><strong>Dirección:</strong> {{ $usuario->address->city }}, {{ $usuario->address->street }}, {{ $usuario->address->suite }}</li>
            <li class="list-group-item"><strong>Teléfono:</strong> {{ $usuario->phone }}</li>
            <li class="list-group-item"><strong>Página web:</strong> {{ $usuario->website }}</li>
            <li class="list-group-item"><strong>Empresa:</strong> {{ $usuario->company->name }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
