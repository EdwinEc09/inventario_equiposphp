<?php
include('backend/conexion/conexion.php'); // Incluir la clase que maneja la conexión y funciones
include('backend/php/empleadosback.php');
session_start();

$OS = new OutSourcing(); // Instancia de la clase
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
                    $usuarios = $OS->obtenerempleadosjson();
                    
                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($usuarios);
                    break; 
                    
                case 'agregar_empleados_js':
                    $pasar_a_json = $OS->agregar_empleados_json(
                        $_POST['nombre_empleado_json'],
                        $_POST['correo_empleado_json'],
                        $_POST['cede_empleado_json'],
                        $_POST['Fecha_ingreso_empleado_json'],
                        $_POST['cargo_empleado_json'],
                        $_POST['area_empleado_json']
                    );
                    echo json_encode($pasar_a_json);
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
                    $equiposver = $OS->obtenerequiposjson();

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($equiposver);
                    break;

                case 'agregar_equipos_js':
                    $pasar_equipos_a_json = $OS->agregar_equipos_json(
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
                    $asignacionesver = $OS->obtenerasignacionesjson();

                    // Asegúrate de devolver los datos como JSON
                    echo json_encode($asignacionesver);
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

?>