<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conexion.php';

$category_name = $_POST['nombre'];
$category_desc = $_POST['descripcion'];

//Variables de Sesion 
$usuario_id = $_SESSION['usuario_id'];
$usuario_name = $_SESSION['usuario_name'];

class CrearCategoria {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearcategoria($category_name, $category_desc, $usuario_id, $usuario_name) {


      
        $consulta = "CALL InsertarCategoria('$category_name', '$category_desc', $usuario_id, '$usuario_name');";

        if ($this->conexion->ejecutarConsulta($consulta)) {   
            $_SESSION['success_message'] = "La categoría se creó exitosamente.";
            header("Location: UserProfile.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->conexion->error;
        }
    }

}

$conexion = new ConexionDB();
$crearcat = new CrearCategoria($conexion);

$crearcat->crearcategoria($category_name, $category_desc, $usuario_id, $usuario_name);

$conexion->cerrarConexion();
?>
