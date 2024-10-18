<?php
require_once 'backend/conexion/conexion.php';

class Equipos extends OutSourcing
{
    public function obtenerequiposjson()
    {
        $conn = $this->dbConnect();
        if ($conn) {
            // $sql = "SELECT * FROM equipos";
            $sql = "SELECT e.ID, e.tipo, e.marca, e.serial, e.direccion_mac_wifi, e.direccion_mac_ethenet, e.imei1, e.imei2, e.fecha_creacion, ee.estado,ee.color_estado, e.observacion FROM equipos e JOIN estado_equipos ee ON e.estado = ee.ID;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    public function obtenerequipo_unicojson($id_equipo_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            $sql = "SELECT * FROM equipos WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_equipo_json]);
            $equipo = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($equipo) {
                return $equipo;
            } else {
                return ['error' => 'Equipo no encontrado.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // OBTENER EQUIPOS
    public function obtenertipoequiposjson()
    {
        $conn = $this->dbConnect();
        // $id_prueba = 1;
        if ($conn) {
            // $sql = "SELECT * FROM empleados WHERE ID = ? ";
            $sql = "SELECT * FROM tipos_equipos ";
            $stmt = $conn->prepare($sql);
            // $stmt->execute([$id_prueba]);
            $stmt->execute(); // Sin parámetros porque queremos obtener todos los registros

            // Devolver los resultados en un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // OBTENER estados de equipos
    public function obtenerestadosequiposjson()
    {
        $conn = $this->dbConnect();
        // $id_prueba = 1;
        if ($conn) {
            // $sql = "SELECT * FROM empleados WHERE ID = ? ";
            $sql = "SELECT * FROM estado_equipos ";
            $stmt = $conn->prepare($sql);
            // $stmt->execute([$id_prueba]);
            $stmt->execute(); // Sin parámetros porque queremos obtener todos los registros

            // Devolver los resultados en un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es para que me devuelva todos los datos de una tabla
    public function agregar_equipos_json($tipo_equipo_json, $marca_equipo_json, $serial_equipo_json, $dire_mac_wifi_equipo_json, $dire_mac_ethernet_equipo_json, $imei1_equipo_json, $imei2_equipo_json, $estado_equipo_json, $observacion_equipo_json)
    {
        $conn = $this->dbConnect();

        if ($conn) {
            // Obtener la fecha y hora actual
            // $fecha_creacion_json = date("Y-m-d H:i:s");
            $fecha_creacion_json = date("Y-m-d h:i:s A");

            // Consulta para insertar un nuevo empleado
            $sql = "INSERT INTO equipos (tipo, marca, serial, direccion_mac_wifi, direccion_mac_ethenet, imei1, imei2,fecha_creacion,estado,observacion) VALUES (?, ?, ?, ?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los valores proporcionados
            $stmt->execute([$tipo_equipo_json, $marca_equipo_json, $serial_equipo_json, $dire_mac_wifi_equipo_json, $dire_mac_ethernet_equipo_json, $imei1_equipo_json, $imei2_equipo_json, $fecha_creacion_json, $estado_equipo_json, $observacion_equipo_json]);
            // Si la inserción fue exitosa, devolver true o algún mensaje
            if ($stmt->rowCount() > 0) {
                return ['success' => 'equipo agregado exitosamente.'];
            } else {
                return ['error' => 'Error al insertar el equipos.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es para que me devuelva todos los datos de una tabla
    public function actualizar_equipo_json($id_equipo_actualizar_json, $tipo_equipo_actualizar_json, $marca_equipo_actualizar_json, $serial_equipo_actualizar_json, $dire_mac_wifi_equipo_actualizar_json, $dire_mac_ethernet_equipo_actualizar_json, $imei1_equipo_actualizar_json, $imei2_equipo_actualizar_json, $estado_equipo_actualizar_json, $observacion_equipo_actualizar_json)
    {
        $conn = $this->dbConnect();

        if ($conn) {
            // Primero, obtenemos el estado actual del empleado en la base de datos
            $sql_verificar = "SELECT estado FROM equipos WHERE ID = ?";
            $stmt_verificar = $conn->prepare($sql_verificar);
            $stmt_verificar->execute([$id_equipo_actualizar_json]);
            $empleado = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

            // Verificar si el empleado fue encontrado
            if ($empleado) {
                $estado_actual = $empleado['estado']; // Estado actual del empleado (activo/inactivo)

                // Si el empleado está inactivo y no se intenta activarlo, no permitir la actualización
                if ($estado_actual == "Inactivo" && $estado_equipo_actualizar_json == "Inactivo") {
                    return ['error' => 'El equipo está inactivo. No se pueden modificar otros campos mientras esté inactivo.'];
                }

                // Si se llega aquí, significa que:
                // - El empleado está activo, o
                // - Se está intentando cambiar su estado (de inactivo a activo o viceversa)

                // Consulta para actualizar el empleado
                $sql = "UPDATE equipos SET tipo = ?, marca = ?, serial = ?, direccion_mac_wifi = ?, direccion_mac_ethenet = ?, imei1 = ?, imei2 = ?,estado =?,observacion =? WHERE ID = ?";
                $stmt = $conn->prepare($sql);

                // Ejecutar la consulta con los valores proporcionados
                $stmt->execute([
                    $tipo_equipo_actualizar_json,
                    $marca_equipo_actualizar_json,
                    $serial_equipo_actualizar_json,
                    $dire_mac_wifi_equipo_actualizar_json,
                    $dire_mac_ethernet_equipo_actualizar_json,
                    $imei1_equipo_actualizar_json,
                    $imei2_equipo_actualizar_json,
                    $estado_equipo_actualizar_json,
                    $observacion_equipo_actualizar_json,
                    $id_equipo_actualizar_json,
                ]);

                // Verificar si la actualización fue exitosa
                if ($stmt->rowCount() > 0) {
                    return ['success' => 'equipo actualizado exitosamente.'];
                } else {
                    return ['error' => 'Error al actualizar el equipo.'];
                }
            } else {
                return ['error' => 'equipo no encontrado.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es para que me devuelva todos los datos de una tabla
    public function agregar_tiposequipos_json($tipos_equipos_tiposequipos_json)
    {
        $conn = $this->dbConnect();

        if ($conn) {
            // Obtener la fecha y hora actual
            // $fecha_creacion_json = date("Y-m-d H:i:s");
            $fecha_creacion_json = date("Y-m-d h:i:s A");

            // Consulta para insertar un nuevo empleado
            $sql = "INSERT INTO tipos_equipos (tipo) VALUES (?)";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los valores proporcionados
            $stmt->execute([$tipos_equipos_tiposequipos_json]);
            // Si la inserción fue exitosa, devolver true o algún mensaje
            if ($stmt->rowCount() > 0) {
                return ['success' => 'equipo agregado exitosamente.'];
            } else {
                return ['error' => 'Error al insertar el equipos.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es para que me devuelva todos los datos de una tabla
    public function agregar_estadosequipos_json($agregar_estados_estadoequipos_json,$agregar_colorestado_estadoequipos_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            // Obtener la fecha y hora actual
            // $fecha_creacion_json = date("Y-m-d H:i:s");
            $fecha_creacion_json = date("Y-m-d h:i:s A");

            // Consulta para insertar un nuevo empleado
            $sql = "INSERT INTO estado_equipos (estado,color_estado) VALUES (?,?)";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los valores proporcionados
            $stmt->execute([$agregar_estados_estadoequipos_json,$agregar_colorestado_estadoequipos_json]);
            // Si la inserción fue exitosa, devolver true o algún mensaje
            if ($stmt->rowCount() > 0) {
                return ['success' => 'estado equipo agregado exitosamente.'];
            } else {
                return ['error' => 'Error al insertar el  estado de equipos.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }


    // hace la conulta para actualizar el estado 
    public function actualiza_estadosequipos_json($actualizar_ID_estadoequipos_json,$actualizar_estados_estadoequipos_json,$actualizar_colorestado_estadoequipos_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {

            $sql = "UPDATE estado_equipos SET estado = ? , color_estado= ? WHERE ID = ?;";
            $stmt = $conn->prepare($sql);
            // Ejecutar la consulta con los valores proporcionados
            $stmt->execute([$actualizar_estados_estadoequipos_json,$actualizar_colorestado_estadoequipos_json,$actualizar_ID_estadoequipos_json]);
            // Si la inserción fue exitosa, devolver true o algún mensaje
            if ($stmt->rowCount() > 0) {
                return ['success' => 'estado equipo actualizado exitosamente.'];
            } else {
                return ['error' => 'Error al actualizar el  estado de equipos.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }


    // esta es para obtener el estado en estado_equipos y luego actualizar
    public function obtener_estadoequipo_unico_json($id_estadoequipo_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            $sql = "SELECT * FROM estado_equipos WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_estadoequipo_json]);
            $equipo = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($equipo) {
                return $equipo;
            } else {
                return ['error' => 'Equipo no encontrado.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es estado de equipos listar combo
    public function estados_equipos_listar_combo()
    {
        $conn = $this->dbConnect(); // Asegúrate de que dbConnect devuelve la conexión
        if ($conn) {
            $sql = "SELECT DISTINCT ID , estado FROM estado_equipos WHERE estado NOT IN ('')";

            $query = $conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);

            // Verifica si la consulta devolvió algún resultado
            if (!$result) {
                return [];
            } else {
                return $result;
            }
        } else {
            // Si no hay conexión, retorna un error o una lista vacía
            return [];
        }
    }
    // este es tipo de equipos listar combo
    public function tipos_equipos_listar_combo()
    {
        $conn = $this->dbConnect(); // Asegúrate de que dbConnect devuelve la conexión
        if ($conn) {
            $sql = "SELECT DISTINCT tipo FROM tipos_equipos WHERE tipo NOT IN ('')";

            $query = $conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);

            // Verifica si la consulta devolvió algún resultado
            if (!$result) {
                return [];
            } else {
                return $result;
            }
        } else {
            // Si no hay conexión, retorna un error o una lista vacía
            return [];
        }
    }
    // este es para listar los equipos y se guarde la asinacion
    public function equipos_listar_combo()
    {
        $conn = $this->dbConnect(); // Asegúrate de que dbConnect devuelve la conexión
        if ($conn) {
            $sql = "SELECT ID,marca,serial,tipo FROM equipos where  estado = 1";
            // select distinct ID,marca,serial from equipos where  tipo not in ('');
            // select ID,marca,serial,tipo from equipos where  estado = 'Disponible';
            $query = $conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);

            // Verifica si la consulta devolvió algún resultado
            if (!$result) {
                return [];
            } else {
                return $result;
            }
        } else {
            // Si no hay conexión, retorna un error o una lista vacía
            return [];
        } 
    }

    // Añade el resto de las funciones para equipos aquí
}
