<?php
require_once 'backend/conexion/conexion.php';

class Asignaciones extends OutSourcing
{
    // asignaciones------------
    // OBTENER EQUIPOS
    public function obtenerasignacionesjson()
    {
        $conn = $this->dbConnect();
        // $id_prueba = 1;
        if ($conn) {
            // $sql = "SELECT * FROM empleados WHERE ID = ? ";
            $sql = "SELECT e.ID,  ee.nombres,te.tipo,te.marca,e.fecha_asignacion, e.fecha_registro, e.estado_asignacion, e.acta_firmada FROM asignaciones e JOIN empleados ee ON e.id_empleado = ee.ID JOIN equipos te ON e.id_equipos = te.ID;";
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
    public function agregar_asignacion_json($empleado_asignacion_json, $equipo_asignacion_json, $fecha_asignacion_asignaciones_json, $acta_firmada_asignacion_json)
    {
        $conn = $this->dbConnect();

        if ($conn) {
            // Obtener la fecha y hora actual
            // $fecha_creacion_json = date("Y-m-d h:i:s A");
            // Obtener la fecha y hora actuales
            $fecha_creacion_json = date("Y-m-d H:i:s");
            // Estado de asignación: 1 = Activo/Asignado
            $estado_asignacion_json = 1;

            // Iniciar una transacción para asegurarse de que ambas consultas se ejecuten correctamente
            $conn->beginTransaction();

            try {
                // Consulta para insertar una nueva asignación
                $sql = "INSERT INTO asignaciones (id_empleado, id_equipos, fecha_asignacion, fecha_registro, estado_asignacion, acta_firmada)
                            VALUES (?, ?, ?, ?, ?, ?);";
                $stmt = $conn->prepare($sql);

                // Ejecutar la consulta con los valores proporcionados
                $stmt->execute([$empleado_asignacion_json, $equipo_asignacion_json, $fecha_asignacion_asignaciones_json, $fecha_creacion_json, $estado_asignacion_json, $acta_firmada_asignacion_json]);

                // Si la inserción fue exitosa, actualizar el estado del equipo a 'asignado'
                if ($stmt->rowCount() > 0) {
                    // Cambiar el estado del equipo a 'asignado' (estado = 2)
                    $sql_update = "UPDATE equipos SET estado = 'Asignado' WHERE ID = ?;";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->execute([$equipo_asignacion_json]);

                    // Verificar si la actualización fue exitosa
                    if ($stmt_update->rowCount() > 0) {
                        // Confirmar la transacción
                        $conn->commit();
                        return ['success' => 'Asignación y actualización de equipo exitosas.'];
                    } else {
                        // Revertir la transacción en caso de fallo al actualizar el equipo
                        $conn->rollBack();
                        return ['error' => 'Error al actualizar el estado del equipo.'];
                    }
                } else {
                    // Revertir la transacción si la inserción de la asignación falla
                    $conn->rollBack();
                    return ['error' => 'Error al insertar la asignación.'];
                }
            } catch (Exception $e) {
                // En caso de cualquier error, revertir la transacción
                $conn->rollBack();
                return ['error' => 'Excepción capturada: ' . $e->getMessage()];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // Añade el resto de las funciones para equipos aquí
}
