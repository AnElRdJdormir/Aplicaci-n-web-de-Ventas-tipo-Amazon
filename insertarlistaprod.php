<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conexion.php';

$lista_id = $_POST['listid'];
$lista_prod_cantidad = $_POST['numero2'];
$lista_productid = $_POST['product_id'];


//Variables de Sesion 
$usuario_id = $_SESSION['usuario_id'];


class AgregarListaProducto {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerConexion() {
        return $this->conexion->getConexion(); 
    }
    
    public function AgregarListaProducto($usuario_id,$lista_productid,$lista_id,$lista_prod_cantidad) 
    {  
 
        $consulta = "CALL CrearListaProducto(
            '$usuario_id',
            '$lista_productid', 
            '$lista_id', 
            '$lista_prod_cantidad');";

        if ($this->conexion->ejecutarConsulta($consulta)) {   
            $_SESSION['success_message'] = "El Producto se agrego exitosamente.";
            header("Location: UserProfile.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->conexion->error;
        }
    }

}

$conexion = new ConexionDB();
$crearlista = new AgregarListaProducto($conexion);

$crearlista->AgregarListaProducto($usuario_id,$lista_productid,$lista_id,$lista_prod_cantidad);

$conexion->cerrarConexion();
?>
