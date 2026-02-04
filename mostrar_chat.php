<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');

class MostrarChat{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarUsuario($cotizador_id) {
        $sql = "CALL MostrarUsuario(?);";
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $cotizador_id); 
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
    
        $stmt->close();
    
        return $row;
    }

    public function MostrarProductoComision($productid){
        $sql = "CALL MostrarProductoPorID(?);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $productid); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        $row = $result->fetch_assoc();
    
        $stmt->close();

        return $row;
    }

    public function VerContactosCotizador($user_id) {
        $sql = "CALL VerContactosCotizador($user_id);";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
    public function VerContactosCliente($user_id) {
        $sql = "CALL VerContactosCliente($user_id);";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    

    public function VerMensajes($user_id) {
        $sql = "  CALL VerMensajes($user_id);";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function CotizacionesCreadas($cotizacion) {
        $sql = "  CALL CotizacionesCreadas($cotizacion);";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
  
    public function CotizacionesCreadas2($cotizacion){
        $sql = "CALL CotizacionesCreadas(?);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $cotizacion); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        $row = $result->fetch_assoc();
    
        $stmt->close();

        return $row;
    }
   
}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowChat = new MostrarChat($conexion);


?>