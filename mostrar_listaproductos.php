<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

class MostrarListaProductos{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarListaProductos($lista_id,$user_id) {
        $sql = "CALL MostrarProductosenLista($lista_id,$user_id);";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    

  
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowListaProductos = new MostrarListaProductos($conexion);


?>