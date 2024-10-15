// $('#obtener_datos_usuarios').on('click', function() {
//     obtener_datos_empleadosver();
// });


function obtener_datos_empleadosver() {
    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'empleados', // Parámetro 'run'
            action: 'obtenerempleados' // Parámetro 'action'
        },
        success: function (data) {
            // loading(false); // Quitar el indicador de carga

            if (data.error) {
                alert('Error: ' + data.error); // Mostrar mensaje de error si existe
            } else {
                // Limpia el contenido actual del tbody
                $('#tabla_usuarios').empty();

                // Itera sobre los datos recibidos y genera las filas de la tabla
                $.each(data, function (index, usuario) {
                    console
                    // esto es por si el esta activo o inactivo , 1 es activo y 0 es inactivo
                    var estadoBadge = usuario.estado == '1'
                        ? '<span class="badge badge-pill badge-success">Activo</span>'
                        : '<span class="badge badge-pill badge-danger">Inactivo</span>';

                    var fila = `
                        <tr>
                            <td class="py-3"><input type="checkbox" name="id_correo_enviar[]"value="${usuario.ID}" ></td>
                            <td class="align-middle py-3">${usuario.nombres}</td>
                            <td class="py-3">${usuario.correo}</td>
                            <td class="py-3">${usuario.cede}</td>
                            <td class="py-3">${usuario.fecha_creacion}</td>
                            <td class="py-3">${usuario.Fecha_ingreso}</td>
                            <td class="py-3">${usuario.cargo}</td>
                            <td class="py-3">${usuario.area}</td>
                            <td class="py-3">${estadoBadge}</td>
                            <td class="py-3">
                                <div class="position-relative">
                                    <a style="margin-right: 7px;" class="link-dark d-inline-block" title="Editar empleados" href="#" value="${usuario.ID}" onclick="mostrar_datos_modalEmpleado(${usuario.ID})" data-toggle="modal" data-target="#modalactualizarempleados">
                                        <i class="gd-reload icon-text"></i>
                                    </a>
                                    <a style="margin-right: 7px; class="link-dark d-inline-block" title="Ver mas informacion" href="#" onclick="mostrar_masinfo_modalEmpleado(${usuario.ID})">
                                        <i class="gd-eye icon-text"></i>
                                    </a>
                                    <a  style="margin-right: 7px; class="link-dark d-inline-block" title="Enviar correo" href="#"  value="${usuario.ID}" onclick="obtener_datos_correos(${usuario.ID})">
                                        <i class="gd-email icon-text"></i>
                                    </a>
                              
                                </div>
                            </td>
                        </tr>
                    `;

                    // Añade la fila generada al tbody
                    $('#tabla_usuarios').append(fila);
                    // console.log("este es index: " +usuario.ID)
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
$('#btn_agregar_empleados').on('click', function () {
    agregar_empleados();
});

function agregar_empleados() {
    let nombre_empleado = $('#nombre_empleado').val();
    let correo_empleado = $('#correo_empleado').val();
    let cede_empleado = $('#cede_empleado').val();
    let Fecha_ingreso_empleado = $('#Fecha_ingreso_empleado').val();
    let cargo_empleado = $('#cargo_empleado').val();
    let area_empleado = $('#area_empleado').val();

    if (nombre_empleado === "" || correo_empleado === "" || cede_empleado === "") {
        alert("Los campos obligatorios no deben ir vaios");
        return;
    }

    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'empleados', // Parámetro 'run'
            action: 'agregar_empleados_js', // Parámetro 'action'
            nombre_empleado_json: nombre_empleado, // Parámetro 'nombre_empleado'
            correo_empleado_json: correo_empleado, // Parámetro 'correo_empleado'
            cede_empleado_json: cede_empleado, // Parámetro 'cede_empleado'
            Fecha_ingreso_empleado_json: Fecha_ingreso_empleado, // Parámetro 'Fecha_ingreso_empleado'
            cargo_empleado_json: cargo_empleado, // Parámetro 'cargo_empleado'
            area_empleado_json: area_empleado, // Parámetro 'area_empleado'
        },
        success: function (response) {
            if (response.success) {
                obtener_datos_empleadosver();
                // alert(response.success);
                // Alerta de éxito
                var alerta_agregar_empleados = `
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
                $('#nombre_empleado').val("");
                $('#correo_empleado').val("");
                $('#cede_empleado').val("");
                $('#Fecha_ingreso_empleado').val("");
                $('#cargo_empleado').val("");
                $('#area_empleado').val("");

                // Añadir la alerta al contenedor
                $('#alerta_agregar_empleadoshtml').html(alerta_agregar_empleados);

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




// ------------------------------------------------------------------
// actualizar un empleado
$('#btn_actualizar_empleados').on('click', function () {
    actualizar_empleados();
});

function actualizar_empleados() {
    let id_empleado_actualizar = $('#id_empleado_actualizar').val();
    let nombre_empleado_actualizar = $('#nombre_empleado_actualizar').val().trim();
    let correo_empleado_actualizar = $('#correo_empleado_actualizar').val().trim();
    let cede_empleado_actualizar = $('#cede_empleado_actualizar').val();
    let Fecha_ingreso_empleado_actualizar = $('#fecha_ingreso_empleado_actualizar').val();
    let cargo_empleado_actualizar = $('#cargo_empleado_actualizar').val();
    let area_empleado_actualizar = $('#area_empleado_actualizar').val();
    let estado_empleado_actualizar = $('#estado_empleado_actualizar').val();

    if (nombre_empleado_actualizar === "" || cede_empleado_actualizar === "" || estado_empleado_actualizar === "") {
        alert("Los campos obligatorios no deben ir vaios");
        return;
    }

    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'empleados', // Parámetro 'run'
            action: 'actualizar_empleados_js', // Parámetro 'action'
            id_empleado_actualizar_json: id_empleado_actualizar, // Parámetro 'ID'
            nombre_empleado_actualizar_json: nombre_empleado_actualizar, // Parámetro 'nombre_empleado_actualizar'
            correo_empleado_actualizar_json: correo_empleado_actualizar, // Parámetro 'correo_empleado_actualizar'
            cede_empleado_actualizar_json: cede_empleado_actualizar, // Parámetro 'cede_empleado_actualizar'
            Fecha_ingreso_empleado_actualizar_json: Fecha_ingreso_empleado_actualizar, // Parámetro 'Fecha_ingreso_empleado_actualizar'
            cargo_empleado_actualizar_json: cargo_empleado_actualizar, // Parámetro 'cargo_empleado_actualizar'
            area_empleado_actualizar_json: area_empleado_actualizar, // Parámetro 'area_empleado_actualizar'
            estado_empleado_actualizar_json: estado_empleado_actualizar, // Parámetro 'estado_empleado_actualizar'
        },
        success: function (response) {
            if (response.success) {
                obtener_datos_empleadosver();
                alert(response.success);

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
function mostrar_datos_modalEmpleado(ID) {
    console.log(ID);
    $.ajax({
        url: "exe.php",
        type: "POST",
        dataType: "JSON",
        data: {
            run: 'empleados',
            action: 'obtenerempleado_unico_js', // Nueva acción para obtener un solo empleado
            id_empleado_json: ID
        },
        success: function (data) {
            // actualizar_empleados(ID);
            // console.log("data : " + data + "si" + usuario);
            if (data) {
                // console.log(data);
                $('#id_empleado_actualizar').val(data.ID);
                $('#nombre_empleado_actualizar').val(data.nombres);
                $('#correo_empleado_actualizar').val(data.correo);
                $('#cede_empleado_actualizar').val(data.cede);
                $('#fecha_ingreso_empleado_actualizar').val(data.Fecha_ingreso);
                $('#cargo_empleado_actualizar').val(data.cargo);
                $('#area_empleado_actualizar').val(data.area);
                $('#estado_empleado_actualizar').val(data.estado); // Activo/Inactivo
            } else {
                alert('Error: No se pudieron obtener los datos del empleado.');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al obtener los datos del empleado.');
        }
    });
}



// este es para implementar la funcionalidad de que se puedan ver los detalles del empleado como el que usuario lo registro y etc..
function mostrar_masinfo_modalEmpleado(ID) {
    alert("esto es para ver mas informacion del ID: " + ID);
}
 
// funcion para enviar el id y sacar el correo de ese emppleado
function obtener_datos_correos(ID) {
    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    // if (idsSeleccionados.length > 0) {
        $.ajax({
            url: "exe.php", // Archivo que procesará la solicitud
            type: "POST", // Método de envío
            dataType: "JSON", // Esperamos respuesta en formato JSON
            data: {
                run: 'empleados', // Parámetro 'run'
                action: 'obtenerempleados_correos', // Parámetro 'action'
                ids: ID // Enviar los IDs seleccionados
            },
            success: function (data) {
                // loading(false); // Quitar el indicador de carga
                if (data.error) {
                    alert('Error: ' + data.error); // Mostrar mensaje de error si existe

                } else {
                    contenedro_correo = data.correo;
                    contenedro_nombres = data.nombres;
                    // alert("se envio el correo: " + contenedro_correo);
                    // console.log(contenedro_correo , contenedro_nombres);
                    enviar_correo(contenedro_correo,contenedro_nombres);
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
    // } else {
    //     alert("No has seleccionado ningún empleado.");
    // }
}

function enviar_correo(contenedro_correo,contenedro_nombres) {
    // Convertir el array de correos en una cadena separada por comas
    // var toEmails = data.map(function (empleado) {
    //     return empleado.correo; // Asumiendo que data contiene un array de objetos con un campo 'correo'
    // }).join(',');

    // console.log(toEmails);
    var templateParams = {
        toEmail: contenedro_correo,
        nombre_persona: contenedro_nombres,
        // cc_email: 'escorciacaballeroe@gmail.com', // Agregar el correo en copia
        message: 'este es un correo probando desde base de datos en inventario'
    };

    // Enviar el correo usando EmailJS
    emailjs.send('service_cyxzs99', 'template_ea43mm9', templateParams)
        .then(function (response) {
            alert('Correo enviado con éxito!' + contenedro_correo, response.status, response.text);
        }, function (error) {
            alert('Error al enviar el correo: ' + JSON.stringify(error));
            console.log(contenedro_correo)
        });
}


// -----------------------------------------------------------------
// Evento para seleccionar o deseleccionar todos los checkboxes ademas de anviar el valor a la db
$('#seleccionarTodos').on('click', function () {
    // Obtener el estado actual de todos los checkboxes
    let todosSeleccionados = $('input[name="id_correo_enviar[]"]').length === $('input[name="id_correo_enviar[]"]:checked').length;
    // Marcar o desmarcar todos los checkboxes
    $('input[name="id_correo_enviar[]"]').prop('checked', !todosSeleccionados);
    // Verificar si al menos un checkbox está seleccionado
    let seleccionados = $('input[name="id_correo_enviar[]"]:checked').length > 0;
    // se agrega el boton que se quiere apagar
    $('#btn-enviar-correo').prop('disabled', !seleccionados);
});

// Evento para detectar cambios individuales en los checkboxes
$(document).on('change', 'input[name="id_correo_enviar[]"]', function () {
    let seleccionados = $('input[name="id_correo_enviar[]"]:checked').length > 0;
    // se agrega el boton que se quiere apagar 
    $('#btn-enviar-correo').prop('disabled', !seleccionados);
});
// -----------------------------------------------------------------

// Evento al hacer clic en el botón "Enviar"
$('#btn-enviar-correo').on('click', function () {
    let idsSeleccionados = $('input[name="id_correo_enviar[]"]:checked').map(function () {
        return $(this).val();
    }).get();

    if (idsSeleccionados.length > 0) {
        // obtener_datos_correos(idsSeleccionados);
        alert("si tienes ID seleccionados y son: " + idsSeleccionados);
    } else {
        alert("No has seleccionado ningún empleado.");
    }
});
