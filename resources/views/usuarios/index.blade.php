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
        <th>Acciones</th>
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
        <td>
          <a class="btn btn-primary evt-abrir-modal-edicion" href="#" data-id-usuario="{{ $usuario->id }}">Editar</a>
          <a class="btn btn-danger evt-eliminar" href="#" data-id-usuario="{{ $usuario->id }}">Eliminar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- Modal -->
<div class="modal fade" id="editar-usuario-modal" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editar-usuario-modal">Editar Usuario</h5>
        <button type="button" class="close evt-cerrar-modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary evt-cerrar-modal" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary evt-guardar-cambios-usuario">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.15/dist/sweetalert2.all.min.js"></script>
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

    $("body").on("click", ".evt-abrir-modal-edicion", function(e){
      var idUsuario = $(this).data('id-usuario'); // Id del usuairo
      $.ajax({
        type: 'GET',
        url: '{{ route('usuarios/obtener-datos-usuario') }}',
        data: {
          idUsuario: idUsuario
        },
        success: function(response) {
          $('.modal-body').html(response);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
      $('#editar-usuario-modal').modal('show');
    })

    $("body").on("click", ".evt-guardar-cambios-usuario", function(e) {
      boton = $(this);
		  boton.addClass("disabled");
		  boton.text("Actualizando...");
      let camposObligatorios = {
        nombre: $("#nombre").val(),
        fecha_nacimiento: $("#fecha_nacimiento").val(),
        perfil: $("#perfil").val()
      };
      datosVacios = [];
      $.each(camposObligatorios, function (ind, elem) {
        if (elem != "") {
          datosVacios = datosVacios;
        } else {
          datosVacios.push(elem);
        }
      });
      if (datosVacios.length > 0) {
        Swal.fire(
          "¡Campos Vacios!",
          "El formulario no puede tener campos vacíos, todos los campos marcados con asterisco* son requeridos.",
          "warning"
        );
        boton.removeClass("disabled");
        boton.text("Guardar cambios");
      } else {
        const url = $("#edicionForm").attr('action'); // url de actualización del usuario
        var form = $("#edicionForm");
        // var formulario = $("#actualizar_permisos_vista_perfil");
        // var form = new FormData(formulario[0]);
          $.ajax({
            type: 'PUT',
            url: url,
            data: form.serialize(),
            success: function(response) {
              Swal.fire(
                "Éxito!",
                response.mensaje,
                "success"
              );
              // llmamaos los usuarios actualizados
              filtrarUsuarios();
              $('#editar-usuario-modal').modal('hide');
              boton.removeClass("disabled");
              boton.text("Guardar cambios");
            },
            error: function(xhr, status, error) {
              boton.removeClass("disabled");
              boton.text("Guardar cambios");
              // en caso de error en el controlador
              var errors = xhr.responseJSON.errors;
              var errorMessages = '';

              $.each(errors, function(key, value) {
                  errorMessages += value[0] + '\n';
              });

              Swal.fire('Error', errorMessages, 'error');
            }
          });
      }
    });

    $("body").on("click", ".evt-cerrar-modal", function(e){
      $('#editar-usuario-modal').modal('hide');
    })

    $("body").on("click", ".evt-eliminar", function(e){
      e.preventDefault();
      var idUsuario = $(this).data('id-usuario'); // Id del usuairo
      Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar eliminación',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          // cudno se confirme la eliminación del usuario
          $.ajax({
            url: "{{ route('usuarios.eliminacion', ['id' => ':id']) }}".replace(':id', idUsuario),
            type: "DELETE",
            data: {
              "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
              // En caso de que se elimine éxitosamente, mostramos mensaje
              Swal.fire('Éxito', response.mensaje, 'success').then(function() {
                // si se elimina el usuario, recargamos los usuarios
                filtrarUsuarios()
              });
            },
            error: function(xhr, status, error) {
              // Si sale error, mostramos el mensaje de error
              Swal.fire('Error', 'Hubo un error al eliminar el usuario', 'error');
            }
          });
        }
      });
    })

    function filtrarUsuarios() {
      var filtro = $('#filtro').val();

      $.ajax({
        type: 'GET',
        url: '{{ route('filtrar-usuarios') }}',
        data: {
          filtro: filtro
        },
        success: function(response) {
          $('#tablaUsuarios').html(response);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }
  });
</script>
@endsection
