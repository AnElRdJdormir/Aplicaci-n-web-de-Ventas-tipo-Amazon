<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];


class Compra {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerConexion() {
        return $this->conexion->getConexion(); 
    }
    
    public function Compra($usuario_id) 
    {  
        $consulta = "CALL Comprar($usuario_id);";

        if ($this->conexion->ejecutarConsulta($consulta)) {   
            $_SESSION['success_message'] = "La compra ha sido realizada";
            header("Location: shopcar.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->conexion->error;
        }
    }

}

$conexion = new ConexionDB();
$comprarprod = new Compra($conexion);

$comprarprod->Compra($usuario_id);

$conexion->cerrarConexion();
?>
