<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_productos.php');

$usuario_priv = $_SESSION['usuario_priv'];

if (isset($_SESSION['success_message'])) {
    echo '<div id="successMessage" 
    class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['danger_message'])) {
    echo '<div id="dangerMessage" 
    class="alert alert-danger">' . $_SESSION['danger_message'] . '</div>';
    unset($_SESSION['danger_message']);
}

$usuario_type= $_SESSION['usuario_type'];


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TÍTULO | Productos del Vendedor</title>
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

            <!-- <main class="content"> -->
            <div id="idUPSubtitulos" class="row">
                <label class="text">Lista de Productos</label>
            </div>
            
            <?php
                echo'<div class="row justify-content-md-center">';
                echo'<main class="col-md-10">';
                
                echo'<br>';
                echo'<div class="profile">';
                echo'<table id="idVUTabla" class="table center">';
                echo'<thead>';

                echo'<tr>';
                
                echo'<th>ID</th>';
                echo'<th class="item-1">Imagen</th>';
                echo'<th>Nombre del Producto</th>';
                echo'<th>Precio del Producto</th>';
                echo'<th>Solicitudes</th>';

                echo'</tr>';

                echo'<tbody>';

                while ($row = $ProductosCreados->fetch_assoc()) {
                    $product_id = $row['producto_id'];
                    $product_img = $row['producto_img'];
                    $product_name = $row['producto_name'];
                    $product_price = $row['producto_price'];

                    echo '<tr>';

                    echo '<th scope="row">'.$product_id.'</th>';

                    echo '<td><img src="data:image/jpeg;base64,'.$product_img.'" alt="product_img"></td>';

                    echo '<td>'.$product_name.'</td>';

                    echo '<td>$'.$product_price.'.00 MXN</td>';

                    echo '<td>';

                    echo '<input type="hidden" name="IDProducto" 
                          id="IDProducto" value="'.$product_id.'">';

                    echo '<a href="editproduct.php?product_id=' . $product_id . '" 
                          class="btn btn-warning">Editar</a>';

                    echo '&nbsp;';

                    echo '<a href="eliminarproducto.php?product_id=' . $product_id . '" 
                          class="btn btn-danger">Eliminar</a>';

                    echo '</td>';

                    echo '</tr>';
                }

                echo'</tbody>';

                echo'</thead>';
                echo'</table>';
                echo'</div>';
                echo'</main>';
                echo'</div>';
            ?>
            </div>
        <!-- </main> -->
    </div>

        <!-- FOOTER -->
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>

        <script>
    setTimeout(function () {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 6000);

    setTimeout(function () {
        var successMessage = document.getElementById('dangerMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 6000);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>