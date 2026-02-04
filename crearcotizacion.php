<?php
include ('mostrar_chat.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];
$product_id = "";
$contacto_id = "";

if (isset($_GET['producto_id']) && isset($_GET['contacto_id'])) {

    $product_id = $_GET['producto_id'];
    $contacto_id = $_GET['contacto_id'];

    $product_dt = $ShowChat->MostrarProductoComision($product_id);

    if($product_dt){
  
        $product_id2 = $product_dt['producto_id'];
    
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

}
    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Deseos</title>
    <link rel="shortcut icon" href="images/PackathonLogo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/wishliststyle.css" />
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
        <!--CUERPO-->
    <main class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <br>
                <h4 class="text-center">Crear Precio de Cotización:<br> 
                <br><?php echo''.$product_name.'';?></h4>
                <br>
                <br>
                <form action="agregarcotizacion.php" method="POST" enctype="multipart/form-data" class="border rounded p-3">
                    
                    <p>Preció de la Cotización</p>
                    <p>⚠️Crear un precio hará que el usuario pueda 
                       comprar el producto⚠️
                    </p>
                    <br>
                    <span class="input-group-text" style="width: 5%; margin-left: 100px;">$</span>

                    <input type="number" class="form-control" id="precio" 
                    style="margin-top: -48px; margin-left: 150px; width:200px;" 
                     name="precio" step="0.01"  placeholder="$0.00" required>

                   
                    <input type="hidden" name="product_id" 
                    value="<?php echo $product_id; ?>">
                    <input type="hidden" name="contacto_id" 
                    value="<?php echo $contacto_id; ?>">

                    <br><br>
                    <button type="submit" class="btn btn-outline-primary d-block mx-auto">Crear Cotización</button>
                </form>
            </div>
        </div>
        <br><br>
    </main>
    <?php
    }
    else{
        echo'<button id="idTituloTienda" class="navbar-brand d-flex mr-auto" type="button">';
        echo '<img src="Images/Alto.jpg" width="1000px  text-align: center/>';
        echo'</button>';
    }
    ?> 
    <footer class="mt-5">
        <div class="container text-center">
            <p>&copy; 2023 Packathon</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
