<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$usuario_id = $_SESSION['usuario_id'];

class MostrarHistorial{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarHistorial($usuario_id) {
        $sql = "CALL Historial($usuario_id);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

  
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowHistorial = new MostrarHistorial($conexion);

$Historial = $ShowHistorial -> MostrarHistorial($usuario_id);

?>