// $('#obtener_datos_equiposbtn').on('click', function() {
//     obtener_datos_equipos();
// });

function obtener_datos_equipos() {
    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'equipos', // Parámetro 'run'
            action: 'obtenerequipos' // Parámetro 'action'
        },
        success: function (data) {
            // loading(false); // Quitar el indicador de carga

            if (data.error) {
                alert('Error: ' + data.error); // Mostrar mensaje de error si existe
            } else {
                // Limpia el contenido actual del tbody
                $('#tabla_verequipos').empty();

                // Itera sobre los datos recibidos y genera las filas de la tabla
                $.each(data, function (index, equiposver) {
                    // esto es por si el esta activo o inactivo , 1 es activo y 0 es inactivo
                    var estadoBadge = equiposver.estado == '1'
                        ? '<span class="badge badge-pill badge-success">Activo</span>'
                        : '<span class="badge badge-pill badge-danger">Inactivo</span>';

                    var fila = `
                        <tr>
                            <td class="py-3">${index + 1}</td>
                            <td class="align-middle py-3">${equiposver.tipo}</td>
                            <td class="py-3">${equiposver.marca}</td>
                            <td class="py-3">${equiposver.serial}</td>
                            <td class="py-3">${equiposver.direccion_mac_wifi}</td>
                            <td class="py-3">${equiposver.direccion_mac_ethenet}</td>
                            <td class="py-3">${equiposver.imei1}</td>
                            <td class="py-3">${equiposver.imei2}</td>
                            <td class="py-3">${equiposver.fecha_creacion}</td>
                             <td class="py-3">${equiposver.estado}</td>
                            <td class="py-3">
                                <div class="position-relative">
                                    <a class="link-dark d-inline-block" href="#" value="${equiposver.ID}" onclick="mostrar_datos_modalEquipos(${equiposver.ID})" data-toggle="modal" data-target="#modalactualizarequipos" >
                                        <i class="gd-reload icon-text"></i>
                                    </a>
                                    <a class="link-dark d-inline-block" href="#" onclick="mostrar_masinfo_modalEquipos(${equiposver.ID})">
                                        <i class="gd-eye icon-text"></i>
                                    </a>
                              
                                </div>
                            </td>
                        </tr>
                    `;

                    // Añade la fila generada al tbody
                    $('#tabla_verequipos').append(fila);
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
$('#btn_agregar_equipos').on('click', function () {
    agregar_equipos();
});


function agregar_equipos() {
    let tipo_equipo = $('#tipo_equipo').val();
    let marca_equipo = $('#marca_equipo').val();
    let serial_equipo = $('#serial_equipo').val();
    let dire_mac_wifi_equipo = $('#dire_mac_wifi_equipo').val();
    let dire_mac_ethernet_equipo = $('#dire_mac_ethernet_equipo').val();
    let imei1_equipo = $('#imei1_equipo').val();
    let imei2_equipo = $('#imei2_equipo').val();
    let estado_equipo = $('#estado_equipo').val();
    let observacion_equipo = $('#observacion_equipo').val();

    if (tipo_equipo === "" || estado_equipo==="") {
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
            action: 'agregar_equipos_js', // Parámetro 'action'
            tipo_equipo_json: tipo_equipo, // Parámetro 'tipo_equipo'
            marca_equipo_json: marca_equipo, // Parámetro 'marca_equipo'
            serial_equipo_json: serial_equipo, // Parámetro 'serial_equipo'
            dire_mac_wifi_equipo_json: dire_mac_wifi_equipo, // Parámetro 'dire_mac_wifi_equipo'
            dire_mac_ethernet_equipo_json: dire_mac_ethernet_equipo, // Parámetro 'dire_mac_ethernet_equipo'
            imei1_equipo_json: imei1_equipo, // Parámetro 'imei1_equipo'
            imei2_equipo_json: imei2_equipo, // Parámetro 'imei2_equipo'
            estado_equipo_json: estado_equipo, // Parámetro 'estado_equipo'
            observacion_equipo_json: observacion_equipo, // Parámetro 'observacion_equipo'
        },
        success: function (response, data) {

            // alert("se guardó");
            if (response.success) {
                obtener_datos_equipos(); 
                // alert(response.success);
                // Alerta de éxito
                var alerta_agregar_equipos = `
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
                $('#tipo_equipo').val("");
                $('#marca_equipo').val("");
                $('#serial_equipo').val("");
                $('#dire_mac_wifi_equipo').val("");
                $('#dire_mac_ethernet_equipo').val("");
                $('#imei1_equipo').val("");
                $('#imei2_equipo').val("");
                $('#estado_equipo').val("");
                $('#observacion_equipo').val("");

                // Añadir la alerta al contenedor
                $('#alerta_agregar_equiposhtml').html(alerta_agregar_equipos);

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

// actualizar un equipos
$('#btn_actualizar_equipos').on('click', function () {
    actualizar_equipos();
    // alert("esta es una alerta");
});

function actualizar_equipos() {
    let id_equipo_actualizar = $('#id_equipo_actualizar').val();
    let tipo_equipo_actualizar = $('#tipo_equipo_actualizar').val();
    let marca_equipo_actualizar = $('#marca_equipo_actualizar').val();
    let serial_equipo_actualizar = $('#serial_equipo_actualizar').val();
    let dire_mac_wifi_equipo_actualizar = $('#dire_mac_wifi_equipo_actualizar').val();
    let dire_mac_ethernet_equipo_actualizar = $('#dire_mac_ethernet_equipo_actualizar').val();
    let imei1_equipo_actualizar = $('#imei1_equipo_actualizar').val();
    let imei2_equipo_actualizar = $('#imei2_equipo_actualizar').val();
    let estado_equipo_actualizar = $('#estado_equipo_actualizar').val();
    let observacion_equipo_actualizar = $('#observacion_equipo_actualizar').val();

    // if (nombre_empleado_actualizar === "" || cede_empleado_actualizar === "" || estado_empleado_actualizar === "") {
    //     alert("Los campos obligatorios no deben ir vaios");
    //     return;
    // }

    // loading(true); // Puedes mostrar un indicador de carga aquí si lo necesitas
    $.ajax({
        url: "exe.php", // Archivo que procesará la solicitud
        type: "POST", // Método de envío
        dataType: "JSON", // Esperamos respuesta en formato JSON
        data: {
            run: 'equipos', // Parámetro 'run'
            action: 'actualizar_equipo_js', // Parámetro 'action'
            id_equipo_actualizar_json: id_equipo_actualizar, // Parámetro 'ID'
            tipo_equipo_actualizar_json: tipo_equipo_actualizar, // Parámetro 'tipo_equipo_actualizar'
            marca_equipo_actualizar_json: marca_equipo_actualizar, // Parámetro 'marca_equipo'
            serial_equipo_actualizar_json: serial_equipo_actualizar, // Parámetro 'serial_equipo'
            dire_mac_wifi_equipo_actualizar_json: dire_mac_wifi_equipo_actualizar, // Parámetro 'dire_mac_wifi_equipo'
            dire_mac_ethernet_equipo_actualizar_json: dire_mac_ethernet_equipo_actualizar, // Parámetro 'dire_mac_ethernet_equipo'
            imei1_equipo_actualizar_json: imei1_equipo_actualizar, // Parámetro 'imei1_equipo_actualizar'
            imei2_equipo_actualizar_json: imei2_equipo_actualizar, // Parámetro 'imei2_equipo_actualizar'
            estado_equipo_actualizar_json: estado_equipo_actualizar, // Parámetro 'estado_equipo_actualizar'
            observacion_equipo_actualizar_json: observacion_equipo_actualizar, // Parámetro 'observacion_equipo_actualizar'
        },
        success: function (response) {
            if (response.success) {
                obtener_datos_equipos();
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
function mostrar_datos_modalEquipos(ID) {
    console.log(ID);
    $.ajax({
        url: "exe.php",
        type: "POST",
        dataType: "JSON",
        data: {
            run: 'equipos',
            action: 'obtenerequipo_unico_js', // Nueva acción para obtener un solo empleado
            id_quipo_json: ID
        },
        success: function (data) {
            // actualizar_empleados(ID);
            // console.log("data : " + data + "si" + usuario);
            if (data) {
                // console.log(data);
                $('#id_equipo_actualizar').val(data.ID);
                $('#tipo_equipo_actualizar').val(data.tipo);
                $('#marca_equipo_actualizar').val(data.marca);
                $('#serial_equipo_actualizar').val(data.serial);
                $('#dire_mac_wifi_equipo_actualizar').val(data.direccion_mac_wifi);
                $('#dire_mac_ethernet_equipo_actualizar').val(data.direccion_mac_ethenet);
                $('#imei1_equipo_actualizar').val(data.imei1);
                $('#imei2_equipo_actualizar').val(data.imei2);
                $('#estado_equipo_actualizar').val(data.estado); // Activo/Inactivo
                $('#observacion_equipo_actualizar').val(data.observacion); // Activo/Inactivo
            } else {
                alert('Error: No se pudieron obtener los datos del equipo.');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al obtener los datos del empleado.');
        }
    });
}



// este es para implementar la funcionalidad de que se puedan ver los detalles del empleado como el que usuario lo registro y etc..
function mostrar_masinfo_modalEquipos(ID) {
    alert("esto es para ver mas informacion del ID: " + ID);
}