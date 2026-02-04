<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

$usuario_id = $_SESSION['usuario_id'];
$producto_autorid = $_GET['producto_autorid'];
$product_id = $_GET['producto_id'];

class AgregarContacto{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function InsertarContacto($contacto_usuario1, $contacto_usuario2, $contacto_producto) {
        $consulta = "CALL InsertarContacto(
            $contacto_usuario1, 
            $contacto_usuario2,
            $contacto_producto);";
    
        if ($this->conexion->query($consulta)) {
            header("Location: ChatUsuario.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->error;
        }
    }
    
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$AgregarContacto = new AgregarContacto($conexion);
$AgregarContacto -> InsertarContacto($producto_autorid,$usuario_id,$product_id);

$conexion->cerrarConexion();

?>