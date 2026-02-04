<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

$usuario_id = $_SESSION['usuario_id'];
$IDProducto = $_GET['product_id'];

class EliminarProducto{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function EliminarProducto($IDProducto) {
        $consulta = "CALL EliminarProducto($IDProducto);";

        if ($this->conexion->query($consulta)) {   
            $_SESSION['danger_message'] = "El producto ha sido Eliminado";
            header("Location: VendedorProfileV.php");
        } else {
            echo "Error al autorizar el producto: " . $this->conexion->conexion->error;
        }
    }
    
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$EliminarProducto = new EliminarProducto($conexion);
$EliminarProducto -> EliminarProducto($IDProducto);

$conexion->cerrarConexion();

?>