<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_productos.php');

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

    $product_id = $row['IDProducto'];

    $product_name = $row['producto_name'];
    $product_price = $row['producto_price'];
    $product_desc = $row ['producto_desc'];
    $product_category = $row ['category'];
    $product_categoryid = $row ['producto_category'];
    
    $producto_video = $row['producto_video'];
    $producto_cantdisponible = $row['producto_candisp'];
    $producto_disponibilidad = $row['producto_disponibilidad'];
    $producto_valoracion = $row['producto_valoracion'];

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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Producto1</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/InfoProductoDesign.css">
        <script src="JS/bootstrap.min.js"></script>
    </head>

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


            <!-- Contenido principal -->
            <main class="container mt-5">
        <div class="row">
            <div class="col-md-6">
            
                <div class="imagenes_prod">
                    <?php 

                    echo'<img src="data:image/jpeg;base64,'.$producto_img.'" 
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
                     echo'<form action="agregarcarritoproducto.php" method="POST" enctype="multipart/form-data" class="border rounded p-3">';
                     echo '<h2>'.$product_name.'</h2>';
                     echo '<p class="card-price">Precio: $'.$product_price.'</p>';
                     echo '<p class="card-price">Cantidad en Stock: '.$producto_cantdisponible.' ('.$producto_disponibilidad.') </p>';

                     echo '<p class="card-category">Categoría: <a href="categorias.php?categoryid=' .$product_categoryid. '">'.$product_category.'</a></p>';
                     echo 'Cantidad a Comprar';
                     echo '<input type="number" style="width:20%;" class="form-control" id="numero" name="numero" min="1" max="'.$producto_cantdisponible.'" value="'.$producto_cantdisponible.'" >';
                     echo '<br>';

                     echo '<input type="hidden" name="product_id_1" value="'.$product_id.'">';
                     echo '<input type="hidden" name="precio" value="'.$product_price.'">';
                     echo '<button type="submit" class="btn btn-primary">Agregar a Carrito</button>';
                     echo '<br><br>';
                     echo '</form>';


                     echo '<form action="insertarlistaprod.php" method="POST" enctype="multipart/form-data" class="border rounded p-3">';
                     echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
                     echo '<p class="card-price">Agregar producto a la lista de deseados: </p>';
                     echo '<select class="form-select" name="listid" id="listid" required>';

                     while ($row = $ListasProductos->fetch_assoc()) {
                       $lista_id= $row['lista_id'];
                       $lista_nombre=$row['lista_nombre']; 
                      echo '<option value="'.$lista_id.'">'.$lista_nombre.'</option>';
                     } 
                 
                     echo '</select>';
                     echo '<br>';
                     echo '<p class="card-price">Cantidad a Agregar: </p>';
                     echo '<input type="number" style="width:20%;" class="form-control" 
                     id="numero2" name="numero2" min="1" max="'.$producto_cantdisponible.'" 
                     value="'.$producto_cantdisponible.'" >';
                     echo '<br>';
                     echo '<button type="submit" class="btn btn-primary">Agregar</button>';
                     echo '</form>';
                 ?>
            </div>
        </div>

        <!-- Descripción del producto -->
        <div class="mt-5">
         
            <h3>Descripción del Producto</h3>
            <?php
            echo'<p>'.$product_desc.'</p>';
            ?>          
        </div>

        
        <!-- Video del producto -->
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
     
            <form action="agregar_comentario.php" method="POST" enctype= "multipart/form-data" >
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

        


        
        <!-- FOOTER -->
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>

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
    xmlhttp.open("GET", "puntuacion.php?tipo=" + tipo + "&IDProducto=" + product_id, true);
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

<!--


            <div class="container-title">
            Nendoroid Vanitas The Case Study of Vanitas 10cm
        </div>
        
        <main>
            <div class="container-img">           
                <img id="idFotoProducto" src="Images/Productos/Figure_Vanitas.jpg" class="img-fluid">
            </div>
        
            <div class="container-info-product">
                <div class="container-price">
                    <span>$1,414</span>
                    <a href="Dashboard2.html">
                    <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>

                <div class="container-add-cart">
                    <div class="container-quantity">
                        <input 
                        type="number"
                        step="1" 
                        max="10" 
                        min="1"
                        value="1" 
                        name="quantity" 
                        class="input-quantity"
                        />

                        <div class="btn-increment-decremet">
                            <i class="fa-solid fa-chevron-up" id="increment"></i>

                            <i class="fa-solid fa-chevron-down" id="decrement"></i>

                        </div>
                    </div>

                    <button class="btn-add-to-cart">
                        <i class="fa-solid fa-plus"></i>
                        Añadir al carrito
                    </button>
                </div>

                <div class="container-description">
                    <div class="title-description">
                        <h4>Descripción del Producto</h4>

                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="text-description">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                            Nesciunt deleniti repellat reiciendis. 
                            Ab tempora, laudantium similique saepe quos explicabo omnis ullam at quasi enim harum, 
                            alias dolorem autem est assumenda?
                        </p>

                    </div>
                </div>

                <div class="container-additional-information">
                    <div class="title-additional-information">
                        <h4>Información Adicional</h4>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="text-additional-information hidden">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                            Nesciunt deleniti repellat reiciendis. 
                            Ab tempora, laudantium similique saepe quos explicabo omnis ullam at quasi enim harum, 
                            alias dolorem autem est assumenda?
                        </p>
                    </div>
                </div>

                <div class="container-reviews">
                    <div class="title-reviews">
                        <h4>Reseñas</h4>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="text-reviews  hidden">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                            Nesciunt deleniti repellat reiciendis. 
                            Ab tempora, laudantium similique saepe quos explicabo omnis ullam at quasi enim harum, 
                            alias dolorem autem est assumenda?
                        </p>
                    </div>
                </div>

                <div class="container-social">
                    <span>Compartir</span>
                    <div class="container-buttons-social">
                        <a href="#">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                        
                        <a href="#">
                            <i class="fa-brands fa-facebook"></i>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-twitter"></i>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </main>



        <section class="container-related-products">
            <h2>Productos Relacionados</h2>
            <div class="card-list-products">
                <div class="card">
                    <div class="card-img">
                        <img src="https://images.goodsmile.info/cgm/images/product/20211130/12070/92691/large/e6cc8568e635b0ecea3606f36f188416.jpg" 
                        alt="Producto-1">
                    </div>

                    <div class="info-card">
                        <div class="text-product">
                            <h3>Nendoroid Noé Archiviste</h3>

                            <p class="category">
                                Figura
                            </p>
    
                        </div>
                        <div class="price">
                            $670.00
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="https://down-mx.img.susercontent.com/file/sg-11134201-7rbke-lqmrnh235o0u48" 
                        alt="Producto-2">
                    </div>

                    <div class="info-card">
                        <div class="text-product">
                            <h3>liberty Japan Anime El Caso De Estudio De Vanitas Stand Figuras Acrílicas Modelo De Escritorio</h3>

                            <p class="category">
                                Figuras
                            </p>
    
                        </div>
                        <div class="price">
                            $68.50
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="https://i.etsystatic.com/26999685/r/il/915205/4449844473/il_1140xN.4449844473_le9u.jpg" 
                        alt="Producto-3">
                    </div>

                    <div class="info-card">
                        <div class="text-product">
                            <h3>Sans frescos. Undertale. Juguete de peluche grande. Tamaño 15 pulgadas</h3>

                            <p class="category">
                                Peluche
                            </p>
    
                        </div>
                        <div class="price">
                            $1,613.00
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="https://down-mx.img.susercontent.com/file/ed6384657977c63a5369c00c296ab9eb" 
                        alt="Producto-4">
                    </div>

                    <div class="info-card">
                        <div class="text-product">
                            <h3>Anime El Caso De Estudio De Vanitas Llaveros De Dibujos Animados Llavero De Figura Acrílica De Vacaciones</h3>

                            <p class="category">
                                Llavero
                            </p>
    
                        </div>
                        <div class="price">
                            $34.50
                        </div>
                    </div>
                </div>

            </div>
        </section>
-->