$(document).ready(function () {
    $('#tablaEstudios').DataTable({
        "ajax": {
            "url": "/PaginaWiliam/controller/estudios.php?op=listar",
            "type": "GET",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { "data": "titulo" },
            { "data": "institucion" },
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
                        <button class="btn btn-danger btn-sm" onclick="eliminarEstudio(${data})">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    `;
                }
            }
        ]
    });
});

function mostrarModalCrear() {
    $('#estudio_id').val('');
    $('#estudio_titulo').val('');
    $('#estudio_institucion').val('');
    $('#estudio_fecha_inicio').val('');
    $('#estudio_fecha_fin').val('');
    $('#estudio_descripcion').val('');
    $('#modalAddLabel').text('Agregar Estudio');
    $('#modalAdd').modal('show');
}

function guardarEstudio() {
    const id = $('#estudio_id').val();
    const titulo = $('#estudio_titulo').val();
    const institucion = $('#estudio_institucion').val();
    const fecha_inicio = $('#estudio_fecha_inicio').val();
    const fecha_fin = $('#estudio_fecha_fin').val();
    const descripcion = $('#estudio_descripcion').val();

    if (!titulo || !institucion || !fecha_inicio) {
        Swal.fire('Error', 'Los campos obligatorios no están completos.', 'error');
        return;
    }

    const operacion = id ? 'actualizar' : 'crear';

    $.post(`/PaginaWiliam/controller/estudios.php?op=${operacion}`, { id, titulo, institucion, fecha_inicio, fecha_fin, descripcion }, function (response) {
        if (response === 'success') {
            Swal.fire('Éxito', `Estudio ${operacion === 'crear' ? 'creado' : 'actualizado'} correctamente.`, 'success');
            $('#modalAdd').modal('hide');
            $('#tablaEstudios').DataTable().ajax.reload();
        } else {
            Swal.fire('Error', 'Ocurrió un problema al guardar los datos.', 'error');
        }
    });
}

function cargarDatosModal(id) {
    $.post('/PaginaWiliam/controller/estudios.php?op=mostrar', { id }, function (response) {
        const data = JSON.parse(response);
        if (data) {
            $('#estudio_id').val(id);
            $('#estudio_titulo').val(data.titulo);
            $('#estudio_institucion').val(data.institucion);
            $('#estudio_fecha_inicio').val(data.fecha_inicio);
            $('#estudio_fecha_fin').val(data.fecha_fin);
            $('#estudio_descripcion').val(data.descripcion);
            $('#modalAddLabel').text('Editar Estudio');
            $('#modalAdd').modal('show');
        } else {
            Swal.fire('Error', 'No se encontraron datos para este registro.', 'error');
        }
    });
}

function eliminarEstudio(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡Este registro será eliminado permanentemente!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/PaginaWiliam/controller/estudios.php?op=eliminar', { id }, function (response) {
                if (response === 'success') {
                    Swal.fire('Eliminado', 'El registro ha sido eliminado correctamente.', 'success');
                    $('#tablaEstudios').DataTable().ajax.reload();
                } else {
                    Swal.fire('Error', 'Ocurrió un problema al eliminar el registro.', 'error');
                }
            });
        }
    });
}
