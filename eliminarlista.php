<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

$usuario_id = $_SESSION['usuario_id'];
$lista_id = $_GET['lista_id'];

class EliminarLista{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function EliminarLista($lista_id) {
        $consulta = "CALL EliminarLista($lista_id);";
    
        if ($this->conexion->query($consulta)) {
            $_SESSION['danger_message'] = "La lista ha sido eliminada";
            header("Location: UserProfile.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->error;
        }
    }
    
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$EliminarList = new EliminarLista($conexion);
$EliminarList -> EliminarLista($lista_id);

$conexion->cerrarConexion();

?>