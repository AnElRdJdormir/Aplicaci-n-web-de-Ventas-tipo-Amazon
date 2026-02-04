<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

class AgregarMensaje{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function InsertarMensaje($mensaje, $usuario_id, $contacto_id,$cotizador_id,$product_id) {
        $consulta = "CALL InsertarMensaje(
            '$mensaje', 
            $usuario_id, 
            $contacto_id);";
    
        if ($this->conexion->query($consulta)) {
            $redirectURL = 'ChatComp.php?producto_autorid=' . $cotizador_id . '&producto_id=' . $product_id . '&contacto_id='.$contacto_id;
            header("Location: $redirectURL");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->error;
        }
    }
    
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$AgregarMensaje = new AgregarMensaje($conexion);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $mensaje = $_POST["mensaje"];
    $cotizador_id = $_POST["producto_autorid"];
    $product_id = $_POST["product_categoryid"];
    $contacto_id = $_POST["contacto_id"];
    
    $AgregarMensaje -> InsertarMensaje($mensaje, $usuario_id, $contacto_id,$cotizador_id,$product_id);
}


$conexion->cerrarConexion();

?>