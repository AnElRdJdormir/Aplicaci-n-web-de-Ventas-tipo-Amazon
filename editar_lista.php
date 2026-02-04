<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conexion.php';

$lista_name = $_POST['nombre'];
$lista_desc = $_POST['descripcion'];
$lista_privacidad = $_POST['PrivList'];

$lista_image_temporal = $_FILES['imagen']['tmp_name'];
$lista_id = $_POST['lista_id'];

//Variables de Sesion 
$usuario_id = $_SESSION['usuario_id'];


class ActualizarLista {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerConexion() {
        return $this->conexion->getConexion(); 
    }
    
    public function ActualizarLista($lista_id,$lista_desc,$lista_image_temporal,$lista_name,$lista_privacidad,$usuario_id) 
    {  
        $lista_name = mysqli_real_escape_string($this->obtenerConexion(), $_POST['nombre']);

        if (is_uploaded_file($lista_image_temporal)) {
            $imagen_datos = file_get_contents($lista_image_temporal);
            $imagen_codificada = base64_encode($imagen_datos);
        } 
        
        $consulta = "CALL ActualizarLista(
            '$lista_id',
            '$lista_desc', 
            '$imagen_codificada', 
            '$lista_privacidad', 
            '$lista_name',
            $usuario_id);";

        if ($this->conexion->ejecutarConsulta($consulta)) {   
            $_SESSION['success_message'] = "La Lista se actualizo.";
            header("Location: UserProfile.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->conexion->error;
        }
    }

}

$conexion = new ConexionDB();
$actualizar = new ActualizarLista($conexion);

$actualizar->ActualizarLista($lista_id,$lista_desc,$lista_image_temporal,$lista_name,$lista_privacidad,$usuario_id);

$conexion->cerrarConexion();
?>
