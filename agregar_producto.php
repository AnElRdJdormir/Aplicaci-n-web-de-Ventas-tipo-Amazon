<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conexion.php';

$product_name = $_POST['nombre'];
$product_desc = $_POST['descripcion'];
$product_precio = $_POST['precio'];
$product_category = $_POST['categoria'];
$product_tipo = $_POST['selltype'];
$product_cantidad = $_POST['cantidad'];

//Imagenes y Video

//Imagen #1
$product_image_temporal = $_FILES['imagen']['tmp_name'];

//Imagen #2
$product_image2_temporal = $_FILES['imagen2']['tmp_name'];

//Imagen 3
$product_image3_temporal = $_FILES['imagen3']['tmp_name'];

//Video
$product_video_temporal = $_FILES['video']['tmp_name'];

//Variables de Sesion 
$usuario_id = $_SESSION['usuario_id'];
$usuario_name = $_SESSION['usuario_name'];

class AgregarProducto {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerConexion() {
        return $this->conexion->getConexion(); // Utiliza el método getConexion
    }
    
    public function AregarProducto($product_name, $product_desc, $product_image_temporal, 
    $product_image2_temporal, $product_image3_temporal, 
    $product_video_temporal, $product_category, 
    $product_tipo,$product_precio,$product_cantidad,$usuario_id) 
    {  
        $product_name = mysqli_real_escape_string($this->obtenerConexion(), $_POST['nombre']);
        $product_desc = mysqli_real_escape_string($this->obtenerConexion(), $_POST['descripcion']);

        if (is_uploaded_file($product_image_temporal)) {
            $imagen_datos = file_get_contents($product_image_temporal);
            $imagen_codificada = base64_encode($imagen_datos);
        } 
        
        
        if (is_uploaded_file($product_image2_temporal)) {
            $imagen_datos2 = file_get_contents($product_image2_temporal);
            $imagen_codificada2 = base64_encode($imagen_datos2);
        } 
        
        
        if (is_uploaded_file($product_image3_temporal)) {
            $imagen_datos3 = file_get_contents($product_image3_temporal);
            $imagen_codificada3 = base64_encode($imagen_datos3);
        } 
        
        if (is_uploaded_file($product_video_temporal)) {
            $video_datos = file_get_contents($product_video_temporal);
            $video_codificado = base64_encode($video_datos);
        } 

        $consulta = "CALL InsertarProducto(
            '$product_name',
            '$product_desc',
            '$imagen_codificada',
            '$imagen_codificada2',
            '$imagen_codificada3',
            '$video_codificado',
            $product_category,
            '$product_tipo',
            $product_precio,
            $product_cantidad,
            $usuario_id
            );";

        if ($this->conexion->ejecutarConsulta($consulta)) {   
            //$_SESSION['success_message'] = "La categoría se creó exitosamente.";
            header("Location: VendedorProfileV.php");
        } else {
            echo "Error al registrar los datos: " . $this->conexion->conexion->error;
        }
    }

}

$conexion = new ConexionDB();
$crearproducto = new AgregarProducto($conexion);

$crearproducto->AregarProducto($product_name, $product_desc, $product_image_temporal, 
$product_image2_temporal, $product_image3_temporal, 
$product_video_temporal, $product_category, 
$product_tipo,$product_precio,$product_cantidad,$usuario_id);

$conexion->cerrarConexion();
?>
