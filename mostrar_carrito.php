<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

class MostrarCarrito{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarCarrito($user_id) {
        $sql = "CALL MostrarCarritoCompra($user_id);";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    

  
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowCarrito = new MostrarCarrito($conexion);


?>