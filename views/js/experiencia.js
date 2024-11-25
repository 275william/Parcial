$(document).ready(function () {
    $('#tablaExperiencia').DataTable({
        "ajax": {
            "url": "/PaginaWiliam/controller/experiencia.php?op=listar",
            "type": "GET",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { "data": "empresa" },
            { "data": "puesto" },
            { "data": "fecha_inicio" },
            { "data": "fecha_fin" },
            { "data": "descripcion" },
            {
                "data": "id",
                "render": function (data) {
                    return `
                        <button class="btn btn-primary btn-sm" onclick="cargarDatosModal(${data})">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarExperiencia(${data})">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    `;
                }
            }
        ]
    });
});

function eliminarExperiencia(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡Este registro será eliminado permanentemente!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/PaginaWiliam/controller/experiencia.php?op=eliminar', { id }, function (response) {
                if (response === 'success') {
                    Swal.fire('Eliminado', 'El registro ha sido eliminado correctamente.', 'success');
                    $('#tablaExperiencia').DataTable().ajax.reload();
                } else {
                    Swal.fire('Error', 'Ocurrió un problema al eliminar el registro.', 'error');
                }
            });
        }
    });
}

function guardarExperiencia() {
    const id = $('#experiencia_id').val();
    const empresa = $('#experiencia_empresa').val();
    const puesto = $('#experiencia_puesto').val();
    const fecha_inicio = $('#experiencia_fecha_inicio').val();
    const fecha_fin = $('#experiencia_fecha_fin').val();
    const descripcion = $('#experiencia_descripcion').val();

    if (!empresa || !puesto || !fecha_inicio) {
        Swal.fire('Error', 'Los campos obligatorios no están completos.', 'error');
        return;
    }

    const operacion = id ? 'actualizar' : 'crear';

    $.post(`/PaginaWiliam/controller/experiencia.php?op=${operacion}`, { id, empresa, puesto, fecha_inicio, fecha_fin, descripcion }, function (response) {
        if (response === 'success') {
            Swal.fire('Éxito', `Experiencia ${operacion === 'crear' ? 'creada' : 'actualizada'} correctamente.`, 'success');
            $('#modalAdd').modal('hide');
            $('#tablaExperiencia').DataTable().ajax.reload();
        } else {
            Swal.fire('Error', 'Ocurrió un problema al guardar los datos.', 'error');
        }
    });
}

function cargarDatosModal(id) {
    $.post('/PaginaWiliam/controller/experiencia.php?op=mostrar', { id }, function (response) {
        const data = JSON.parse(response);
        if (data) {
            $('#experiencia_id').val(id);
            $('#experiencia_empresa').val(data.empresa);
            $('#experiencia_puesto').val(data.puesto);
            $('#experiencia_fecha_inicio').val(data.fecha_inicio);
            $('#experiencia_fecha_fin').val(data.fecha_fin);
            $('#experiencia_descripcion').val(data.descripcion);
            $('#modalAddLabel').text('Editar Experiencia');
            $('#modalAdd').modal('show');
        } else {
            Swal.fire('Error', 'No se encontraron datos para este registro.', 'error');
        }
    });
}


function mostrarModalCrear() {
    $('#experiencia_id').val('');
    $('#experiencia_empresa').val('');
    $('#experiencia_puesto').val('');
    $('#experiencia_fecha_inicio').val('');
    $('#experiencia_fecha_fin').val('');
    $('#experiencia_descripcion').val('');
    $('#modalAddLabel').text('Agregar Experiencia');
    $('#modalAdd').modal('show');
}