<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('mostrar_chat.php');

$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];
$clients= $ShowChat->VerContactosCotizador($usuario_id);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Figure Out! | Tabla de cotizaciones</title>
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
        
        <?php  
    if($usuario_type =="2")
    {
        ?>
        <!-- CUERPO -->
        <div id="idUPSubtitulos" class="row">
            <label>Cotizaciones</label>
        </div>

        <div class="row justify-content-md-center">
            <main class="col-md-10">
                <br>
                <div class="profile">
                    <table id="idVUTabla" class="table">
                        <thead>
                            <tr>
                                <th class="item-1">Foto de Perfil</th>
                                <th>Usuario</th>
                                <th>Contacto</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                            while ($row = $clients->fetch_assoc()) {

                                $contacto_id=$row['contacto_id'];
                                $cliente_id=$row['contacto_usuario2'];
                                $cliente_producto=$row['contacto_producto'];
                                $cliente_nombre=$row['usuario'];
                                $cliente_img=$row['usuario_imagen'];
                                
                                $cotizacionesDisponibles = $ShowChat->CotizacionesCreadas($contacto_id)->num_rows;
                                
                                
                                if ($cotizacionesDisponibles == 0) {
                                    echo'<tr>';

                                    echo'<td class="imageSeller"><img src="data:image/jpeg;base64,'.$cliente_img.'"
                                    alt="product_img" class="img-fluid rounded-circle"></td>';

                                    echo'<td>'.$cliente_nombre.'</td>';

                                    echo'<td>No. de contacto : '.$contacto_id.'</td>';

                                    echo'<td>';

                                    echo'<input type="hidden" name="producto_id" 
                                    id="producto_id" value="product_id">';

                                    
                                    echo'<a href="ChatComp.php?producto_autorid=' 
                                        . $cliente_id . '&producto_id=' . $cliente_producto . '&contacto_id='.$contacto_id.'" 
                                        type="submit" name="chat" 
                                        class="btn btn-success chatSeller">Chat</a>';
                                        echo'&nbsp;';

                                        echo '<a href="crearcotizacion.php?producto_id=' . $cliente_producto . '&contacto_id=' . $contacto_id . '" 
                                        type="submit" name="producto" class="btn btn-warning chatBuyer">Producto</a>';
                                        

                                    echo'</td>';

                                    echo'</tr>';     
                                        } 
                                }
                                    ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
        
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>

