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

// ------------------------------------------------------------------
// agregar un empleado
$('#btn_agregar_tiposequipos').on('click', function () {
    agregar_tipoequipos();
});
function agregar_tipoequipos() {
    let tipos_equipos_tiposequipos = $('#tipos_equipos_tiposequipos').val();
    if (tipos_equipos_tiposequipos === "") {
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

// ---------------------------------------------------------------------

// funcion para obtener datos en estados 
function obtener_datos_estadosequipos() {
    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'equipos', // Parámetro 'run'
            action: 'obtenerestadosequipos' // Parámetro 'action'
        },
        success: function (data) {
            if (data.error) {
                alert('Error: ' + data.error);
            } else {
                obtener_datos_tipoequipos()
                // Limpia el contenido actual del tbody
                $('#tabla_verestadosequipos').empty();

                // Itera sobre los datos recibidos y genera las filas de la tabla
                $.each(data, function (index, estadosequiposver) {
                    // esto es por si el esta activo o inactivo , 1 es activo y 0 es inactivo
                    var estado_estadoequipo = estadosequiposver.estado == '1'
                        ? '<span class="badge badge-pill badge-success">Activo</span>'
                        : '<span class="badge badge-pill badge-danger">Inactivo</span>';

                    let color = estadosequiposver.color_estado;

                    var fila = `
                        <tr>
                            <td class="py-3"><input type="checkbox" name="id_checkbx_elegidos_estadoequipo[]" value="${estadosequiposver.ID}"></td>
                            <td class="align-middle py-3">${estadosequiposver.nombre_estado}</td>
                            <td class="align-middle py-3"><span class="badge badge-pill badge-success" style="color: #fff; background-color: ${color};">${estadosequiposver.nombre_estado}</span></td>
                            <td class="align-middle py-3">${estado_estadoequipo}</td>
                            <td class="py-3">
                                  <div class="position-relative">
                                    <a style="margin-right: 7px;" class="link-dark d-inline-block" href="#" value="${estadosequiposver.ID}" onclick="mostrar_datos_modalactualizarestadosequipos(${estadosequiposver.ID})" title="Editar Equipos" data-toggle="modal" data-target="#modalactualizarestadosequipos" >
                                        <i class="gd-reload icon-text"></i>
                                    </a>
                                    <a style="margin-right: 7px;" class="link-dark d-inline-block" href="#" title="Ver mas Informacion" data-toggle="modal" data-target="#modalverlogsestadoequipos"">
                                        <i class="gd-eye icon-text"></i>
                                    </a>
                                    <a style="margin-right: 7px; class="link-dark d-inline-block" href="#Inactivar-estadoequipos">
                                            <i class="gd-na icon-text"></i>
                                    </a>
                              
                                </div>
                            </td>
                        </tr>
                    `;

                    // Añade la fila generada al tbody
                    $('#tabla_verestadosequipos').append(fila);
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

// ------------------------------------------------------------------
// agregar un estados de equipos 
$('#btn_agregar_estadosequipos').on('click', function () {
    agregar_estadosequipos();
});
function agregar_estadosequipos() {
    let agregar_estados_estadoequipos = $('#agregar_estados_estadoequipos').val();
    let agregar_colorestado_estadoequipos = $('#agregar_colorestado_estadoequipos').val();
    if (agregar_estados_estadoequipos === "") {
        alert("Los campos obligatorios no deben ir vaios");
        return;
    }
    console.log(agregar_colorestado_estadoequipos);
    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'equipos', // Parámetro 'run'
            action: 'agregar_estadosequipos_js', // Parámetro 'action'
            agregar_estados_estadoequipos_json: agregar_estados_estadoequipos, // Parámetro 'empleado_asignacion'
            agregar_colorestado_estadoequipos_json: agregar_colorestado_estadoequipos, // Parámetro 'empleado_asignacion'

        },
        success: function (response, data) {
            // alert("se guardó");
            if (response.success) {
                obtener_datos_estadosequipos();
                $('#agregar_estados_estadoequipos').val("");
                $('#agregar_colorestado_estadoequipos').val("");
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



// esta funcion hace que se muestre los datos del empleado antes de actualizarlos
function mostrar_datos_modalactualizarestadosequipos(ID) {
    // console.log(ID);
    $.ajax({
        url: "exe.php",
        type: "POST",
        dataType: "JSON",
        data: {
            run: 'equipos',
            action: 'obtener_estadoequipo_unico_js', // Nueva acción para obtener un solo empleado
            id_estadoequipo_json: ID
        },
        success: function (data) {
            // actualizar_empleados(ID);
            // console.log("data : " + data + "si" + usuario);
            if (data) {
                // console.log(data);
                var mostrar_color = data.color_estado.trim();   //convierte el dato en string(texto)
                var data_estado = data.nombre_estado.trim();   //convierte el dato en string(texto)
                $('#actualizar_ID_estadoequipos').val(data.ID);
                $('#actualizar_estados_estadoequipos').val(data_estado);
                $('#actualizar_colorestado_estadoequipos').val(mostrar_color);
                // console.log(data.color_estado);
            } else {
                alert('Error: No se pudieron obtener los datos del equipo.');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al obtener los datos del empleado.');
        }
    });
}


// funciones que actualiza el estad del equipo dependiendo el ID 
$('#btn_actuualizar_estadosequipos').on('click', function () {
    actualizar_estadosequipos();
});
function actualizar_estadosequipos() {
    let actualizar_ID_estadoequipos = $('#actualizar_ID_estadoequipos').val().trim();
    let actualizar_estados_estadoequipos = $('#actualizar_estados_estadoequipos').val().trim();
    let actualizar_colorestado_estadoequipos = $('#actualizar_colorestado_estadoequipos').val().trim();
    // console.log(actualizar_estados_estadoequipos,actualizar_colorestado_estadoequipos);
    if (actualizar_estados_estadoequipos === "" || actualizar_colorestado_estadoequipos === "") {
        alert("los campos no pueden ir vaciios")
    } else {
        $.ajax({
            url: "exe.php",
            type: "POST",
            dataType: "JSON",
            data: {
                run: 'equipos',
                action: 'actualizar_estadosequipos_js', // Nueva acción para obtener un solo empleado
                actualizar_ID_estadoequipos_json: actualizar_ID_estadoequipos,
                actualizar_estados_estadoequipos_json: actualizar_estados_estadoequipos,
                actualizar_colorestado_estadoequipos_json: actualizar_colorestado_estadoequipos
            },
            success: function (response) {
                if (response.success) {
                    // $('#actualizar_ID_estadoequipos').val("");
                    // $('#actualizar_estados_estadoequipos').val("");
                    // $('#actualizar_colorestado_estadoequipos').val("");
                    alert(response.success);
                    obtener_datos_estadosequipos();
                }
                else {
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
}



// -----------------------------------------------------------------
// Evento para seleccionar o deseleccionar todos los checkboxes ademas de anviar el valor a la db
$('#seleccionarTodos_estadoequipo').on('click', function () {
    // Obtener el estado actual de todos los checkboxes
    let todosSeleccionados = $('input[name="id_checkbx_elegidos_estadoequipo[]"]').length === $('input[name="id_checkbx_elegidos_estadoequipo[]"]:checked').length;
    // Marcar o desmarcar todos los checkboxes
    $('input[name="id_checkbx_elegidos_estadoequipo[]"]').prop('checked', !todosSeleccionados);
    // Verificar si al menos un checkbox está seleccionado
    let seleccionados = $('input[name="id_checkbx_elegidos_estadoequipo[]"]:checked').length > 0;
    // se agrega el boton que se quiere apagar comunmente es el que abre el modal
    $('#btn-modalinactivarvariosestadoequipos').prop('disabled', !seleccionados);
});

// Evento para detectar cambios individuales en los checkboxes
$(document).on('change', 'input[name="id_checkbx_elegidos_estadoequipo[]"]', function () {
    let seleccionados = $('input[name="id_checkbx_elegidos_estadoequipo[]"]:checked').length > 0;
    // se agrega el boton que se quiere apagar comun mente es el que abre el modal
    $('#btn-modalinactivarvariosestadoequipos').prop('disabled', !seleccionados);
});
// -----------------------------------------------------------------



// Evento al hacer clic en el botón "Enviar"
$('#btn_inactivar_estadoequipos').on('click', function () {
    let idsSeleccionados = $('input[name="id_checkbx_elegidos_estadoequipo[]"]:checked').map(function () {
        return $(this).val();
    }).get();

    if (idsSeleccionados.length > 0) {
        inactivar_estadoequipo(idsSeleccionados);
        // alert("si tienes ID seleccionados y son: " + idsSeleccionados);
    } else {
        alert("No has seleccionado ningún empleado.");
    }
});

// esta es la funcion que inactiva varios etados 
function inactivar_estadoequipo(idsSeleccionados) {
    let estado_estadoequipos_variosjs = $('#estado_estadoequipos_varios').val();

    if (estado_estadoequipos_variosjs === "") {
        alert("el campo no puede ir vacio");

    } else {
        $.ajax({
            url: "exe.php", // Archivo que procesará la solicitud
            type: "POST", // Método de envío
            dataType: "JSON", // Esperamos respuesta en formato JSON
            data: {
                run: 'equipos', // Parámetro 'run'
                action: 'inactivar_activar_varios_estadoequipo_js', // Parámetro 'action'
                ids_estadoseqipos: idsSeleccionados, // Enviar los IDs seleccionados
                estado_estadoequipos_varios_json: estado_estadoequipos_variosjs
            },
            success: function (data) {
                // loading(false); // Quitar el indicador de carga
                if (data.error) {
                    alert('Error: ' + data.error); // Mostrar mensaje de error si existe
                } else {
                    obtener_datos_estadosequipos();
                    alert(data.success);
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
}