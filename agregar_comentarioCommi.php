<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

$mensaje = $_POST['mensaje'];
$product_id = $_POST['pd_id'];
$usuario_id = $_SESSION['usuario_id'];

class AgregarComentario{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function AgregarComentario($comentario, $usuario_id, $product_id) {
        $consulta = "CALL PublicarComentario(
            '$comentario', 
            $usuario_id, 
            $product_id);";
    
        if ($this->conexion->query($consulta)) {
            $_SESSION['success_message'] = "El comentario se creo correctamente.";
            header("Location: commission.php?product_id=" .$product_id);
        } else {
            echo "Error al registrar los datos: " . $this->conexion->error;
        }
    }
    
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$AgregarComent = new AgregarComentario($conexion);

$AgregarComent->AgregarComentario($mensaje, $usuario_id, $product_id);


$conexion->cerrarConexion();

?>