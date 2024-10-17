<?php
include 'backend/conexion/conexion.php'; // Incluir la clase que maneja la conexión y funciones
include 'backend/php/empleadosback.php';
include 'backend/php/equiposback.php';
include 'backend/php/asignacionesback.php';
session_start();

$OS = new OutSourcing(); // Instancia de la clase
$EmpleadosOS = new Empleados(); // Instancia de la clase
$EquiposOS = new Equipos(); // Instancia de la clase
$AsignacionesOS = new Asignaciones(); // Instancia de la clase
$User = null;

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['userdata'])) {
    $User = unserialize($_SESSION['userdata']);
}

// Verifica si se ha enviado una solicitud con 'run' y 'action'
if (isset($_POST['run']) && isset($_POST['action'])) {
    switch ($_POST['run']) {
        case 'empleados':
            switch ($_POST['action']) {
                case 'obtenerempleados':
                    // Obtener los datos de la base de datos
                    $usuarios = $EmpleadosOS->obtenerempleadosjson();

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($usuarios);
                    break;
                case 'masinformacionempleados_js':
                    // Obtener los datos de la base de datos
                    $usuarios = $EmpleadosOS->masinformacionempleadosjson($_POST['id_empleado_masinformacion']);

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($usuarios);
                    break;
                // este obtiene un solo empleado para despues hacer la actualizacion
                case 'obtenerempleado_unico_js':
                    // Obtener los datos de la base de datos
                    $empleados_unicos = $EmpleadosOS->obtenerempleado_unicojson($_POST['id_empleado_json']);

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($empleados_unicos);
                    break;
                // este obtiene un solo correo para despues hacer el envio del correo
                
                case 'obtenerempleados_correos':
                    // Obtener los datos de la base de datos
                    $empleados_correo = $EmpleadosOS->obtenerempleado_correojson($_POST['ids']);
                
                    // Asegúrate de devolver los datos como JSON 
                    echo json_encode($empleados_correo);
                    break;
                case 'actulizar_varios_estados_js':
                    // Obtener los datos de la base de datos
                    $empleados_correo = $EmpleadosOS->actualizar_varios_estados_empleadosjson($_POST['ids_estados'],$_POST['estados_actualizar_empleados']);
                
                    // Asegúrate de devolver los datos como JSON 
                    echo json_encode($empleados_correo);
                    break;
                
 
                case 'agregar_empleados_js':
                    $pasar_a_json = $EmpleadosOS->agregar_empleados_json(
                        $_POST['nombre_empleado_json'],
                        $_POST['correo_empleado_json'],
                        $_POST['cede_empleado_json'],
                        $_POST['Fecha_ingreso_empleado_json'],
                        $_POST['cargo_empleado_json'],
                        $_POST['area_empleado_json']
                    );
                    echo json_encode($pasar_a_json);
                    break;

                case 'actualizar_empleados_js':
                    $actualizar_empleados_a_json = $EmpleadosOS->actualizar_empleados_json(
                        $_POST['id_empleado_actualizar_json'],
                        $_POST['nombre_empleado_actualizar_json'],
                        $_POST['correo_empleado_actualizar_json'],
                        $_POST['cede_empleado_actualizar_json'],
                        $_POST['Fecha_ingreso_empleado_actualizar_json'],
                        $_POST['cargo_empleado_actualizar_json'],
                        $_POST['area_empleado_actualizar_json'],
                        $_POST['estado_empleado_actualizar_json']
                    );
                    echo json_encode($actualizar_empleados_a_json);
                    break;

                default:
                    echo json_encode(['error' => 'Acción no válida en el case empleados']);
                    break;
            }
            break;

        case 'equipos':
            switch ($_POST['action']) {
                case 'obtenerequipos':
                    // Obtener los datos de la base de datos
                    $equiposver = $EquiposOS->obtenerequiposjson();

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($equiposver);
                    break;

                // ver tipos de equipo
                case 'obtenertipoequipos':
                    // Obtener los datos de la base de datos
                    $tipoequiposver = $EquiposOS->obtenertipoequiposjson();

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($tipoequiposver);
                    break;
                // ver estados de equipo
                case 'obtenerestadosequipos':
                    // Obtener los datos de la base de datos
                    $tipoequiposver = $EquiposOS->obtenerestadosequiposjson();

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($tipoequiposver);
                    break;

                case 'agregar_equipos_js':
                    $pasar_equipos_a_json = $EquiposOS->agregar_equipos_json(
                        $_POST['tipo_equipo_json'],
                        $_POST['marca_equipo_json'],
                        $_POST['serial_equipo_json'],
                        $_POST['dire_mac_wifi_equipo_json'],
                        $_POST['dire_mac_ethernet_equipo_json'],
                        $_POST['imei1_equipo_json'],
                        $_POST['imei2_equipo_json'],
                        $_POST['estado_equipo_json'],
                        $_POST['observacion_equipo_json']
                    );
                    echo json_encode($pasar_equipos_a_json);
                    break;

                case 'actualizar_equipo_js':
                    $pasar_actualizar_equipo_a_json = $EquiposOS->actualizar_equipo_json(
                        $_POST['id_equipo_actualizar_json'],
                        $_POST['tipo_equipo_actualizar_json'],
                        $_POST['marca_equipo_actualizar_json'],
                        $_POST['serial_equipo_actualizar_json'],
                        $_POST['dire_mac_wifi_equipo_actualizar_json'],
                        $_POST['dire_mac_ethernet_equipo_actualizar_json'],
                        $_POST['imei1_equipo_actualizar_json'],
                        $_POST['imei2_equipo_actualizar_json'],
                        $_POST['estado_equipo_actualizar_json'],
                        $_POST['observacion_equipo_actualizar_json']
                    );
                    echo json_encode($pasar_actualizar_equipo_a_json);
                    break;

                case 'obtenerequipo_unico_js':
                    // Obtener los datos de la base de datos
                    $equipos_unicos = $EquiposOS->obtenerequipo_unicojson($_POST['id_quipo_json']);

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($equipos_unicos);
                    break;

                // agregar tipos de equipos
                case 'agregar_tiposequipos_json':
                    $pasar_tiposequipos_a_json = $EquiposOS->agregar_tiposequipos_json(
                        $_POST['tipos_equipos_tiposequipos_json']

                    );
                    echo json_encode($pasar_tiposequipos_a_json);
                    break;
                // agregar tipos de equipos
                case 'agregar_estadosequipos_js':
                    $pasar_estadosequipos_a_json = $EquiposOS->agregar_estadosequipos_json(
                        $_POST['estados_equipos_tiposequipos_json'],
                        $_POST['colorestado_equipos_tiposequipos_json']

                    );
                    echo json_encode($pasar_estadosequipos_a_json);
                    break;

                // default
                default:
                    echo json_encode(['error' => 'Acción no válida en el case equipos']);
                    break;
            }
            break;
        case 'asignaciones':
            switch ($_POST['action']) {
                case 'obtenerasignaciones':
                    // Obtener los datos de la base de datos
                    $asignacionesver = $AsignacionesOS->obtenerasignacionesjson();

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($asignacionesver);
                    break;

                case 'agregar_asignacion_js':
                    $pasar_asignaciones_a_json = $AsignacionesOS->agregar_asignacion_json(
                        $_POST['empleado_asignacion_json'],
                        $_POST['equipo_asignacion_json'],
                        $_POST['fecha_asignacion_asignaciones_json'],
                        $_POST['acta_firmada_asignacion_json']

                    );
                    echo json_encode($pasar_asignaciones_a_json);
                    break;

                // default
                default:
                    echo json_encode(['error' => 'Acción no válida en el case asignaciones']);
                    break;
            }
            break;

        default:
            echo json_encode(['error' => 'Acción no válida en el exe']);
            break;
    }
} else {
    echo json_encode(['error' => 'No se han recibido parámetros']);
}
