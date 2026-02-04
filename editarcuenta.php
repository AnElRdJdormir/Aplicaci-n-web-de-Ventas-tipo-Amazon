<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conexion.php';

$edit_mail = $_POST['edit_mail'];
$edit_username = $_POST['edit_user'];
$edit_password = $_POST['edit_password'];
$edit_name = $_POST['edit_name'];
$edit_ustype = $_POST['edit_ustype'];
$edit_birth = $_POST['edit_birth'];
$edit_Priv = $_POST['edit_Priv'];
$edit_temporal = $_FILES['edit_imagen']['tmp_name'];
$edit_imagen = $_FILES['edit_imagen']['name'];

class EditarUsuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function editarUsuario($edit_temporal, $edit_imagen, $edit_mail, $edit_username, $edit_password, $edit_name, $edit_ustype, $edit_birth, $edit_Priv) {
        // Procesar la imagen
        if (is_uploaded_file($edit_temporal)) {
            $imagen_datos = file_get_contents($edit_temporal);
            $imagen_codificada = base64_encode($imagen_datos);
        } else {
            echo "Error al cargar la imagen.";
            exit;
        }

        $usuario_id = $_SESSION['usuario_id'];
        $consulta = "CALL EditarUsuario('$usuario_id', '$edit_mail', '$edit_username', '$edit_password', '$edit_name', '$edit_ustype', '$edit_birth','$edit_Priv' ,'$imagen_codificada');";

        if ($this->conexion->ejecutarConsulta($consulta)) {   

            header("Location: actualizardatos.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->conexion->error;
        }
    }

}

$conexion = new ConexionDB();
$editarUsuario = new EditarUsuario($conexion);

$editarUsuario->editarUsuario($edit_temporal, $edit_imagen, $edit_mail, $edit_username, $edit_password, $edit_name, $edit_ustype, $edit_birth, $edit_Priv);

$conexion->cerrarConexion();
?>
