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
                    var firmaactaBadgeasignacion = asignacionesver.acta_firmada == '1'
                        ? '<span class="badge badge-pill badge-success">✔️</span>'
                        : '<span class="badge badge-pill badge-danger">No</span>';

                        // esta es para ver si tiene el acta firmada 
                    // var firmaactaBadgeasignacion = asignacionesver.acta_firmada == '0'
                    //     ? '<span class="badge badge-pill badge-success">Si</span>'
                    //     : '<span class="badge badge-pill badge-danger">No</span>';

                    var fila = `
                        <tr>
                            <td class="py-3">${index + 1}</td>
                            <td class="align-middle py-3">${asignacionesver.nombres}</td>
                            <td class="py-3">${asignacionesver.tipo}</td>
                            <td class="py-3">${asignacionesver.marca}</td>
                            <td class="py-3">${asignacionesver.fecha_asignacion}</td>
                            <td class="py-3">${asignacionesver.fecha_registro}</td>
                            <td class="py-3">${estadoBadgeasignacion}</td>
                            <td class="py-3">${firmaactaBadgeasignacion}</td>
                            <td class="py-3">
                                <div class="position-relative">
                                    <a class="link-dark d-inline-block" href="#editar-asignacion">
                                        <i class="gd-pencil icon-text"></i>
                                    </a>
                                    <a class="link-dark d-inline-block" href="#ver-detalles">
                                        <i class="gd-eye icon-text"></i>
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










// ------------------------------------------------------------------
// agregar un empleado
$('#btn_agregar_asignacion').on('click', function () {
    agregar_asignacion();
});


function agregar_asignacion() {
    let empleado_asignacion = $('#empleado_asignacion').val();
    let equipo_asignacion = $('#equipo_asignacion').val();
    let fecha_asignacion_asignaciones = $('#fecha_asignacion_asignaciones').val();
    let acta_firmada_asignacion = $('#acta_firmada_asignacion').val();


    if (empleado_asignacion === "" || equipo_asignacion==="" || acta_firmada_asignacion==="") {
        alert("Los campos obligatorios no deben ir vaios");
        return;
    }

    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'asignaciones', // Parámetro 'run'
            action: 'agregar_asignacion_js', // Parámetro 'action'
            empleado_asignacion_json: empleado_asignacion, // Parámetro 'empleado_asignacion'
            equipo_asignacion_json: equipo_asignacion, // Parámetro 'equipo_asignacion'
            fecha_asignacion_asignaciones_json: fecha_asignacion_asignaciones, // Parámetro 'fecha_asignacion_asignaciones'
            acta_firmada_asignacion_json: acta_firmada_asignacion, // Parámetro 'acta_firmada_asignacion'
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
                $('#empleado_asignacion').val("");
                $('#equipo_asignacion').val("");
                $('#fecha_asignacion_asignaciones').val("");
                $('#acta_firmada_asignacion').val("");
         

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
