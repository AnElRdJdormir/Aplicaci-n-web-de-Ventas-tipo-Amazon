<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_productos.php');
$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $productDetails = $ShowProduct->MostrarProductoSeleccionado($product_id);
    $calificacion = $ShowProduct->MostrarPorcentajeMeGusta($product_id);
    $comentarios = $ShowProduct->MostrarComentarios($product_id);
} else {
    echo "Error: No se proporcionó el ID del producto.";
}

while ($row = $productDetails->fetch_assoc()) {
    $producto_img = $row['producto_img'];
    $producto_img2 = $row['producto_img2'];
    $producto_img3 = $row['producto_img3'];

    $product_id = $row['producto_id'];

    $product_name = $row['producto_name'];
    $product_price = $row['producto_price'];
    $product_desc = $row ['producto_desc'];
    $product_category = $row ['category'];
    $product_categoryid = $row ['producto_category'];
    
    $producto_video = $row['producto_video'];
    $producto_cantdisponible = $row['producto_candisp'];
    $producto_disponibilidad = $row['producto_disponibilidad'];
    $producto_valoracion = $row['producto_valoracion'];
    $producto_autorid = $row['producto_publishby'];
}

if ($calificacion){
    $porcentaje = $calificacion['PorcentajeMeGusta'];
}

if (isset($_SESSION['success_message'])) {
    echo '<div id="successMessage" 
    class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="images/PackathonLogo.png">
    <link rel="stylesheet" href="css/product.css" />
</head>

<body>

    <!-- Barra de navegación -->
    <body id="idBody">
        <!-- NAVEGADOR -->
        <nav id="idNav1" class="navbar navbar-expand-md">
            <button id="idTituloTienda" class="navbar-brand d-flex mr-auto" type="button">
                <img src="Images/LogoB.png" width="135px"/>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div id="idNavLinks1" class="navbar-collapse collapse order-1 order-md-0 dual-collapse2">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a id="idNavOptions1" class="nav-link" href="Dashboard2.php">Inicio</a>
                        </li>
                    </ul>
                </div>
                <form class="nav-search" action="Dashboard2Busqueda.php" method="get">
               <input class="form-control" type="search" placeholder="Buscar productos" aria-label="Search" name="search_term">
               <button class="btn btn-primary" type="submit">Buscar</button>
           </form>
                <div id="idNavLinks1" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a id="idNavOptions1" class="nav-link" href="Login.html">Cerrar Sesión</a>
                        </li>
                        <?php
                        if($usuario_type =="1"){
                            echo'<li class="nav-item">';
                            echo'<a id="idCarrito" class="icon-link" href="ShoppingCart.php">';
                            echo'<img src="Images/CarritoW.png" width="45px"/> Carrito';
                            echo'</a>';
                            echo'</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <nav id="idNav2" class="navbar navbar-expand-sm">
            <div id="idNavLinks2" class="mx-auto d-sm-flex d-block flex-sm-nowrap">
                <div class="collapse navbar-collapse text-center" id="navbarsExample11">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a id="idNavOptions2" class="nav-link" href="UserProfile.php">Perfíl ^</a>
                        </li>

                        <?php
                        if($usuario_type == "1"){
                            echo'<li class="nav-item">';
                            echo'<a id="idNavOptions2" class="nav-link" href="ChatUsuario.php">Chat ^</a>';
                            echo'</li>';
                        }
                        ?>

                        <?php
                        if($usuario_type == "1"){
                            echo'<li class="nav-item">';
                            echo'<a id="idNavOptions2" class="nav-link" href="ListasTodos.php">Listas de Deseos ^</a>';
                            echo'</li>';
                        }
                        ?>

                        <?php
                        if($usuario_type == "2"){
                            echo'<li class="nav-item">';
                            echo'<a id="idNavOptions2" class="nav-link" href="ChatCotizador.php">Chat Cotizaciones ^</a>';
                            echo'</li>';
                        }
                        ?>

                        <?php
                        if($usuario_type == "2"){
                            echo'<li class="nav-item">';
                            echo'<a id="idNavOptions2" class="nav-link" href="RegistrarProducto.php">Alta producto ^</a>';
                            echo'</li>';
                        }
                        ?>
                        
                        <?php
                        if($usuario_type == "2"){
                            echo'<li class="nav-item">';
                            echo'<a id="idNavOptions2" class="nav-link" href="VendedorProfileV.php">Productos ^</a>';
                            echo'</li>';
                        }
                        ?>
                        
                        <?php
                        if($usuario_type == "3"){
                            echo'<li class="nav-item">';
                            echo'<a id="idNavOptions2" class="nav-link" href="adminVendedores.php">Vendedores</a>';
                            echo'</li>';
                        }
                        ?>

                        <?php
                        if($usuario_type == "3"){
                            echo'<li class="nav-item">';
                            echo'<a id="idNavOptions2" class="nav-link" href="AutoProductos.php">Autorizar</a>';
                            echo'</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php  
    if($usuario_type =="1")
    {
        ?>
    <!-- Contenido principal -->
    <main class="container mt-5">
        <div class="row">
            <div class="col-md-6">
            
                <div class="imagenes_prod">
                    <?php 

                  echo '<img src="data:image/jpeg;base64,' . $producto_img . '" 
                        alt="imagen" style="width: 450px; height: auto;">';
                    echo'<br><br>';
                    echo'<img src="data:image/jpeg;base64,'.$producto_img2.'"
                         alt="imagen2" 
                         style="margin-left: 120px; width: 100px; height: 100px;">';

                    echo'<img src="data:image/jpeg;base64,'.$producto_img3.'" 
                         alt="imagen3" 
                         style="margin-left: 60px; width: 100px; height: 100px;">';
                    
                    ?>
                </div>
            </div>
            <div class="col-md-6">
            <br>
            <br>
            <br>
            <?php
                       echo'<h2>'.$product_name.'</h2>';
                       echo'<p class="card-price">Precio : $XX.XX</p>';
                       echo'<p class="card-price">Cantidad en Stock: '.$producto_cantdisponible.' ('.$producto_disponibilidad.') </p>';
                     
                       echo'<p class="card-category">Categoría: 
                       <a href ="categorias.php?categoryid=' .$product_categoryid. '">
                       '.$product_category.'</a></p>';
                       if($producto_disponibilidad == "No Disponible"){
                        echo'<a href="#" class="btn btn-primary">PRODUCTO NO DISPONIBLE</a>';
                       }elseif($producto_disponibilidad == "Disponible"){
                        echo '<a href="agregar_contacto.php?producto_autorid=' 
                        . $producto_autorid . '&producto_id=' . $product_id . '" 
                        class="btn btn-primary">Comisionar</a>';
                       }
                 ?>
            </div>
        </div>


        <div class="mt-5">
         
            <h3>Descripción del Producto</h3>
            <?php
            echo'<p>'.$product_desc.'</p>';
            ?>
        </div>


        <div class="mt-5">
            <h3>Video del Producto</h3>
            <video width="100%" controls>
            <?php
            echo'<source type="video/mp4" src="data:video/mp4;base64,'.$producto_video.'">';
            ?>
                Tu navegador no admite el elemento de video.
            </video>
        </div>

        <div class="mt-5">
        <h2>Calificación del Producto</h2>
            <div class="progress mt-3">
            <?php 
              if ($porcentaje >= 50) {
                  echo '<div id="progress-bar" class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: ' . $porcentaje . '%;" aria-valuenow="' . $porcentaje . '" aria-valuemin="0" aria-valuemax="100"></div>';
                 } elseif ($porcentaje < 50) {
                echo '<div id="progress-bar" class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: ' . $porcentaje . '%;" aria-valuenow="' . $porcentaje . '" aria-valuemin="0" aria-valuemax="100"></div>';
                }
                 ?>
            </div>
            <span id="porcentaje"><?php echo $porcentaje; ?>%</span>
            <br><br>
            <p style="margin-left:800px;">Calificar Producto</p>
            <button style="margin-left:800px;"class="btn btn-success" onclick="actualizarPuntuacion('like', <?php echo $product_id; ?>)">Me gusta</button>
            <button class="btn btn-danger" onclick="actualizarPuntuacion('dislike', <?php echo $product_id; ?>)">No me gusta</button>
        </div>


        <!-- Comentarios de los usuarios -->
        <div class="mt-5">
            <h3>Comentarios de Usuarios</h3>
           
            <?php
            while ($row = $comentarios->fetch_assoc()) 
            {
                $coment_id = $row['coment_id'];
                $coment = $row['coment'];
                $coment_author = $row['coment_author'];
                $coment_prod = $row['coment_prod']; 
                $usuari_id =$row['usuario_id'];
                $usuari = $row['usuario'];
                $usuari_type = $row['usuario_type']; 
                $usuari_imagen = $row['usuario_imagen'];
              echo'<div class="media">';
              echo' <img src="data:image/jpeg;base64,'.$usuari_imagen.'"
                   class="mr-3 rounded-circle" alt="Usuario">';
              echo'    <div class="media-body">';
              echo'    <h5 class="mt-0">'.$usuari.'</h5>';
              echo'     <p>'.$coment.'</p>';
              echo' </div>';
              echo'</div>';
            }
            ?>
            <br><br>
     
            <form action="agregar_comentarioCommi.php" method="POST" enctype= "multipart/form-data" >
                <input type="hidden" name="pd_id" value="<?php echo $product_id ?>">
                <label for="formFile" class="form-label">COMENTAR</label>
                <br>
                <input class="form-control" type="text" placeholder="Escribe un mensaje..." name="mensaje" id="ubicacionInput">
                <br>
                <button type="submit"style="margin-left:950px;"class="btn btn-primary">Publicar</button>
           </form>
        </div>
    </main>

    <br>
    <br>
    <br>
    <br>
    <?php
    }
    else{
        echo'<button id="idTituloTienda" class="navbar-brand d-flex mr-auto" type="button">';
        echo '<img src="Images/Alto.jpg" width="1000px  text-align: center/>';
        echo'</button>';
    }
    ?> 
    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2023 Packathon</p>
        </div>
    </footer>

    <script>
document.addEventListener('DOMContentLoaded', function() {

  var inputNumero = document.getElementById('numero');
  var inputNumero2 = document.getElementById('numero2');
 
  inputNumero.addEventListener('change', function() {

    if (inputNumero.value <= 0) {
      inputNumero.value = 1;
    }

    if (inputNumero.value > parseInt(inputNumero.max)) {
      inputNumero.value = inputNumero.max;
    }
  });

   inputNumero2.addEventListener('change', function() {

   if (inputNumero2.value <= 0) {
    inputNumero2.value = 1;
    }

   if (inputNumero2.value > parseInt(inputNumero2.max)) {
    inputNumero2.value = inputNumero2.max;
   }
   });
});
</script>

<script>
function actualizarPuntuacion(tipo, product_id) {
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Respuesta del servidor:", this.responseText);
            location.reload();
        }
    };
    xmlhttp.open("GET", "puntuacion.php?tipo=" + tipo + "&producto_id=" + product_id, true);
    xmlhttp.send();
}

setTimeout(function () {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 6000);
</script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
