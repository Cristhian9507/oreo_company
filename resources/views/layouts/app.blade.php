<!DOCTYPE html>
<html lang="en">

<head>
  <!-- enlaces de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.15/dist/sweetalert2.min.css">
</head>

<body>
  <div class="container">
    @auth
      <div class="row" style="text-align: right;">
        <div class="col-auto py-4" style="text-align:right;">
          <a href="{{ route('apirest') }}" class="btn btn-secondary">Usuarios API-rest</a>
        </div>
        <div class="col-auto py-4" style="text-align:right;">
          <a href="{{ route('usuarios') }}" class="btn btn-success">Usuarios</a>
        </div>
        <div class="col-auto py-4" style="text-align:right;">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Cerrar sesión</button>
          </form>
        </div>
      </div>
    @endauth
  </div>
  <div class="container">
    @yield('content')
  </div>
  <!-- se agregan los los scripts de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
