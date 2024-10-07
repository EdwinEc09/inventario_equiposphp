<?php
// include 'backend/conexion/conexion.php'; // Mantén la conexión a la base de datos

class Empleados {
    private $conn;

    public function __construct() {
        $this->conn = new Conexion(); // Usa la clase de conexión que ya tienes
    }

    public function obtenerempleadosjson() {
        // Lógica para obtener empleados desde la base de datos
        $sql = "SELECT * FROM empleados";
        $result = $this->conn->query($sql);
        $empleados = [];

        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }

        return $empleados;
    }
  
}
