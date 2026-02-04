<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_listaproductosOtro.php');
$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];
$usuario_priv = $_SESSION['usuario_priv'];
$lista_id= $_SESSION['lista_id'];

if (isset($_GET['lista_id'])) {
    $lista_id = $_GET['lista_id'];
} else {
    echo "Error: No se proporcionó el ID de la lista.";
}

$listaprod = $ShowListaProductos->MostrarListaProductosOtros();
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Deseos</title>
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

        <!-- Título de la lista de deseos -->
        <div id="idLDSubtitulos" class="row">
            <label class="text">Lista de Deseos (Público)</label>
        </div>
<main class="container mt-4">
    
    <form id="agregarCarritoForm" method="post" action="agregarcarritolista.php">
    <?php
        while ($row = $listaprod->fetch_assoc()) {
                        
            $listaprod_usuarioid = $row['listaprod_usuarioid'];

            $listaprod_listaid = $row['listaprod_list'];  

            $lista_authorid=$row['lista_author'];

            $lista_desc= $row['lista_desc']; 
            $lista_img= $row['lista_imagen']; 
            $lista_estado=$row['lista_estado']; 
            $lista_nombre=$row['lista_nombre']; 
            if($lista_id == $listaprod_listaid)
            {
                echo' <div class="row mb-4">';
                echo'<div class="col-md-3">';
                echo'<h4>'.$lista_authorid.'</h4>';
                echo'<img src="data:image/jpeg;base64,'.$lista_img.'"
                class="img-thumbnail" alt="ListaImagen">';
                echo'</div>';
                echo'<div class="col-md-6">';
                echo'<br><br>';
                echo'<h4>'.$lista_nombre.'</h4>';
                echo'<p>'.$lista_desc.'</p>';
                if($lista_authorid == $listaprod_usuarioid)
                {
                    $listaprod_id = $row['listaprod_id'];

                    $listaprod_productoid = $row['listaprod_productoid'];
        
                    $listaprod_cantidad = $row['listaprod_cantidad'];
        
                    $listaprod_prodname = $row['producto_name'];
                    $listaprod_prodesc = $row['producto_desc'];
                    $listaprod_prodimg = $row['producto_img'];
                    $listaprod_prodprice = $row['producto_price'];
        
                    $itemTotal = $row['listaprod_cantidad'] * $row['producto_price'];
                    $total += $itemTotal;
        
                    echo '<div class="row mb-4">';
                    echo '<div class="col-md-3">';
                    echo '<img src="data:image/jpeg;base64,' . $listaprod_prodimg . '" class="img-thumbnail" alt="ListaImagen">';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<h4>' . $listaprod_prodname . '</h4>';
                    echo '<p>' . $listaprod_prodesc . '</p>';
                    echo '<p>Cantidad: ' . $listaprod_cantidad . '</p>';
                    echo '</div>';
                    echo '<div class="col-md-3 text-right">';
                    echo '<p>Precio: $' . $itemTotal . '</p>';
                    echo '</div>';
                    echo '</div>';
        
                    echo '<input type="hidden" name="listaprod_id[]" value="' . $listaprod_id . '">';
                    echo '<input type="hidden" name="listaprod_productoid[]" value="' . $listaprod_productoid . '">';
                    echo '<input type="hidden" name="listaprod_prodprice[]" value="' . $listaprod_prodprice . '">';
                    echo '<input type="hidden" name="listaprod_cantidad[]" value="' . $listaprod_cantidad . '">';
                }
            }
        }
        ?>
        <br><br>
        <div class="row mt-4">
            <div class="col-md-9">
                <h4>Total de la Lista de Deseos:</h4>
            </div>
            <div class="col-md-3 text-right">
                <p>Total: $<?php echo number_format($total, 2); ?></p>
                <button type="submit" class="btn btn-primary" >
                    <a href="ShoppingCart.php">Agregar al Carrito</a>
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
