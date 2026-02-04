<?php

include 'conexion.php';

$Correo = $_POST['txtEmail'];
$NombreUsuario = $_POST['txtUsername'];
$Contraseña = $_POST['txtPassword'];
$NombreCompleto = $_POST['txtFullname'];
$RolUsuario = $_POST['idRegisterRol'];
$CuentaPriv = $_POST['idRegisterChB'];
$FechaNaci = $_POST['ffechanacimiento'];
$Sexo = $_POST['inlineRadioOptions'];
$imagen_temporal = $_FILES['idRegisterAvatarBtn']['tmp_name'];
$nombre_imagen =  $_FILES['idRegisterAvatarBtn']['name'];

class RegistrarUsuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($imagen_temporal, $nombre_imagen, 
    $Correo, $NombreUsuario, $Contraseña, $NombreCompleto, 
    $RolUsuario, $CuentaPriv,$FechaNaci, $Sexo) 
    {
        // Procesar la imagen
        if (is_uploaded_file($imagen_temporal)) {
            $imagen_datos = file_get_contents($imagen_temporal);
            $imagen_codificada = base64_encode($imagen_datos);
        } else {
            echo "Error al cargar la imagen.";
            exit;
        }
        

        $consulta = "CALL RegistrarUsuario('$Correo', '$NombreUsuario', 
        '$Contraseña', '$NombreCompleto', '$RolUsuario',
        '$FechaNaci', '$Sexo', '$CuentaPriv', '$imagen_codificada');";

        if ($this->conexion->ejecutarConsulta($consulta)) {
            header("Location: Login.html");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->conexion->error;
        }
    }
}

$conexion = new ConexionDB();
$registrarUsuario = new RegistrarUsuario($conexion);

$registrarUsuario->registrarUsuario($imagen_temporal,$nombre_imagen, 
$Correo, $NombreUsuario, $Contraseña, 
$NombreCompleto, $RolUsuario, $CuentaPriv,
$FechaNaci, $Sexo);

$conexion->cerrarConexion();
?>
