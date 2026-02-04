<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario_type= $_SESSION['usuario_type'];
/*
$lista_id= $row['lista_id'];
$lista_desc= $row['lista_desc']; 
$lista_img= $row['lista_imagen']; 
$lista_estado=$row['lista_estado']; 
$lista_nombre=$row['lista_nombre']; 
$lista_authorid=$row['lista_author'];
*/
include ('mostrar_listas.php');
include ('mostrar_historial.php');
include ('mostrar_ventas.php');

if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];
} else {
    echo "Error: No se proporcionó el ID de la lista.";
}

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


        <!-- CUERPO -->
        <div id="idUserProfile" class="container-fluid">
            <div id="idUPUsuarioInfo" class="row">
                <div class="d-flex col">
                <img src="data:image/jpeg;base64,<?php 
                echo $_SESSION['usuario_imagen'];
                ?>" alt="Foto de perfil">
            
                    <ul class="d-flex flex-column">
                    <li id="idUPNombreUsuario" class="list-group-item"><?php 
                    echo $_SESSION['usuario_id'];
                    ?></li>
                        <li id="idUPNombreUsuario" class="list-group-item">Nombre de Usuario</li>
                        <li id="idUPNombreUsuario" class="list-group-item"><?php echo $_SESSION['usuario'];?></li>
                        <a class="icon-link" href="EditUser.php">
                            <li class="list-group-item">
                                <button id="btnUPEditarUsuario" type="button">Editar perfil</button>
                            </li>
                        </a>
                        <br>
                        <?php
                        if($usuario_type == "2"){
                            echo'<a class="icon-link" href="addcategory.php">';
                            echo'<li class="list-group-item">';
                            echo'<button id="btnUPEditarUsuario" type="button">Agregar Categorias</button>';
                            echo'</li>';
                            echo'</a>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            
            <main class="container mt-4">
                <?php
                if($usuario_type == "1")
                {
                echo'<h1 class="mb-4">Listas de Deseos</h1>';

                echo'<div class="card">';
                echo'<div class="card-body">';
                echo'<h4 class="card-title">Crear Listas</h4>';
                echo'<p class="card-subtitle mb-2 text-muted">Para Crear Listas Ingrese al Link debajo</p>';
                echo'<h6 class="card-text">⚠IMPORTANTE:(Sí desea agregar un producto a una lista vaya al producto deseado';
                echo'<br> y agregelo desde la pagína)';
                echo'</h6>';
                echo'<a href="crearlista.php" class="card-link">Crear Lista</a>';
                echo'</div>';
                echo'</div>';
            }
                ?>
                <br><br>


            </main>

            <?php
            if($usuario_type == "1"){
                echo'<div id="idUPSubtitulos" class="row">';
                echo'<label class="text">Historial de pedidos</label>';
                echo'</div>';

                echo'<br><br>';

                echo'<div class="profile">';
                echo'<table class="table">';
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
            ?>

            <?php
            if($usuario_type == "2"){
                echo'<table class="table">';
                echo'<thead>';
                echo'<tr>';
                echo'<th>Producto</th>';
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

            <br>
            <br>

            <?php
            if($usuario_type == "2"){
                echo'<h4 class="profile-heading">Ventas de Categorías</h4>';
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
