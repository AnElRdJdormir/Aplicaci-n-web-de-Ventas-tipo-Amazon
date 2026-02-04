<?php

include ('mostrar_chat.php');

$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];

$producto_autorid = "";
$product_categoryid = "";
$contacto_id = "";
$cotizacion_estado ="";

if (isset($_GET['producto_autorid']) && isset($_GET['producto_id']) && isset($_GET['contacto_id'])) {
    $producto_autorid = $_GET['producto_autorid'];
    $product_categoryid = $_GET['producto_id'];
    $contacto_id = $_GET['contacto_id'];

    $cotizador_data = $ShowChat->MostrarUsuario($producto_autorid);
    $product_dt = $ShowChat->MostrarProductoComision($product_categoryid);
    $cotizacion_info = $ShowChat->CotizacionesCreadas2($contacto_id);

        if ($cotizador_data) {
            $cotizador_id = $cotizador_data['usuario_id'];

            $cotizador_email = $cotizador_data['usuario_email'];
            $cotizador = $cotizador_data['usuario'];
            $cotizador_name = $cotizador_data['usuario_name'];
            $cotizador_type = $cotizador_data['usuario_type'];

            $cotizador_birth = $cotizador_data['usuario_birth'];
            $cotizador_gen = $cotizador_data['usuario_gen'];

            $cotizador_create = $cotizador_data['usuario_create'];
            $cotizador_image = $cotizador_data['usuario_imagen'];
    
        } else {
            echo "No se encontraron resultados para el usuario con ID $producto_autorid";
        }


       if($product_dt){
  
        $product_id = $product_dt['producto_id'];
    
        $product_name = $product_dt['producto_name'];
        $product_price = $product_dt['producto_price'];
        $product_desc = $product_dt ['producto_desc'];

        $product_category = $product_dt ['category'];
        $product_categoryid = $product_dt ['producto_category'];
        
        $producto_cantdisponible = $product_dt['producto_candisp'];
        $producto_disponibilidad = $product_dt['producto_disponibilidad'];

        $producto_autorid = $product_dt['producto_publishby'];

       }else {
        echo "No se encontraron Resultados para el Producto con ID: $product_categoryid";
       }

       if($cotizacion_info){
  
        $cotizacion_id = $cotizacion_info['cotizacion_id'];
        $cotizacion_precio = $cotizacion_info['cotizacion_precio'];
        $cotizacion_producto = $cotizacion_info['cotizacion_producto'];
        $cotizacion_contacto = $cotizacion_info ['cotizacion_contacto'];
        $cotizacion_estado = $cotizacion_info ['cotizacion_estado'];
       }

    }else {
    echo "Error: No se proporcionaron todos los parámetros necesarios.";
    }


    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figure Out! | Chat de Compras</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="shortcut icon" href="images/PackathonLogo.png">
    <link rel="stylesheet" href="CSS/ChatCompDesign.css" />
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
                <?php
                if($usuario_type =="1"){
                    echo '<ul class="navbar-nav mr-auto">';
                    echo '<li class="nav-item active">';
                    echo '<a id="idNavOptions1" class="nav-link" href="Dashboard2.php">Inicio</a>';
                    echo '</li>';
                    echo '</ul>';
                }
                ?>
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
        
        <?php  
    if($usuario_type =="1" ||$usuario_type =="2")
    {
        ?>

    <main>
        <div class="jumbotron">
            <?php 
                echo '<div id="idSubtitulos" class="row">';
                echo '<label class="primerSub">
                Sala de Chat - Producto: '.$product_name.' </label>';
                echo '</div>';
            ?>
            <div id="idSubtitulos" class="row">
                <label>Comisiones y Articulos Personalizados</label>
            </div>

            <p>La pagina sera recargada en :</p>
            <div class="progress" id="progressBarContainer">
            <div class="progress-bar progress-bar-striped progress-bar-animated" 
            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
            style="width: 0%;" id="progressBar">
             Cargando...
            </div>
            </div>
        </div>

        </div>
        <div id="idChatContainer" class="container">
            <div class="row chat col-7">
                <div id="idHeaderChat" class="chat-header">
                 <?php
                  echo'<img id="idChCVendedor" src="data:image/jpeg;base64,'.$cotizador_image.'" 
                  class="chat-avatar rounded-circle">';
                   echo '<label class="chat-username">'.$cotizador.'</label>'
                  ?>
                </div>
                <div id="idCajaChat" class="chat-messages">

                <?php 
                    $usuario_id = $_SESSION['usuario_id'];

                  $mensajes= $ShowChat->VerMensajes($contacto_id);
                  
                  while ($row = $mensajes->fetch_assoc()) {
                    $message_id= $row['chat_id'];
                    $message_txt= $row['chat_text'];
                    $message_author= $row['chat_author'];
                    $contact_id= $row['contacto_id'];

                    if($message_author == $usuario_id){
                    echo'<div class="message message-usuario">';
                    echo'<p>'.$message_txt.'</p>';
                    echo'</div>';
                    }else{
                    echo'<div class="message message-vendedor">';
                    echo'<p>'.$message_txt.'</p>';
                    echo'</div>';
                    }            
                  }
                  if($cotizacion_estado =="Creada"){
                    echo'<div class="message message-vendedor">';
                    echo'<p>La comisión se ha creado con exito
                        <br>Ingrese al enlace para agregar el producto
                        <br> al carrito de compras.</p>';
                        echo'<form action="agregarcarritoproducto.php" method="POST" enctype="multipart/form-data">';
                        echo '<input type="hidden" name="product_id_1" value="'.$product_id.'">';
                        echo '<input type="hidden" name="precio" value="'.$cotizacion_precio.'">';
                        echo '<input type="hidden" name="numero" value="1">';
                        echo '<button type="submit" class="btn btn-primary">Agregar al Carrito</button>';
                        echo '<br><br>';
                        echo '</form>';
                    echo'</div>';
                    echo'<br>';
                  }
                ?>

       
                </div>
                <br>
                <div class="chat-input">
                    <form action="chat.php" method="POST" enctype= "multipart/form-data">   
                    <input type="hidden" name="producto_autorid" 
                    value="<?php echo $cotizador_id; ?>">
                    <input type="hidden" name="product_categoryid" 
                    value="<?php echo $product_id; ?>">
                    <input type="hidden" name="contacto_id" 
                    value="<?php echo $contacto_id; ?>">
              
                    <textarea placeholder="Escribe tu mensaje..." name="mensaje"></textarea>
                    <button class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        

    </main>

    <?php
    }
    else{
        echo'<button id="idTituloTienda" class="navbar-brand d-flex mr-auto" type="button">';
        echo '<img src="Images/Alto.jpg" width="1000px  text-align: center/>';
        echo'</button>';
    }
    ?>  
    <!-- FOOTER -->
    <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>



    <div class="progress" id="progressBarContainer">
    <div class="progress-bar progress-bar-striped progress-bar-animated" 
         role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
         style="width: 0%;" id="progressBar">
         Loading...
    </div>
</div>

<script>
    var progressBar = document.getElementById("progressBar");
    var startTime = new Date().getTime();

    function updateProgressBar() {
        var currentTime = new Date().getTime();
        var elapsedTime = currentTime - startTime;
        var progress = (elapsedTime / 20000) * 100; // 20000 milisegundos = 20 segundos

        // Ajusta el progreso para que no supere el 100%
        progress = Math.min(progress, 100);

        // Agrega el texto de progreso
        progressBar.innerHTML = " Cargando... " + Math.round(progress) + "%";

        // Actualiza el valor y el estilo de la barra de progreso
        progressBar.style.width = progress + "%";
        progressBar.setAttribute("aria-valuenow", progress);

        // Recarga la página solo si ha llegado al 100%
        if (progress >= 100) {
            setTimeout(function () {
                location.reload();
            }, 1000); // Espera 1 segundo antes de recargar
        } else {
            // Programa la próxima actualización después de un breve intervalo
            setTimeout(updateProgressBar, 1000); // 1 segundo en milisegundos (ajusta según tus necesidades)
        }
    }

    // Inicia la actualización de la barra de progreso
    updateProgressBar();
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>