<?php
include('conexion.php');

class VerificacionLogin{
    private $conexion;

    public function __construct($conexion){
        $this->conexion = $conexion;
    }

    public function verificarCredenciales($NombreUsuario,$Contraseña){

        $sql = "CALL IniciarSesion(?, ?);";
        $stmt = $this->conexion->prepare($sql);

        if($stmt){
            $stmt->bind_param("ss",$NombreUsuario,$Contraseña); 
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows == 1)
            {
                session_start();
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

                $response = array('status' => 'success', 'message' => 'Inicio de sesión exitoso');

                if($_SESSION['usuario_type'] == '1'){
                    header("Location: Dashboard2.php");
                }else  if($_SESSION['usuario_type'] == '2'){
                    header("Location: UserProfile.php");
                }    else if ($_SESSION['usuario_type'] == '3') {
                    header("Location: UserProfile.php");
                }

                echo json_encode($response);
                exit();
            } else{
                $response = array('status' => 'error', 'message' => 'Credenciales incorrectas. Por favor, intentalo de nuevo.');
                echo json_encode($response);
            }

            $stmt->close();
        } else {
            echo "Error en la preparación de la sentencia: " . $this->conexion->error;
        }
    }
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();
$verificacionLogin = new VerificacionLogin($conexion);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $VerificarCorreo = $_POST["txtLUserEmail"];
    $VerificarContra = $_POST["txtLPassword"];


    $verificacionLogin->verificarCredenciales($VerificarCorreo, $VerificarContra);
}


$conexionDB->cerrarConexion();

?>
