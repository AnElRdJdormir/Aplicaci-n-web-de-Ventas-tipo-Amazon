<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');


$producto_autorid = $_GET['producto_autorid'];
$product_id = $_GET['producto_id'];

class AgregarCalificacion{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function AgregarCalificacion($producto_id, $usuario_id, $estado) {
        $consulta = "CALL Calificar(
            $producto_id, 
            $usuario_id, 
            '$estado');";
    
        if ($this->conexion->query($consulta)) {
            header("Location: product.php?product_id=" . $producto_id);
        } else {
            echo "Error al registrar los datos: " . $this->conexion->error;
        }
    }
    
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$AgregarPuntuaje = new AgregarCalificacion($conexion);

if (isset($_GET['tipo']) && isset($_GET['producto_id'])) {
    $tipo = $_GET['tipo'];
    $producto_id = $_GET['producto_id'];
    $usuario_id = $_SESSION['usuario_id'];
    $AgregarPuntuaje->AgregarCalificacion($producto_id, $usuario_id, ($tipo == 'like') ? 'Me gusta' : 'No me gusta');
}


$conexion->cerrarConexion();

?>s