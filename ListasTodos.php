<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];


include ('mostrar_listas.php');
include ('mostrar_historial.php');
include ('mostrar_ventas.php');

$fechaCreacion =   $_SESSION['usuario_create'];
$fechabirth =   $_SESSION['usuario_birth'];

if ($fechaCreacion) {
    $fechaFormateada = date("d/m/Y", strtotime($fechaCreacion)); 
}

if ($fechabirth) {
    $fechacumpleaños = date("d/m/Y", strtotime($fechabirth)); 
}

if (isset($_SESSION['success_message'])) {
    echo '<div id="successMessage" 
    class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}



$ListasCreadas = $ShowListas->MostrarListasCreadas($usuario_id);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Figure Out! | Listas de deseos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/ListasTodosDesign.css">
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

        <?php  
    if($usuario_type =="1")
    {
        ?>

        <!-- CUERPO -->
        <main>
            <div id="idUPSubtitulos" class="row item-1">
                <label>Mis Listas de Deseos</label>
            </div>
            <div id="idListaContainer" class="row container-fluid">

                <?php
                    while ($row = $ListasCreadas->fetch_assoc()) 
                    {
                        $lista_id= $row['lista_id'];
                        $lista_desc= $row['lista_desc']; 
                        $lista_img= $row['lista_imagen']; 
                        $lista_estado=$row['lista_estado']; 
                        $lista_nombre=$row['lista_nombre']; 
                        $lista_authorid=$row['lista_author'];

                        echo' <div class="row mb-4">';
                        echo'<div class="col">';

                        echo'<img id="idFotoLista" src="data:image/jpeg;base64,'.$lista_img.'"
                        class="img-fluid" alt="ListaImagen">';
                        echo'</div>';
                        echo'<div id="idInfoLista" class="col">';
                        //   echo'<br><br>';
                        echo'<h4 id="idNombreLista">'.$lista_nombre.'</h4>';

                        if($lista_estado == "1")
                        {
                            echo'<p class="privacy">Lista Publica</p>';
                        }
                        
                        if($lista_estado == "2")
                        {
                            echo'<p class="privacy">Lista Privada</p>';
                        }

                        echo'<p id="idDescLista">'.$lista_desc.'</p>';
                        //   echo'<br> '; 
                        echo'<a id="btnVerLista" href="wishlist.php?lista_id=' . $lista_id . '" class="btn btn-primary">Ver Lista de Deseos</a>';
                        // echo'&nbsp;';
                        echo '<div id="idBtnsLista">';
                        echo'<a href="editlista.php?lista_id=' . $lista_id . '" class="btn btn-warning">Editar Lista</a>';
                        
                        echo'<a
                                href="eliminarlista.php?lista_id=' . $lista_id . '" 
                                class="btn btn-danger">Eliminar Lista</a>';
                        echo'</div>';
                        echo'</div>';
                        echo'</div>';
                    }
                ?>
            </div>                  
                
                
            <div id="idUPSubtitulos" class="row">
                <label>Todas las Listas</label>
            </div>
            <div id="idListaContainer" class="row container-fluid">
            <?php
                while ($row = $ListasOtras->fetch_assoc()) 
                {
                    $lista_id= $row['lista_id'];
                     $lista_desc= $row['lista_desc']; 
                     $lista_img= $row['lista_imagen']; 
                     $lista_estado=$row['lista_estado']; 
                     $lista_nombre=$row['lista_nombre']; 
                     $lista_authorid=$row['lista_author'];


                  echo' <div class="row mb-4">';

                  echo'<div class="col">';
                  echo'<img id="idFotoLista" src="data:image/jpeg;base64,'.$lista_img.'"
                        class="img-thumbnail" alt="ListaImagen">';
                  echo'</div>';

                  echo'<div id="idInfoLista" class="col">';
                //   echo'<br><br>';
                
                  echo'<h4 id="idNombreLista">'.$lista_nombre.'</h4>';
                  echo'<h6 id="idUserLista">(ID del autor: '.$lista_authorid.')</h6>';

                    if($lista_estado == "1")
                  {
                    echo'<p class="privacy">Lista Publica</p>';
                  }
                  
                  if($lista_estado == "2")
                  {
                    echo'<p>Lista Privada</p>';
                  }

                  echo'<p id="idDescLista">'.$lista_desc.'</p>';
                  
                //   echo'<br> '; 
                  echo'<a id="btnVerLista" href="wishlistOthers.php?lista_id=' . $lista_id . '" class="btn btn-primary">Ver Lista de Deseos</a>';

                  echo'</div>';
                  echo'  </div>';
                }
                ?>
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