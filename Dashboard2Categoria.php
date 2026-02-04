<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_productos.php');
$usuario_type= $_SESSION['usuario_type'];


if (isset($_GET['categoryid'])) {
    $category_id = $_GET['categoryid'];
    $productcat = $ShowProduct->MostrarProductoCategorias($category_id);
} else {
    echo "Error: No se proporcionó el ID del producto.";
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Figure Out! | Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/DashboardDesign.css">
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
                <form class="nav-search" action="Dashboard2Busqueda.php" method="get">
               <input class="form-control" type="search" placeholder="Buscar productos" aria-label="Search" name="search_term">
               <button class="btn btn-primary" type="submit">Buscar</button>
           </form>

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
    <div class="container-fluid">
            <div class="row align-items-start">
                <div class="container">
                <h2>Productos de la Categoría Seleccionada</h2>
                <br><br>
                <div id="idDProductoContainer" class="col container">
                <?php 
                 while ($row = $productcat->fetch_assoc()) {

                    $product_id = $row['producto_id'];
                    $product_img = $row['producto_img'];
                    $product_name = $row['producto_name'];
                    $product_price = $row['producto_price'];
                    $product_desc = $row ['producto_desc'];
                    $product_category = $row ['category'];
                    $product_categoryid = $row ['producto_category'];
                    $product_selltype = $row['producto_selltype'];
                    echo'<div class="col-md-4">';
                    echo'<div class="card mb-4">';
                    echo'<img src="data:image/jpeg;base64,'.$product_img.'" alt="Producto" 
                         style="width: 320px; height: 320px;">';
                    echo'<div class="card-body">';
                    echo'<h5 class="card-title">'.$product_name.'</h5>';
                    echo'<p class="card-text">'.$product_desc.'</p>';
                    if ($product_selltype == "Venta") {

                        echo'<p class="card-price">$'.$product_price.'</p>';

                        echo'<p class="card-category">
                        Categoría: <a href ="Dashboard2Categoria.php?categoryid=' .$product_categoryid. '"">
                        '.$product_category.'</a></p>';
                       
                        echo '<a href="product.php?product_id=' . $product_id . '" class="btn btn-primary">Ver detalles</a>';

                    } elseif ($product_selltype == "Cotizacion") {
                        
                        echo'<p class="card-price">$XX.XX</p>';
                        
                        echo'<p class="card-category">Categoría: 
                        <a href ="Dashboard2Categoria.php?categoryid=' .$product_categoryid. '"">
                        '.$product_category.'</a></p>';
                       
                        echo '<a href="commission.php?product_id=' . $product_id . '" class="btn btn-primary">Comisión</a>';
                    
                    }
                    echo'</div>';
                    echo'</div>';
                    echo '</div>';
                    }
                ?>
                </div>
                <br><br>
            </div>
        </div>
    </div>
                    
                    <nav id="idUPPaginacion1" aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link prev-next" href="#" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Anterior</span>
                            </a>
                          </li>
                          <li class="page-item"><a class="page-link active" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link prev-next" href="#" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Siguiente</span>
                            </a>
                          </li>
                        </ul>
                    </nav>
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
    </body>
</html>
