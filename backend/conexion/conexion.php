<?php
class OutSourcing
{
    // Datos de la conexión
    private $database = 'Inventario_equipos';
    private $host = 'TI-EDWIN\SQLEXPRESS';
    private $user = 'sa';
    private $pass = '32215';
    private $conexion;

    // Conectar a la base de datos
    public function dbConnect()
    {
        try {
            if (!isset($this->conexion)) {
                $this->conexion = new PDO("sqlsrv:server=$this->host;database=$this->database", $this->user, $this->pass);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $this->conexion;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            return null;
        }
    }

// este es obtener los datos por medio de un parametro, en este casi el Id
    public function obtenerempleadosjson()
    {
        $conn = $this->dbConnect();
        // $id_prueba = 1;
        if ($conn) {
            // $sql = "SELECT * FROM empleados WHERE ID = ? ";
            $sql = "SELECT * FROM empleados  ";
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

    // OBTENER EQUIPOS
    public function obtenerequiposjson()
    {
        $conn = $this->dbConnect();
        // $id_prueba = 1;
        if ($conn) {
            // $sql = "SELECT * FROM empleados WHERE ID = ? ";
            $sql = "SELECT * FROM equipos ";
            $stmt = $conn->prepare($sql);
            // $stmt->execute([$id_prueba]);
            $stmt->execute(); // Sin parámetros porque queremos obtener todos los registros

            // Devolver los resultados en un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    // este es estado de equipos listar combo
    function estados_equipos_listar_combo() {
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
    function tipos_equipos_listar_combo() {
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
    function equipos_listar_combo() {
        $conn = $this->dbConnect(); // Asegúrate de que dbConnect devuelve la conexión
        if ($conn) {
            $sql = "SELECT ID,marca,serial,tipo FROM equipos where  estado = 'Disponible'";
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
     // este es para listar los empleados y se guarde la asinacion
    function empleados_listar_combo() {
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


    // asignaciones------------
       // OBTENER EQUIPOS
       public function obtenerasignacionesjson()
       {
           $conn = $this->dbConnect();
           // $id_prueba = 1;
           if ($conn) {
               // $sql = "SELECT * FROM empleados WHERE ID = ? ";
               $sql = "SELECT e.ID,  ee.nombres,te.tipo,te.marca,e.fecha_asignacion, e.fecha_registro, e.estado_asignacion  FROM asignaciones e JOIN empleados ee ON e.id_empleado = ee.ID JOIN equipos te ON e.id_equipos = te.ID;";
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
            // $fecha_creacion_json = date("Y-m-d H:i:s");
            $fecha_creacion_json = date("Y-m-d h:i:s A");
            // esta es para marcar y enviar activo el insert 
            $estado_asignacion_json = 1;

            // Consulta para insertar un nuevo empleado
            $sql = "INSERT into asignaciones (id_empleado,id_equipos,fecha_asignacion,fecha_registro,estado_asignacion,acta_firmada) values (?,?,?,?,?,?);";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los valores proporcionados
            $stmt->execute([$empleado_asignacion_json,$equipo_asignacion_json,$fecha_asignacion_asignaciones_json,$fecha_creacion_json,$estado_asignacion_json,$acta_firmada_asignacion_json]);
            // Si la inserción fue exitosa, devolver true o algún mensaje
            if ($stmt->rowCount() > 0) {
                return ['success' => 'equipo agregado exitosamente.'];
            } else {
                return ['error' => 'Error al insertar el asignacion.'];
            }
        } else {
            return ['error' => 'Error al conectar con la base de datos.'];
        }
    }
    
}
?>