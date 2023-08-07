@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Mis datos</div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><strong>Identificación:</strong> {{ $user->identificacion }}</li>
            <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $user->email }}</li>
            <li class="list-group-item"><strong>Celular:</strong> {{ $user->celular }}</li>
            <li class="list-group-item"><strong>Fecha de nacimiento:</strong> {{ $user->fecha_nacimiento }}</li>
            <li class="list-group-item"><strong>Ciudad:</strong> {{ $user->ciudad->nombre }}, {{ $user->ciudad->departamento->nombre }}, {{ $user->ciudad->departamento->pais->nombre }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
