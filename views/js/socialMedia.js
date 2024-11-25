$(document).ready(function () {
    $('#tablaRedesSociales').DataTable({
        "ajax": {
            "url": "/PaginaWiliam/controller/social_media.php?op=listar", 
            "type": "GET",
            "dataSrc": ""
        },
        "dom": 'frtip',
        "columns": [
            {
                "data": "socmed_id", 
                "title": "ID"
            },
            {
                "data": "socmed_icono",
                "title": "Ícono",
                "render": function (data) {
                    return '<i class="' + data + '"></i>'; 
                }
            },
            {
                "data": "socmed_url",
                "title": "URL"
            },
            {
                "data": "est", 
                "title": "Estado",
                "render": function (data) {
                    if (data === 1) {
                        return '<span class="badge badge-success">Activo</span>';
                    } else if (data === 0) {
                        return '<span class="badge badge-danger">Inactivo</span>';
                    }
                    return '';
                }
            },
            {
                "data": "socmed_id",  
                "title": "Acciones",
                "render": function(data, type, row) {
                    return `
                        <button class="btn btn-primary btn-sm" onclick="cargarDatosModal(${data})">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarSocialMedia(${data})">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    `;
                }
            }
        ]
    });
});


function eliminarSocialMedia(socmed_id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡Este registro se eliminará permanentemente!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/PaginaWiliam/controller/social_media.php?op=eliminar', 
                { id: socmed_id }, 
                function(response) {
                    if (response === 'success') {
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado correctamente.',
                            'success'
                        );

                        $('#tablaRedesSociales').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Hubo un problema al eliminar el registro.',
                            'error'
                        );
                    }
                }
            );
        } 
    });
}


function cargarDatosModal(socmed_id) {

    
    $.post('/PaginaWiliam/controller/social_media.php?op=mostrar', 
        { socmed_id: socmed_id }, 
        function(response) {

            var data = JSON.parse(response);

            if (data) {

                $('#socmed_icono').val(data.socmed_icono);
                $('#socmed_url').val(data.socmed_url);
                $('#est').val(data.est);
                $('#socmed_id').val(socmed_id)

                $('#modalAddLabel').text('Actualizar Red Social');
                $('#modalAdd button[type="submit"]').text('Actualizar');

                $('#modalAdd').val('socmed_id', socmed_id);

                $('#modalAdd').modal('show');
            } else {
                Swal.fire('Error', 'No se encontraron datos para el registro.', 'error');
            }
        }
    ).fail(function() {
        Swal.fire('Error', 'Hubo un problema al obtener los datos.', 'error');
    });
}


function guardarSocialMedia() {
   
    const socmed_id = $('#socmed_id').val(); 
    const socmed_icono = $('#socmed_icono').val();
    const socmed_url = $('#socmed_url').val();
    const est = $('#est').val();

    if (!socmed_icono || !socmed_url) {
        Swal.fire(
            'Error',
            'Todos los campos son obligatorios.',
            'error'
        );
        return;
    }

    const operacion = socmed_id ? 'actualizar' : 'crear';

    $.post(`/PaginaWiliam/controller/social_media.php?op=${operacion}`, 
        { 
            socmed_id: socmed_id, 
            socmed_icono: socmed_icono, 
            socmed_url: socmed_url, 
            est: est 
        },
        function(response) {
            if (response === 'success') {
                const mensaje = operacion === 'crear' ? 'creado' : 'actualizado';

                Swal.fire(
                    'Éxito',
                    `El registro ha sido ${mensaje} correctamente.`,
                    'success'
                );

                $('#modalAdd').modal('hide');

                
                $('#tablaRedesSociales').DataTable().ajax.reload();
            } else {
                Swal.fire(
                    'Error',
                    'Hubo un problema al guardar los datos.',
                    'error'
                );
            }
        }
    );
}


function mostrarModalCrear() {
    $('#socmed_id').val('');
    $('#socmed_icono').val('');
    $('#socmed_url').val('');
    $('#est').val(1);
    $('#modalAddLabel').text('Agregar Red Social');
    $('#modalAdd button[type="submit"]').text('Guardar');
    $('#modalAdd').removeData('socmed_id');
    $('#modalAdd').modal('show');
}





