// $('#obtener_datos_equiposbtn').on('click', function() {
//     obtener_datos_equipos();
// });

function obtener_datos_asignacion() {
    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'asignaciones', // Parámetro 'run'
            action: 'obtenerasignaciones' // Parámetro 'action'
        },
        success: function (data) {
            // loading(false); // Quitar el indicador de carga

            if (data.error) {
                alert('Error: ' + data.error); // Mostrar mensaje de error si existe
            } else {
                // Limpia el contenido actual del tbody
                $('#tabla_verasignacion').empty();

                // Itera sobre los datos recibidos y genera las filas de la tabla
                $.each(data, function (index, asignacionesver) {
                    // esto es por si el esta activo o inactivo , 1 es activo y 0 es inactivo
                    var estadoBadgeasignacion = asignacionesver.estado_asignacion == '1'
                        ? '<span class="badge badge-pill badge-success">Activo</span>'
                        : '<span class="badge badge-pill badge-danger">Inactivo</span>';

                    var fila = `
                        <tr>
                            <td class="py-3">${index + 1}</td>
                            <td class="align-middle py-3">${asignacionesver.nombre}</td>
                            <td class="py-3">${asignacionesver.tipo}</td>
                            <td class="py-3">${asignacionesver.marca}</td>
                            <td class="py-3">${asignacionesver.fecha_asignacion}</td>
                            <td class="py-3">${asignacionesver.fecha_registro}</td>
                            <td class="py-3">${estadoBadgeasignacion}</td>
                            <td class="py-3">
                                <div class="position-relative">
                                    <a class="link-dark d-inline-block" href="#">
                                        <i class="gd-pencil icon-text"></i>
                                    </a>
                              
                                </div>
                            </td>
                        </tr>
                    `;

                    // Añade la fila generada al tbody
                    $('#tabla_verasignacion').append(fila);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejo de errores
            if (jqXHR.status === 0) {
                alert('No conectado: Verifica la red.');
            } else if (jqXHR.status == 404) {
                alert('Página no encontrada [404].');
            } else if (jqXHR.status == 500) {
                alert('Error interno del servidor [500].');
            } else if (textStatus === 'parsererror') {
                console.log(jqXHR.responseText);
                alert('Error al analizar JSON.');
            } else if (textStatus === 'timeout') {
                alert('Error de tiempo de espera.');
            } else if (textStatus === 'abort') {
                alert('Solicitud Ajax abortada.');
            } else {
                console.log('Error no capturado: ' + jqXHR.responseText);
            }
        }
    });
}
// window.onload = function () {
//     obtener_datos_equipos()
// }