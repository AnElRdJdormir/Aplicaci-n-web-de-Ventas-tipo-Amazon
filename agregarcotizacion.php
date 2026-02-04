<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

class AgregarCotizacion{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function AgregarCotizacion($precio, $producto_id, $cotizacion_id) {
        $consulta = "CALL CrearCotizacion(
            $precio, 
            $producto_id, 
            $cotizacion_id,
            'Creada');";
    
        if ($this->conexion->query($consulta)) {
          
            header("Location: ChatCotizador.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->error;
        }
    }
    
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$AgregarCotizacion = new AgregarCotizacion($conexion);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $precio = $_POST["precio"];
    $product_id = $_POST["product_id"];
    $contacto_id = $_POST["contacto_id"];

    
    $AgregarCotizacion -> AgregarCotizacion($precio, $product_id, $contacto_id);
}


$conexion->cerrarConexion();

?>