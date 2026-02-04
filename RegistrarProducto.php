<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include ('mostrar_categoria.php');


$usuario_type= $_SESSION['usuario_type'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Figure Out! | Alta de producto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/bootstrap-tagsinput.css">
        <link rel="stylesheet" href="CSS/RegistroProducto.css">
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
        <div id="idAltaProducto" class="container-fluid">
            <form id="idForm" action="agregar_producto.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div id="idAPInfoContainer" class="col-5">
                        <div class="row">
                            <label id="idAPTitulo" class="text">Alta de producto</label>
                        </div>
            
                        <div id="idAPVendedor" class="row">
                            <ul class="d-flex flex-column">
                                <a class="icon-link" href="UserProfile.php">
                                    <li class="list-group-item">
                                        <img id="idUPAvatar" src="data:image/jpeg;base64,<?php echo $_SESSION['usuario_imagen'];?>" class="rounded-circle" alt="example placeholder">
                                    </li>
                                </a>
                                <a class="icon-link text-decoration-none" href="UserProfile.php">
                                    <li id="idAPNombreVendedor" class="list-group-item"><?php echo $_SESSION['usuario'];?></li>
                                </a>   
                            </ul>      
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <label id="idAPStep" class="text">Información del producto</label>
                                <div id="idAPInputs"  class="inputbox">
                                    <label for="">Nombre del Producto</label>
                                    <input type="text" id="nombre" name="nombre" required>
                                </div>
                                
                                <div id="idAPInputs" class="inputbox">
                                    <label for="">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="8"></textarea>
                                </div>
        
                                <div id="idAPCategoriasRB">
                                    <div>
                                        <label class="text">Categoría</label>
                                    </div>
                                    <select class="form-select" name="categoria" id="categoria" required>
                                        <?php
                                            while ($row = $Categorias->fetch_assoc()) {
                                                $category_name = $row['category'];
                                                $category_id = $row['category_id'];
                                            echo '<option value="'.$category_id.'">'.$category_name.'</option>';

                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="from-group">
                                    <label id="idLSubtitulos" for="selltype">Tipo de Venta del Producto</label>
                                    <select class="form-select" name="selltype" id="selltype" required>
                                        <option value="Venta">Venta</option>
                                        <option value="Cotizacion">Cotización</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div id="idAPInputs" class="inputbox price">
                                        <label id="idLSubtitulos" for="inlineFormInputGroup">Precio</label>
                                        <div class="input-group">
                                            <div class="input-group-text">MXN $</div>
                                            <input type="text" class="form-control" id="precio" name="precio" placeholder="00.00" required>
                                        </div>
                                    </div>
    
                                    <div id="idAPInputsStock">
                                        <label id="idLSubtitulos" for="">Stock</label>
                                        <input type="number" class="form-control" id="cantidad"  oninput="if(value==0)value='1';" name="cantidad" min="1" pattern="[1-9]\d*" required>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button id="btnAltadeProducto" type="submit">Subir Producto</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="idAPMultiContainer" class="col">
                        <div class="row">
                            <label id="idAPStep" class="text">Imágenes del producto
                                <label id="idAPStepInstruccion" class="text"> (Mínimo 3 imágenes)</label>
                            </label>
                        </div>

                        <div id="idAPMultiImgContainer" class="container">
                            <div id="idAPMultiImg" id="imagen" name="imagen">
                                <div class="d-flex justify-content-center">
                                    <img id="idAPImagen1" src="Images/ImagenProducto.png"
                                    class="img-fluid" alt="example placeholder"/>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div id="idAPImagenBtn" class="btn btn-primary btn-rounded">
                                        <label class="form-label m-1" for="btnAPImagen1">Imagen Principal del Producto</label>
                                        <input type="file" class="form-control" id="imagen" name="imagen" 
                                        accept="image/*" required
                                        onchange="cargarImagen(event, 'idAPImagen1')" >
                                    </div>
                                </div>
                            </div>

                            <div id="idAPMultiImg" id="imagen2" name="imagen2">
                                <div class="d-flex justify-content-center">
                                    <img id="idAPImagen2" src="Images/ImagenProducto.png"
                                    class="img-fluid" alt="example placeholder"/>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div id="idAPImagenBtn" class="btn btn-primary btn-rounded">
                                        <label class="form-label m-1" for="btnAPImagen2">Imagen Demostrativa No.2</label>
                                        <input type="file" class="form-control" id="imagen2" name="imagen2"
                                        accept="image/*" required
                                        onchange="cargarImagen(event, 'idAPImagen2')" >
                                    </div>
                                </div>
                            </div>

                            <div id="idAPMultiImg" id="imagen3" name="imagen3">
                                <div class="d-flex justify-content-center">
                                    <img id="idAPImagen3" src="Images/ImagenProducto.png"
                                    class="img-fluid" alt="example placeholder"/>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div id="idAPImagenBtn" class="btn btn-primary btn-rounded">
                                        <label class="form-label m-1" for="btnAPImagen3">Imagen Demostrativa No.3</label>
                                        <input type="file" class="form-control" id="imagen3" name="imagen3"
                                        accept="image/*" required
                                        onchange="cargarImagen(event, 'idAPImagen3')" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label id="idAPStep" class="text">Video(s) del producto
                                <label id="idAPStepInstruccion" class="text"> (Mínimo un video)</label>
                            </label>
                        </div>

                        <div id="idAPMultiVideoContainer" class="container">
                            <div>
                                <video id="vidProducto1" width="720" height="480" controls="controls">
                                    <source src="">
                                </video>
                            </div>
                            
                            <div class="form-group">
                                <div id="idAPVideoBtn" class="btn btn-primary btn-rounded">
                                    <label for="video">Video Promocional</label>
                                    <input type="file" class="form-control" id="video" name="video" 
                                    accept="video/*" required
                                    onchange="cargarVideo()" >
                                </div>
                            </div>

                            <!-- <div id="idAPAgregarVideo">
                                <button id="btnAPAgregarVideo" type="button">
                                    <div>
                                        <p>Añadir otro
                                            <br>
                                            video
                                        </p>
                                        <img src="Images/Mas.png" width="48px"/>
                                    </div>
                                </button>
                            </div> -->
                        </div>
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
    </div>
 
        <!-- FOOTER -->
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="JS/AltaProducto.js"></script>
    </body>
    
</html>