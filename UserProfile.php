<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_listas.php');
include ('mostrar_historial.php');
include ('mostrar_ventas.php');

$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];
$usuario_priv = $_SESSION['usuario_priv'];
$usuario_gen = $_SESSION['usuario_gen'];

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
        <title>Figure Out! | Perfil de Usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/UserProfileDesign.css">
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


        <!-- CUERPO -->
        <div id="idUserProfile" class="container-fluid">
            <div id="idUPUsuarioInfo" class="row">
                <div class="d-flex col">
                    <img id="idUPAvatar" src="data:image/jpeg;base64,<?php echo $_SESSION['usuario_imagen'];?>" class="rounded-circle" alt="Foto de perfil">
            
                    <ul class="d-flex flex-column">
                        <li id="idUPNombreUsuario" class="list-group-item">
                            <?php 
                                echo $_SESSION['usuario'];

                                echo '  ';

                                if($usuario_type == "1"){
                                    echo '<label id="idUPRol" class="text">(Comprador)</label>';
                                }else if($usuario_type == "2"){
                                    echo '<label id="idUPRol" class="text">(Vendedor)</label>';
                                }else{
                                    echo '<label id="idUPRol" class="text">(Administrador)</label>';
                                }
                            ?>
                        </li>

                        <li id="idUPUsuarioID" class="list-group-item">
                            ID: <?php
                                    echo $_SESSION['usuario_id'];

                                    echo ' ';
                                    
                                    if($usuario_priv == "1")
                                    {
                                        echo '<label id="idUPPrivacidad" class="text">Cuenta Pública</label>';
                                    }
                                    if($usuario_priv == "2")
                                    {
                                        echo '<label id="idUPPrivacidad" class="text">Cuenta Privada</label>';
                                    }
                                ?>
                        </li>
                        
                        <li class="list-group-item">
                            <?php
                                if($usuario_priv == "1")
                                {
                                    echo 'Correo: ';
                                    echo $_SESSION['usuario_email'];
                                }
                            ?>
                        </li>
                        <li class="list-group-item">
                            <?php
                                if($usuario_priv == "1")
                                {
                                    echo 'Fecha de Nacimiento: ';
                                    echo $_SESSION['usuario_birth'];
                                }
                            ?>
                        </li>
                        <li class="list-group-item">
                            <?php
                                if($usuario_priv == "1")
                                {
                                    echo 'Género: ';
                                    if($usuario_gen == "option1"){
                                        echo 'Masculino';
                                    }else if($usuario_gen == "option2"){
                                        echo 'Femenino';
                                    }else{
                                        echo 'No Binario';
                                    }
                                }
                            ?>
                        </li>

                        <ul id="idUPListaBtns" class="list-group list-group-horizontal">
                            <a class="icon-link" href="EditUser.php">
                                <li class="list-group-item">
                                    <button id="btnUPEditarUsuario" type="button" class="item-1">Editar perfil</button>
                                </li>
                            </a>
                            <?php
                            if($usuario_type == "2"){
                                echo'<a class="icon-link" href="addcategory.php">';
                                echo'<li class="list-group-item">';
                                echo'<button id="btnUPEditarUsuario" type="button">Agregar Categorías</button>';
                                echo'</li>';
                                echo'</a>';
                            }
                            ?>
                        </ul>
                    </ul>
                </div>
                
            </div>
            
            <!-- <main class="container mt-4"> -->
                <?php
                    if($usuario_type == "1")
                    {
                        echo'<div id="idUPSubtitulos" class="row">';
                        echo'<label class="text">Lista de deseos</label>';
                        echo'</div>';

                        echo'<div id="idUPSubtitulos" class="row">';
                        echo'<div id="idCrearListas">';
                        echo'<h4 class="card-title">Crear Listas</h4>';
                        echo'<p class="card-subtitle mb-2">Para crear listas oprima el botón de abajo</p>';
                        echo'<h6 class="card-text">⚠ IMPORTANTE: (Sí desea agregar un producto a una lista diríjase al producto deseado';
                        echo'<br> y añádelo desde el dashboard)';
                        echo'</h6>';
                        echo'<a href="crearlista.php" class="btn btn-primary">Crear Lista</a>';
                        echo'</div>';
                        echo'</div>';
                    }
                ?>

                
                
  

            <!-- </main> -->

            <?php
            if($usuario_type == "1")
            {
                if($usuario_priv == "1")
                {
                echo'<div id="idUPSubtitulos" class="row">';
                echo'<label class="text">Historial de pedidos</label>';
                echo'</div>';

                echo'<br>';
                
                echo'<div class="row justify-content-md-center">';
                echo'<div class="col-md-11">';
                echo'<table id="idVUTabla" class="table">';
                echo'<thead>';
                echo'<tr>';
                echo'<th>Producto</th>';
                echo'<th>Precio </th>';
                echo'<th>Fecha y Hora</th>';
                echo'<th>Categoria</th>';
                echo'<th>Calificación</th>';
                echo'</tr>';
                echo'</thead>';
                echo'<tbody>';

                while ($row = $Historial->fetch_assoc()) {
                    $fecha=$row['fecha_y_hora'];
                    $precio=$row['carproduct_precio'];
                    $nombre=$row['producto_nombre'];
                    $categoria=$row['categoria'];
                    $calificacion=$row['calificacion'];
                    

                    echo' <tr>';
                    echo'<td>'.$nombre.'</td>';
                    echo'<td>$ '.$precio.'</td>';
                    echo' <td>'.$fecha.'</td>';
                    echo'  <td>'.$categoria.'</td>';
                    echo'  <td>% '.$calificacion.'</td>';
                    echo'</tr>';
                 }


                echo'</tbody>';
                echo'</table>';
                echo'</div>';
            }
            }
            ?>

            <?php
            
            if($usuario_type == "2"){

                echo'<div id="idUPSubtitulos" class="row">';
                echo'<label class="text">Historial de Ventas</label>';
                echo'</div>';

                echo'<table id="idVUTabla" class="table">';
                echo'<thead>';
                echo'<tr>';
                echo'<th class="item-1">Producto</th>';
                echo'<th>Precio </th>';
                echo'<th>Fecha y Hora</th>';
                echo'<th>Categoria</th>';
                echo'<th>Calificación</th>';
                echo'<th>Stock</th>';
                echo'</tr>';
                echo'</thead>';

                while ($row = $Ventas->fetch_assoc()) {
                    $fecha=$row['fecha_y_hora'];
                    $precio=$row['precio'];
                    $nombre=$row['producto_nombre'];
                    $categoria=$row['categoria'];
                    $calificacion=$row['calificacion'];
                    $existencia_actual=$row['existencia_actual'];
                    

                    echo' <tr>';
                    echo'<td>'.$nombre.'</td>';
                    echo'<td>$ '.$precio.'</td>';
                    echo' <td>'.$fecha.'</td>';
                    echo'  <td>'.$categoria.'</td>';
                    echo'  <td>% '.$calificacion.'</td>';
                    echo'  <td>'.$existencia_actual.'</td>';
                    echo'</tr>';
                 }
                echo'</tbody>';
                echo'</table>';
            }
            ?>

            <?php
            if($usuario_type == "2"){
                echo'<div id="idUPSubtitulos" class="row">';
                echo'<label class="text">Ventas por categoría</label>';
                echo'</div>';
                echo'<table class="table">';
                echo'<thead>';
                echo'<tr>';
                echo'<th>Fecha y Hora</th>';
                echo'<th>Categoria</th>';
                echo'<th>Ventas </th>';
                echo'</tr>';
                echo'</thead>';
                echo'</tbody>';
                echo'</table>';

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
