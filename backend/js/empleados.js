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
                            <td class="py-3">${index + 1}</td>
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
                                    <a class="link-dark d-inline-block" title="Editar empleados" href="#editar-empleados" data-toggle="modal" data-target="#modalactualizarempleados">
                                        <i class="gd-pencil icon-text"></i>
                                    </a>
                                    <a class="link-dark d-inline-block" title="Ver mas informacion" href="#mas-info-empleados">
                                        <i class="gd-eye icon-text"></i>
                                    </a>
                              
                                </div>
                            </td>
                        </tr>
                    `;

                    // Añade la fila generada al tbody
                    $('#tabla_usuarios').append(fila);
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
//     obtener_datos_empleadosver()
//     obtener_datos_equipos()
// }


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
                setTimeout(function() {
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
