$(document).ready(function () {
    $('#tablaMenu').DataTable({
        "ajax": {
            "url": "/PaginaWiliam/controller/menu.php?op=listar",
            "type": "GET",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { "data": "opcion" },
            { "data": "url" },
            {
                "data": "id",
                "render": function (data) {
                    return `
                        <button class="btn btn-primary btn-sm" onclick="cargarDatosModal(${data})">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarMenu(${data})">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    `;
                }
            }
        ]
    });
});

function mostrarModalCrear() {
    $('#menu_id').val('');
    $('#menu_opcion').val('');
    $('#menu_url').val('');
    $('#modalAddLabel').text('Agregar Opción');
    $('#modalAdd').modal('show');
}

function guardarMenu() {
    const id = $('#menu_id').val();
    const opcion = $('#menu_opcion').val();
    const url = $('#menu_url').val();

    if (!opcion || !url) {
        Swal.fire('Error', 'Todos los campos son obligatorios.', 'error');
        return;
    }

    const operacion = id ? 'actualizar' : 'crear';

    $.post(`/PaginaWiliam/controller/menu.php?op=${operacion}`, { id, opcion, url }, function (response) {
        if (response === 'success') {
            Swal.fire('Éxito', `Opción ${operacion === 'crear' ? 'creada' : 'actualizada'} correctamente.`, 'success');
            $('#modalAdd').modal('hide');
            $('#tablaMenu').DataTable().ajax.reload();
        } else {
            Swal.fire('Error', 'Ocurrió un problema al guardar los datos.', 'error');
        }
    });
}

function cargarDatosModal(id) {
    $.post('/PaginaWiliam/controller/menu.php?op=mostrar', { id }, function (response) {
        const data = JSON.parse(response);
        if (data) {
            $('#menu_id').val(id);
            $('#menu_opcion').val(data.opcion);
            $('#menu_url').val(data.url);
            $('#modalAddLabel').text('Editar Opción');
            $('#modalAdd').modal('show');
        } else {
            Swal.fire('Error', 'No se encontraron datos para este registro.', 'error');
        }
    });
}

function eliminarMenu(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡Este registro será eliminado permanentemente!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/PaginaWiliam/controller/menu.php?op=eliminar', { id }, function (response) {
                if (response === 'success') {
                    Swal.fire('Eliminado', 'El registro ha sido eliminado correctamente.', 'success');
                    $('#tablaMenu').DataTable().ajax.reload();
                } else {
                    Swal.fire('Error', 'Ocurrió un problema al eliminar el registro.', 'error');
                }
            });
        }
    });
}
