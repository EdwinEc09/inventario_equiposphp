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
        // Establecer la zona horaria desde la conexion a la db para que llegue a todas las funciones
        date_default_timezone_set('America/Bogota');
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

}
