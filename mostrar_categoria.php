<?php 

include('conexion.php');

class MostrarCategorias{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarCategorias() {
        $sql = "CALL MostrarCategorias();";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowCategory = new MostrarCategorias($conexion);

$Categorias = $ShowCategory->MostrarCategorias();


?>