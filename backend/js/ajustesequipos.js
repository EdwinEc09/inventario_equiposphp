// $('#obtener_datos_equiposbtn').on('click', function() {
//     obtener_datos_equipos();
// });

function obtener_datos_tipoequipos() {
    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'equipos', // Parámetro 'run'
            action: 'obtenertipoequipos' // Parámetro 'action'
        },
        success: function (data) {
            // loading(false); // Quitar el indicador de carga

            if (data.error) {
                alert('Error: ' + data.error); // Mostrar mensaje de error si existe
            } else {
                obtener_datos_tipoequipos()
                // Limpia el contenido actual del tbody
                $('#tabla_vertiposequipos').empty();

                // Itera sobre los datos recibidos y genera las filas de la tabla
                $.each(data, function (index, tipoequiposver) {
                    // esto es por si el esta activo o inactivo , 1 es activo y 0 es inactivo
                    var estadoBadgeasignacion = tipoequiposver.estado_asignacion == '1'
                        ? '<span class="badge badge-pill badge-success">Activo</span>'
                        : '<span class="badge badge-pill badge-danger">Inactivo</span>';

                    var fila = `
                        <tr>
                            <td class="py-3">${index + 1}</td>
                            <td class="align-middle py-3">${tipoequiposver.tipo}</td>
                     
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
                    $('#tabla_vertiposequipos').append(fila);
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










// ------------------------------------------------------------------
// agregar un empleado
$('#btn_agregar_tiposequipos').on('click', function () {
    agregar_tipoequipos();
});


function agregar_tipoequipos() {
    let tipos_equipos_tiposequipos = $('#tipos_equipos_tiposequipos').val();



    if (tipos_equipos_tiposequipos === "" ) {
        alert("Los campos obligatorios no deben ir vaios");
        return;
    }

    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'equipos', // Parámetro 'run'
            action: 'agregar_tiposequipos_json', // Parámetro 'action'
            tipos_equipos_tiposequipos_json: tipos_equipos_tiposequipos, // Parámetro 'empleado_asignacion'

        },
        success: function (response, data) {

            // alert("se guardó");
            if (response.success) {
                obtener_datos_equipos(); 
                // alert(response.success);
                // Alerta de éxito
                var alerta_agregar_asignacion = `
                <div class="alert bg-success text-white alert-dismissible d-flex align-items-center p-md-4 mb-2 fade show" role="alert">
                    <i class="gd-check-box icon-text mr-2"></i>
                    <p class="mb-0">

                        <strong> Exito! </strong> ${response.success}
                    </p>
                    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                        <i class="gd-close icon-text icon-text-xs" aria-hidden="true"></i>
                    </button>
                </div>
                `;

                // Limpiar los campos del formulario
                $('#tipos_equipos_tiposequipos').val("");
                // Añadir la alerta al contenedor
                $('#alerta_agregar_asignacionhtml').html(alerta_agregar_asignacion);

                // Remover la alerta después de 5 segundos
                setTimeout(function () {
                    $('.alert').alert('close');
                }, 5000);

            } else {
                alert(response.error);
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
