<?php 

include('conexion.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$usuario_id = $_SESSION['usuario_id'];

class MostrarProductos{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function MostrarProductosEnEspera() {
        $sql = "CALL MostrarProductosEnEspera();";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function MostrarProductosAutorizados() {
        $sql = "CALL MostrarProductosAutorizados();";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function MostrarProductoPopular() {
        $sql = "CALL MostrarProductoPopular();";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
    public function MostrarProductoSeleccionado($productid){
        $sql = "CALL MostrarProductoPorID('$productid')";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function MostrarProductoCategorias($categoria_id){
        $sql = "CALL MostrarProductosCategoria('$categoria_id');";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function MostrarListasCreadasenProductos($usuario_id) {
        $sql = "CALL MostrarListas($usuario_id);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function BuscarProductos($producto_nombre) {
        $sql = "CALL BuscarProductos('$producto_nombre');";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function MostrarPorcentajeMeGusta($productoid) {
        $sql = "CALL PorcentajePuntuacion(?);";
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $productoid); 
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
    
        $stmt->close();
    
        return $row;
    }

    public function MostrarComentarios($productoid) {
        $sql = "CALL Comentarios($productoid);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function MostrarProductosCreados($user_id) {
        $sql = "CALL ProductosCreados($user_id);";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }


}

$conexionDB = new ConexionDB();
$conexion = $conexionDB->getConexion();

$ShowProduct = new MostrarProductos($conexion);

$Productos = $ShowProduct->MostrarProductosEnEspera();

$ProductosCreados = $ShowProduct->MostrarProductosCreados($usuario_id);

$ProductosAutorizados = $ShowProduct->MostrarProductosAutorizados();

$ProductosPopulares = $ShowProduct->MostrarProductoPopular();

$ListasProductos = $ShowProduct->MostrarListasCreadasenProductos($usuario_id);

?>