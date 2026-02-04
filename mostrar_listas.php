<?php 

include('conexion.php');

class MostrarListas{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarListasCreadas($usuario_id) {
        $sql = "CALL MostrarListas($usuario_id);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function MostrarOtrasListas() {
        $sql = "CALL MostrarOtrasListas();";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowListas = new MostrarListas($conexion);

$ListasOtras = $ShowListas->MostrarOtrasListas();

?>