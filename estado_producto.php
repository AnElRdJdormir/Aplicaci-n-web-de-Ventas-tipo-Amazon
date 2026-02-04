<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conexion.php';

$producto_id = $_POST['producto_id'];
$usuario_id = $_SESSION['usuario_id'];

class EstadoProducto {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function AutorizarProducto($producto_id,$usuario_id) {
        $consulta = "CALL ProductoAutorizado($producto_id, $usuario_id);";

        if ($this->conexion->ejecutarConsulta($consulta)) {   
            $_SESSION['success_message'] = "El producto ha sido Autorizado";
            header("Location: AutoProductos.php");
        } else {
            echo "Error al autorizar el producto: " . $this->conexion->conexion->error;
        }
    }

    public function DenegarProducto($producto_id,$usuario_id) {
        $consulta = "CALL ProductoDenegado($producto_id, $usuario_id);";

        if ($this->conexion->ejecutarConsulta($consulta)) {   
            $_SESSION['danger_message'] = "El producto ha sido Denegado";
            header("Location: AutoProductos.php");
        } else {
            echo "Error al autorizar el producto: " . $this->conexion->conexion->error;
        }
    }

}

$conexion = new ConexionDB();
$estadoprod = new EstadoProducto($conexion);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id'];
    $usuario_id = $_SESSION['usuario_id'];

    if (isset($_POST["autorizar"])) {
        $estadoprod->autorizarProducto($producto_id, $usuario_id);
    } elseif (isset($_POST["denegar"])) {
        $estadoprod->denegarProducto($producto_id, $usuario_id);
    }
}

$conexion->cerrarConexion();
?>
