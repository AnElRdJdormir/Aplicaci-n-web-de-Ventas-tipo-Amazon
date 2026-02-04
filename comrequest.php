<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('mostrar_chat.php');

$usuario_id = $_SESSION['usuario_id'];

$clients= $ShowChat->VerContactosCotizador($usuario_id);

$usuario_type= $_SESSION['usuario_type'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta de Usuario</title>
    <link rel="shortcut icon" href="images/PackathonLogo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/authorizeproductstyle.css" />
</head>

<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="images/PackathonLight.png" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

        <form class="nav-search" action="busqueda.php" method="get">
               <input class="form-control" type="search" placeholder="Buscar productos" aria-label="Search" name="search_term">
               <button class="btn btn-primary" type="submit">Buscar</button>
           </form>
            <div class="navbar-buttons">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link btn-nav" href="main.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-nav" href="listas.php">Listas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-nav" href="shopcar.php">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-nav" href="account.php">Mi cuenta</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    
    <div class="row">
        <aside class="col-md-2 sidebar">
            <h1>Mi Menú</h1>
            <ul>
            <li><a href="account.php">Perfil de Usuario</a></li>
                <?php 
                if($usuario_type =="Administrador" ||$usuario_type =="Cotizador" ){
                echo'<li><a href="addprod.php">Agregar Productos</a></li>';
                echo'<li><a href="products.php">Productos</a></li>';
                }
                ?>
                
                <?php 
                if($usuario_type =="Administrador"){
                echo'<li><a href="authorizeproduct.php">Autorizar Productos</a></li>';
                }
                ?>

                <?php
                 if($usuario_type =="Administrador" ||$usuario_type =="Cotizador" ){
                   echo'<li><a href="addcategory.php">Crear Categoría</a></li>';
                 }
                ?>
                <li><a href="comclient.php">Chat de Cotizaciones</a></li>
                <?php
                 if($usuario_type =="Cotizador" ){
                  echo'<li class="active"><a href="comrequest.php">Cotizaciones (Cotizador)</a></li>';
                 }
                ?>
                <li><a href="history.php">Historial de Pedidos</a></li>
                <?php
                 if($usuario_type =="Cotizador" ){
                    echo'<li><a href="sellings.php">Consulta de Ventas</a></li>';
                 }
                ?>

                <li><a href="login.html">Cerrar Sesión</a></li>
            </ul>
        </aside>
        <main class="col-md-10 content">
            <h1 class="profile-heading">Cotizaciones</h1>
            <br>
            <div class="profile">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto de Perfil</th>
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

                               echo'<td><img src="data:image/jpeg;base64,'.$cliente_img.'"
                               alt="product_img" class="img-fluid rounded-circle"></td>';

                                echo'<td>'.$cliente_nombre.'</td>';

                                echo'<td>No. de contacto : '.$contacto_id.'</td>';

                                echo'<td>';

                                echo'<input type="hidden" name="IDProducto" 
                                id="IDProducto" value="product_id">';

                                
                                echo'<a href="comchat.php?producto_autorid=' 
                                      . $cliente_id . '&IDProducto=' . $cliente_producto . '&contacto_id='.$contacto_id.'" 
                                      type="submit" name="chat" 
                                      class="btn btn-success">Chat</a>';
                                      echo'&nbsp;';



                                          echo '<a href="crearcotizacion.php?IDProducto=' . $cliente_producto . '&contacto_id=' . $contacto_id . '" 
                                          type="submit" name="producto" class="btn btn-warning">Producto</a>';
                                      

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
</div>

    <br>
    <br>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container text-center">
            <p>&copy; 2023 Packathon</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>