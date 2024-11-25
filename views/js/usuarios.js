$(document).ready(function () {
  $('#tablaUsuarios').DataTable({
      "ajax": {
          "url": "/PaginaWiliam/controller/usuarios.php?op=listar",
          "type": "GET",
          "dataSrc": ""
      },
      "columns": [
          { "data": "usu_id" },
          { "data": "usu_nom" },
          { "data": "usu_apep" },
          { "data": "usu_apem" },
          { "data": "usu_correo" },
          { "data": "usu_telf" },
          { "data": "est", "render": function (data) {
              return data === 1 ? 'Activo' : 'Inactivo';
          }},
          {
              "data": "usu_id",
              "render": function (data) {
                  return `
                      <button class="btn btn-primary btn-sm" onclick="cargarDatosModal(${data})">
                          <i class="fas fa-edit"></i> Editar
                      </button>
                      <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(${data})">
                          <i class="fas fa-trash"></i> Eliminar
                      </button>
                  `;
              }
          }
      ]
  });
});

function mostrarModalCrear() {
  $('#usuario_id').val('');
  $('#usuario_nombre').val('');
  $('#usuario_apep').val('');
  $('#usuario_apem').val('');
  $('#usuario_correo').val('');
  $('#usuario_telf').val('');
  $('#usuario_pass').val('');
  $('#usuario_estado').val(1);
  $('#modalAddLabel').text('Agregar Usuario');
  $('#modalAdd').modal('show');
}

function guardarUsuario() {
  const id = $('#usuario_id').val();
  const nombre = $('#usuario_nombre').val();
  const apep = $('#usuario_apep').val();
  const apem = $('#usuario_apem').val();
  const correo = $('#usuario_correo').val();
  const telf = $('#usuario_telf').val();
  const pass = $('#usuario_pass').val();
  const estado = $('#usuario_estado').val();

  if (!nombre || !apep || !apem || !correo || !telf || !pass) {
      Swal.fire('Error', 'Los campos obligatorios no están completos.', 'error');
      return;
  }

  const operacion = id ? 'actualizar' : 'crear';

  $.post(`/PaginaWiliam/controller/usuarios.php?op=${operacion}`, { id, nombre, apep, apem, correo, telf, pass, estado }, function (response) {
    console.log(response);
    
      if (response === 'success') {
          Swal.fire('Éxito', `Usuario ${operacion === 'crear' ? 'creado' : 'actualizado'} correctamente.`, 'success');
          $('#modalAdd').modal('hide');
          $('#tablaUsuarios').DataTable().ajax.reload();
      } else {
          Swal.fire('Error', 'Ocurrió un problema al guardar los datos.', 'error');
      }
  });
}

function cargarDatosModal(id) {
  $.post('/PaginaWiliam/controller/usuarios.php?op=mostrar', { id }, function (response) {
      const data = JSON.parse(response);
      if (data) {
          $('#usuario_id').val(id);
          $('#usuario_nombre').val(data.usu_nom);
          $('#usuario_apep').val(data.usu_apep);
          $('#usuario_apem').val(data.usu_apem);
          $('#usuario_correo').val(data.usu_correo);
          $('#usuario_telf').val(data.usu_telf);
          $('#usuario_estado').val(data.est);
          $('#modalAddLabel').text('Editar Usuario');
          $('#modalAdd').modal('show');
      } else {
          Swal.fire('Error', 'No se encontraron datos para este registro.', 'error');
      }
  });
}

function eliminarUsuario(id) {
  Swal.fire({
      title: '¿Estás seguro?',
      text: '¡Este registro será eliminado permanentemente!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
  }).then((result) => {
      if (result.isConfirmed) {
          $.post('/PaginaWiliam/controller/usuarios.php?op=eliminar', { id }, function (response) {
              
                  Swal.fire('Eliminado', 'El usuario ha sido eliminado correctamente.', 'success');
                  $('#tablaUsuarios').DataTable().ajax.reload();
             
          });
      }
  });
}
