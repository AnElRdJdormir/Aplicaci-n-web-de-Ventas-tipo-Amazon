<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_listaproductos.php');
$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];
$usuario_priv = $_SESSION['usuario_priv'];

if (isset($_GET['lista_id'])) {
    $lista_id = $_GET['lista_id'];
} else {
    echo "Error: No se proporcionó el ID de la lista.";
}

$listaprod = $ShowListaProductos->MostrarListaProductos($lista_id, $usuario_id);
$total = 0;
$cantiTotal = 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figure Out! | Lista de Deseos</title>
    <link rel="shortcut icon" href="images/PackathonLogo.png">
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/wishlistDesign.css" />
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

        <div id="idLDSubtitulos" class="row">
            <label class="text">Lista de Deseos (Propio)</label>
        </div>
<main class="container-fluid">
    <!-- Título de la lista de deseos -->
    
    <form id="agregarCarritoForm" class="row" method="post" action="agregarcarritolista.php">
        <div id="idWLProductos" class="col-8 overflow-auto">
            <?php
                while ($row = $listaprod->fetch_assoc()) {

                    $listaprod_id = $row['listaprod_id'];
                    $listaprod_productoid = $row['listaprod_productoid'];
                    $listaprod_listaid = $row['listaprod_list'];
                    $listaprod_cantidad = $row['listaprod_cantidad'];

                    $listaprod_prodname = $row['producto_name'];
                    $listaprod_prodesc = $row['producto_desc'];
                    $listaprod_prodimg = $row['producto_img'];
                    $listaprod_prodprice = $row['producto_price'];

                    $itemTotal = $row['listaprod_cantidad'] * $row['producto_price'];
                    $total += $itemTotal;

                    $cantidad = $row['listaprod_cantidad'];
                    $cantiTotal += $cantidad;

                    echo '<div class="row">';

                    echo '<div class="col-3">';
                    echo '<img id="idWLFoto" src="data:image/jpeg;base64,' . $listaprod_prodimg . '" class="img-fluid" alt="ListaImagen">';
                    echo '</div>';
                    
                    echo '<div id="idWLInfo" class="col-3">';
                    echo '<h5>' . $listaprod_prodname . '</h5>';
                    echo '<p class="text-muted">' . $listaprod_prodesc . '</p>';
                    echo '</div>';

                    echo '<div id="idWLInfo" class="col-2 info">';
                    echo '<label class="item-1">Cantidad: </label>&nbsp;<label>' . $listaprod_cantidad . '</label>';
                    echo '</div>';
                    
                    echo '<div id="idWLInfo" class="col info text-right">';
                    echo '<label class="item-1">Precio: </label>&nbsp;<label> $' . $itemTotal . '.00 MXN</label>';
                    echo '</div>';
                    echo '</div>';

                    echo '<input type="hidden" name="listaprod_id[]" value="' . $listaprod_id . '">';
                    echo '<input type="hidden" name="listaprod_productoid[]" value="' . $listaprod_productoid . '">';
                    echo '<input type="hidden" name="listaprod_prodprice[]" value="' . $listaprod_prodprice . '">';
                    echo '<input type="hidden" name="listaprod_cantidad[]" value="' . $listaprod_cantidad . '">';
                }
            ?>
        </div>

        <div id="idWLPrecio" class="col">
            <div class="row border-bottom cantidad">
                <div class="col">
                    <label class="item-1">Total de artículos:</label>
                </div>
                <div class="col-7">
                    <label for=""><?php echo number_format($cantiTotal); ?> artículo(s)</label>
                </div>
            </div>
            <div class="total text-right">
                <div class="col">
                    <label class="item-1">Total: </label>
                </div>
                <div class="col-7">
                    <label>$ <?php echo number_format($total, 2); ?> MXN</label>
                </div>
            </div>
            <div class="row carrito">
                <button id="btnWLCarrito" type="submit" class="btn btn-primary">
                    <img src="Images/CarritoW.png" width="22px"/>&nbsp;Agregar al Carrito
                </button>
            </div>
        </div>
    </form>
    
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

</html>
