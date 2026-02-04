<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

$usuario_id = $_SESSION['usuario_id'];

class AgregarListaCarrito
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function AgregarListaCarrito($producto_id, $user_id, $precio, $cantidad)
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

$CrearListaCarrito = new AgregarListaCarrito($conexion);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['listaprod_id'])) {

    $listaprod_ids = $_POST['listaprod_id'];
    $listaprod_productoids = $_POST['listaprod_productoid'];
    $listaprod_precios = $_POST['listaprod_prodprice'];
    $listaprod_cantidades = $_POST['listaprod_cantidad'];

    for ($i = 0; $i < count($listaprod_ids); $i++) {
        $producto_id = $listaprod_productoids[$i];
        $precio = $listaprod_precios[$i];
        $cantidad = $listaprod_cantidades[$i];

        $CrearListaCarrito->AgregarListaCarrito($producto_id, $usuario_id, $precio, $cantidad);
    }


    header("Location: UserProfile.php"); 
    exit();
} else {

    echo "Error: No se recibieron datos del formulario.";
}
?>
