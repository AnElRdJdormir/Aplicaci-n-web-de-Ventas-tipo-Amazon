<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

$usuario_id = $_SESSION['usuario_id'];

class AgregarProductoCarrito
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function AgregarProductoCarrito($producto_id, $user_id, $precio, $cantidad)
    {
        $sql = "CALL AgregarProductoCarrito($producto_id, $user_id, $precio, $cantidad, 'En Espera');";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$CrearProductoCarrito = new AgregarProductoCarrito($conexion);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $producto_id = $_POST['product_id_1'];
    $cantidad = $_POST['numero'];
    $precio = $_POST['precio'];
    
    $CrearProductoCarrito->AgregarProductoCarrito($producto_id, $usuario_id, $precio, $cantidad);


    header("Location: ShoppingCart.php"); 
    exit();
} else {

    echo "Error: No se recibieron datos del formulario.";
}
?>
