<?php
require_once 'backend/conexion/conexion.php';

class Empleados extends OutSourcing
{
    public function obtenerempleadosjson()
    {
        $conn = $this->dbConnect();
        if ($conn) {
            $sql = "SELECT * FROM empleados";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es para ver mas informacion de los empleados 
    public function masinformacionempleadosjson($id_empleado_masinformacion)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            $sql = "SELECT * FROM empleados where ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_empleado_masinformacion]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    public function obtenerempleado_unicojson($id_empleado_json)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            $sql = "SELECT * FROM empleados WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_empleado_json]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($empleado) {
                return $empleado;
            } else {
                return ['error' => 'Empleado no encontrado.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

// este es para que me devuelva todos los datos de una tabla
    public function agregar_empleados_json($nombre_empleado_json, $correo_empleado_json, $cede_empleado_json, $Fecha_ingreso_empleado_json, $cargo_empleado_json, $area_empleado_json)
    {
        $conn = $this->dbConnect();

        if ($conn) {
            // Obtener la fecha y hora actual
            // $fecha_creacion_json = date("Y-m-d H:i:s");
            $fecha_creacion_json = date("Y-m-d h:i:s A");

            // Consulta para insertar un nuevo empleado
            $sql = "INSERT INTO empleados (nombres, correo, cede, fecha_creacion,Fecha_ingreso,cargo,area, estado) VALUES (?, ?, ?, ?,?,?,?, 1)";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los valores proporcionados
            $stmt->execute([$nombre_empleado_json, $correo_empleado_json, $cede_empleado_json, $fecha_creacion_json, $Fecha_ingreso_empleado_json, $cargo_empleado_json, $area_empleado_json]);

            // Si la inserción fue exitosa, devolver true o algún mensaje
            if ($stmt->rowCount() > 0) {
                return ['success' => 'Empleado agregado exitosamente.'];
            } else {
                return ['error' => 'Error al insertar el empleado.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

// este es para que me devuelva todos los datos de una tabla
    public function actualizar_empleados_json($id_empleado_actualizar_json, $nombre_empleado_actualizar_json, $correo_empleado_actualizar_json, $cede_empleado_actualizar_json, $Fecha_ingreso_empleado_actualizar_json, $cargo_empleado_actualizar_json, $area_empleado_actualizar_json, $estado_empleado_actualizar_json)
    {
        $conn = $this->dbConnect();

        if ($conn) {
            // Primero, obtenemos el estado actual del empleado en la base de datos
            $sql_verificar = "SELECT estado FROM empleados WHERE ID = ?";
            $stmt_verificar = $conn->prepare($sql_verificar);
            $stmt_verificar->execute([$id_empleado_actualizar_json]);
            $empleado = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

            // Verificar si el empleado fue encontrado
            if ($empleado) {
                $estado_actual = $empleado['estado']; // Estado actual del empleado (activo/inactivo)

                // Si el empleado está inactivo y no se intenta activarlo, no permitir la actualización
                if ($estado_actual == "0" && $estado_empleado_actualizar_json == "0") {
                    return ['error' => 'El empleado está inactivo. No se pueden modificar otros campos mientras esté inactivo.'];
                }

                // Si se llega aquí, significa que:
                // - El empleado está activo, o
                // - Se está intentando cambiar su estado (de inactivo a activo o viceversa)

                // Consulta para actualizar el empleado
                $sql = "UPDATE empleados SET nombres = ?, correo = ?, cede = ?, Fecha_ingreso = ?, cargo = ?, area = ?, estado = ? WHERE ID = ?";
                $stmt = $conn->prepare($sql);

                // Ejecutar la consulta con los valores proporcionados
                $stmt->execute([
                    $nombre_empleado_actualizar_json,
                    $correo_empleado_actualizar_json,
                    $cede_empleado_actualizar_json,
                    $Fecha_ingreso_empleado_actualizar_json,
                    $cargo_empleado_actualizar_json,
                    $area_empleado_actualizar_json,
                    $estado_empleado_actualizar_json,
                    $id_empleado_actualizar_json,
                ]);

                // Verificar si la actualización fue exitosa
                if ($stmt->rowCount() > 0) {
                    return ['success' => 'Empleado actualizado exitosamente.'];
                } else {
                    return ['error' => 'Error al actualizar el empleado.'];
                }
            } else {
                return ['error' => 'Empleado no encontrado.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es para listar los empleados y se guarde la asinacion
    public function empleados_listar_combo()
    {
        $conn = $this->dbConnect(); // Asegúrate de que dbConnect devuelve la conexión
        if ($conn) {
            $sql = "SELECT distinct ID,nombres,cargo from empleados where  estado = 1;";
            // select distinct ID,marca,serial from equipos where  tipo not in ('');
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

    public function obtenerempleado_correojson($ids)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            $sql = "SELECT nombres,correo FROM empleados WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ids]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($empleado) {
                return $empleado;
            } else {
                return ['error' => 'Empleado no encontrado.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }

    // este es obtener los datos por medio de un parametro, en este casi el Id
    // public function obtenerempleado_correojson($ids)
    // {
    //     $conn = $this->dbConnect();
    //     if ($conn) {
    //         // Si $ids es un array, convierte cada ID en un entero
    //         $ids = array_map('intval', $ids);

    //         // Crea un marcador de posición para cada ID
    //         $placeholders = implode(',', array_fill(0, count($ids), '?'));

    //         // Preparar la consulta SQL para obtener varios correos con IN
    //         $sql = "SELECT correo FROM empleados WHERE ID IN ($placeholders)";
    //         $stmt = $conn->prepare($sql);

    //         // Ejecutar la consulta con los IDs
    //         $stmt->execute($ids);

    //         // Obtener todos los registros con fetchAll
    //         $correos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //         // Verificar si se encontraron empleados
    //         if ($correos) {
    //             return $correos;
    //         } else {
    //             return ['error' => 'Correos no encontrados.'];
    //         }
    //     } else {
    //         return ['error' => 'Error al conectar con la base de datos.'];
    //     }
    // }
   
   


    // este es para que actualize varios empleados en los estados 
    public function actualizar_varios_estados_empleadosjson($ids_estados, $estado_actualizar_empleados)
    {
        $conn = $this->dbConnect();
        if ($conn) {
            // Si $ids_estados es un array, convierte cada ID en un entero
            $ids_estados = array_map('intval', $ids_estados);
    
            // Crea un marcador de posición para cada ID
            $placeholders = implode(',', array_fill(0, count($ids_estados), '?'));
    
            // Preparar la consulta SQL para actualizar el estado de varios empleados
            $sql = "UPDATE empleados SET estado = ? WHERE ID IN ($placeholders)";
            
            // Preparar la declaración SQL
            $stmt = $conn->prepare($sql);
    
            // Crear un array para bindParam: primero el estado, seguido de los IDs
            $params = array_merge([$estado_actualizar_empleados], $ids_estados);
    
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
    

    //  fin empleados
}
