<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

class ActualizarDatos {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function ActualizarDatos($user_id) {
        
        $sql = "CALL ActualizarDatosUsuario('$user_id');";
        $stmt = $this->conexion->prepare($sql);
        
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                $_SESSION['usuario_id'] = $row['usuario_id'];
                $_SESSION['usuario_email'] = $row['usuario_email'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['usuario_password'] = $row['usuario_password'];
                $_SESSION['usuario_name'] = $row['usuario_name'];
                $_SESSION['usuario_type'] = $row['usuario_type'];
                $_SESSION['usuario_birth'] = $row['usuario_birth'];
                $_SESSION['usuario_gen'] = $row['usuario_gen'];
                $_SESSION['usuario_priv'] = $row['usuario_priv'];
                $_SESSION['usuario_create'] = $row['usuario_create'];
                $_SESSION['usuario_imagen'] = $row['usuario_imagen'];

                header("Location: UserProfile.php");
                exit();
                
            } else {
                echo "Error al mostrar los datos: " . $this->conexion->conexion->error;
            }

            $stmt->close();
        } else {
            echo "Error en la preparación de la sentencia: " . $this->conexion->error;
        }
    }
}


$userupdate_id=$_SESSION['usuario_id'];
$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$actualizardatos = new ActualizarDatos($conexion);

$actualizardatos->ActualizarDatos($userupdate_id);
$conexionDB->cerrarConexion();

?>