<?php 


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$usuario_id = $_SESSION['usuario_id'];

class MostrarVentas{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarVentas($usuario_id) {
        $sql = "CALL VentasTotales($usuario_id);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

  
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowVentas = new MostrarVentas($conexion);

$Ventas = $ShowVentas -> MostrarVentas($usuario_id);

?>