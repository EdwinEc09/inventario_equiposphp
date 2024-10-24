<?php
require_once 'backend/conexion/conexion.php';

class AjustesEquipos extends OutSourcing
{
    // OBTENER estados de equipos a esepcion de los logs
    public function obtenerestadosequiposjson()
    {
        $conn = $this->dbConnect();
        // $id_prueba = 1;
        if ($conn) {
            // este es para que me puestre todos execpto los logs 0 -
            // 1 es un registro valido - 0 es un log osea un registro historico
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
    public function agregar_estadosequipos_json($agregar_estados_estadoequipos_json, $agregar_colorestado_estadoequipos_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            // Obtener la fecha y hora actual
            // $fecha_creacion_json = date("Y-m-d H:i:s");
            $fecha_registro_json = date("Y-m-d h:i:s A");

            // Consulta para insertar un nuevo empleado
            $sql = "INSERT INTO estado_equipos (nombre_estado,color_estado,estado,fecha_registro) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los valores proporcionados
            $stmt->execute([$agregar_estados_estadoequipos_json, $agregar_colorestado_estadoequipos_json, 1, $fecha_registro_json]);
            // Si la inserción fue exitosa, devolver true o algún mensaje
            if ($stmt->rowCount() > 0) {
                // Obtener el ID insertado
                $lastInsertId = $conn->lastInsertId();

                // Registro en la tabla de logs
                $sql_log = "INSERT INTO estado_equipos_logs (estado_id, nombre_estado, color_estado, estado, fecha_registro, tipo_operacion) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_log = $conn->prepare($sql_log);
                $stmt_log->execute([
                    $lastInsertId,
                    $agregar_estados_estadoequipos_json,
                    $agregar_colorestado_estadoequipos_json,
                    1,
                    $fecha_registro_json,
                    'Inserción',
                    // $usuario
                ]);
                return ['success' => 'estado equipo agregado exitosamente.'];
            } else {
                return ['error' => 'Error al insertar el  estado de equipos.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // hace la conulta para actualizar el estado aunque en realidad se está es insertando un dato nuevo y solo se actualiza el tipo de dato a 0 osea un log
    // esto se hace así para que quede registro de lo que la persona va actualizando
    public function actualiza_estadosequipos_json($actualizar_ID_estadoequipos_json, $actualizar_estados_estadoequipos_json, $actualizar_colorestado_estadoequipos_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            // $fecha_actualizacion_json = date("Y-m-d h:i:s A");
            $fecha_actualizacion_json = date("Y-m-d h:i:s A");
            // Actualizar el registro original con los nuevos datos proporcionados por el usuario
            $sql_update = "UPDATE estado_equipos SET nombre_estado = ?, color_estado = ?, estado = ?, fecha_actualizacion = ? WHERE ID = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->execute([$actualizar_estados_estadoequipos_json, $actualizar_colorestado_estadoequipos_json, 1, $fecha_actualizacion_json, $actualizar_ID_estadoequipos_json]);

            if ($stmt_update) {
                // Obtener los datos del registro actual
                $sql_select = "SELECT nombre_estado, color_estado, estado,fecha_registro FROM estado_equipos WHERE ID = ?";
                $stmt_select = $conn->prepare($sql_select);
                $stmt_select->execute([$actualizar_ID_estadoequipos_json]);
                $registro_actual = $stmt_select->fetch();

                // Guardar el registro actual en la tabla de logs
                $sql_log = "INSERT INTO estado_equipos_logs (estado_id, nombre_estado, color_estado, estado,fecha_registro, fecha_actualizacion,tipo_operacion) VALUES (?, ?, ?, ?, ?,?,?)";
                $stmt_log = $conn->prepare($sql_log);
                $stmt_log->execute([
                    $actualizar_ID_estadoequipos_json, // ID del estado original
                    $registro_actual['nombre_estado'], // Nombre estado anterior
                    $registro_actual['color_estado'], // Color estado anterior
                    $registro_actual['estado'], // Estado anterior
                    $registro_actual['fecha_registro'], // Estado anterior
                    $fecha_actualizacion_json,
                    'Actualización',
                ]);

                return ['success' => 'Registro actualizado y se ha creado un log exitosamente.'];
            } else {
                return ['error' => 'No se encontró el estado de equipo a actualizar.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // esta es para obtener el estado en estado_equipos y luego actualizar
    // osea me retorna los datos en los campos del html
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
            $sql = "SELECT DISTINCT ID , nombre_estado FROM estado_equipos WHERE nombre_estado NOT IN ('')";

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

    // este es para que inactive o active varios estados de estadoequipos
    public function activar_inactivar_varios_estadoequipos_json($ids_estadoseqipos, $estado_estadoequipos_varios_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            // Si $ids_estados es un array, convierte cada ID en un entero
            $ids_estadoseqipos = array_map('intval', $ids_estadoseqipos);

            // Crea un marcador de posición para cada ID
            $placeholders = implode(',', array_fill(0, count($ids_estadoseqipos), '?'));

            // Preparar la consulta SQL para actualizar el estado de varios empleados
            $sql = "UPDATE estado_equipos SET estado = ? WHERE ID IN ($placeholders)";

            // Preparar la declaración SQL
            $stmt = $conn->prepare($sql);

            // Crear un array para bindParam: primero el estado, seguido de los IDs
            $params = array_merge([$estado_estadoequipos_varios_json], $ids_estadoseqipos);

            // Ejecutar la consulta con los parámetros
            $result = $stmt->execute($params);

            // Verificar si se actualizaron filas
            if ($result) {
                return ['success' => 'Los estados se han actualizado correctamente.'];
            } else {
                return ['error' => 'Error al actualizar los estados.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    //-------------------------------------------------------------
    // tipos de equipos --------------------------------------------------------

    // OBTENER TIPOS DE EQUIPOS
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
    // fin
}
