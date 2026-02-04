<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

class MostrarListaProductosOtros
{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarListaProductosOtros() 
    {
        $sql = 'SELECT * FROM mostrarlistasyproductos';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    

  
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowListaProductos = new MostrarListaProductosOtros($conexion);


?>