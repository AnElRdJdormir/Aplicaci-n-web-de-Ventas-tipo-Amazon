<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario_type= $_SESSION['usuario_type'];
$fechaCreacion =   $_SESSION['usuario_create'];
$fechabirth =   $_SESSION['usuario_birth'];
if ($fechaCreacion) {
    $fechaFormateada = date("d/m/Y", strtotime($fechaCreacion)); 
}

if ($fechabirth) {
    $fechacumpleaños = date("d/m/Y", strtotime($fechabirth)); 
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Figure Out! | Crear lista de deseos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/EditUserDesign.css">
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
        <div id="idCreateList" class="form-box form-value container-fluid">
            <form id="idForm" action="insertarlista.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <label id="idEUTitulo" class="text">Crear Lista de Deseos</label>
                </div>
            
                <div class="row">
                    <div class="col">
                        <div id="idEUAvatar">
                            <div class="d-flex justify-content-center">
                                <img id="idCLAvatarSample" src="Images/ImagenProducto.png" alt="example placeholder"/>
                            </div>

                            <div class="d-flex justify-content-center" id="edit_imagen" name="edit_imagen" accept="image/*">
                                <div id="idEUAvatarBtn" class="btn btn-primary btn-rounded">
                                    <label class="form-label m-1" for="btnEUAvatar">Imagen de la Lista</label>
                                    <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*" onchange="mostrarAvatar(event, 'idCLAvatarSample')"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col">
                        <div id="idEUInputs" class="inputbox">
                            <label for="">Nombre de la Lista</label>
                            <input type="text" id="NombreLista" aria-describedby="emailHelp" name="nombre">
                        </div>
                        
                        <div id="idEUInputs" class="inputbox">
                            <label for="">Descripción de la Lista</label>
                            <textarea class="form-control" id="exampleTextarea" rows="3" id="descripcion" name="descripcion"></textarea>
                        </div>

                        <div>
                            <select class="form-select" id="PrivList" name="PrivList">
                                <option class="item-1" selected>Privacidad de su Lista: </option>
                                <option id="dropdown" value="1">Publica</option>
                                <option id="dropdown"  value="2">Privada</option>
                            </select>
                        </div>

                        <div>
                            <div id="idEUBtns2" class="d-flex justify-content-between">
                                <button id="btnEU" type="submit">Crear Lista</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <a id="idCLBtns" class="nav-link d-flex justify-content-between" href="UserProfile.php">
                            <button id="btnCL" type="button">Volver al perfil del usuario</button>
                        </a>
                    </div>
                </div>

            </form>
        </div>
        <?php
    }
    else{
        echo'<button id="idTituloTienda" class="navbar-brand d-flex mr-auto" type="button">';
        echo '<img src="Images/Alto.jpg" width="1000px  text-align: center/>';
        echo'</button>';
    }
    ?> 
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
        <script src="JS/bootstrap.min.js"></script>
        <script src="JS/Register.js"></script>
    </body>
</html>