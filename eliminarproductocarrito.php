<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

$usuario_id = $_SESSION['usuario_id'];
$carproducto_id = $_GET['carritoproduct_id'];

class EliminarProductoCarrito{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function EliminarProductoCarrito($carproducto_id) {
        $consulta = "CALL EliminarDelCarrito(
            $carproducto_id);";
    
        if ($this->conexion->query($consulta)) {
            header("Location: ShoppingCart.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->error;
        }
    }
    
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$EliminarProductoCar = new EliminarProductoCarrito($conexion);
$EliminarProductoCar -> EliminarProductoCarrito($carproducto_id);

$conexion->cerrarConexion();

?>