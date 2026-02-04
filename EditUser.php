<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario_type= $_SESSION['usuario_type'];
$fechaCreacion =   $_SESSION['usuario_create'];
$usuario_gen = $_SESSION['usuario_gen'];
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
        <title>Figure Out! | Editar usuario</title>
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
        <div id="idEditUser" class="form-box form-value container-fluid">
            <form action="editarcuenta.php" id="accountEdit" name="accountEdit" method="post" enctype="multipart/form-data">
                <div class="row">
                    <label id="idEUTitulo" class="text">Editar Usuario</label>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div id="idEUAvatar">
                            <div class="d-flex justify-content-center">
                                <!-- <img id="idEUAvatarSample" src="Images/AvatarGris.png"
                                class="rounded-circle"alt="example placeholder"/> -->
                                <img id="idEUAvatarSample" src="data:image/jpeg;base64,<?php echo $_SESSION['usuario_imagen'];?>"
                                class="rounded-circle"alt="example placeholder"/>
                            </div>

                            <div class="d-flex justify-content-center" id="edit_imagen" name="edit_imagen" accept="image/*">
                                <div id="idEUAvatarBtn" class="btn btn-primary btn-rounded">
                                    <label for="formFile" class="form-label m-1">Selecciona una imagen de perfil</label>
                                    <input class="form-control" type="file" id="formFile" id="edit_imagen" name="edit_imagen" accept="image/*"
                                    onchange="mostrarAvatar(event, 'idEUAvatarSample')">
                                </div>
                            </div>
                        </div>

                        <div id="idEUText">
                            <label class="text rol">Rol Usuario</label>
                        </div>
                        
                        <select class="form-select" id="edit_ustype" name="edit_ustype">
                            <option class="item-1" selected>Selecciona un rol</option>

                            <?php
                                if($usuario_type == "1"){
                                    echo'<option id="dropdown" value="1">Comprador</option>';
                                }
                                ?>

                                <?php
                                if($usuario_type == "2"){
                                    echo'<option id="dropdown"  value="2">Vendedor</option>';
                                }
                                ?>
                                
                                <?php
                                if($usuario_type == "3"){
                                    echo'<option id="dropdown"  value="3">Administrador</option>';
                                }
                            ?>
                        </select>

                        <select id="edit_Priv" name="edit_Priv" class="form-select" aria-label="Default select example">
                            <option class="item-1" selected>Privacidad de su Cuenta</option>
                            <option id="dropdown" value="1">Publica</option>
                            <option id="dropdown"  value="2">Privada</option>
                        </select>
                    </div>

                    <div class="col">
                        <div id="idEUInputs" class="inputbox">
                            <label>Nombre Completo</label>
                            <input type="text" id="edit_name" name="edit_name" value="<?php echo $_SESSION['usuario_name'];?>">
                        </div>
                        
                        <div id="idEUInputs" class="inputbox">
                            <label>Nombre de Usuario</label>
                            <input type="text" id="edit_user" name="edit_user" value="<?php echo $_SESSION['usuario'];?>">
                                <small id="idEUInfo" class="form-text text-muted">
                                    Debe contener un mínimo de 3 carácteres.
                                </small>
                        </div>

                        <div id="idEUInputs" class="inputbox item item-1">
                            <label>Correo Electronico</label>
                            <input type="email" id="edit_mail" name="edit_mail" value="<?php echo $_SESSION['usuario_email'];?>">
                        </div>

                        <div id="idEUInputs" class="inputbox">
                            <label>Contraseña</label>
                            <input type="password" id="edit_password" name="edit_password" value="<?php echo $_SESSION['usuario_password'];?>">
                                <small id="idEUInfo" class="form-text text-muted">
                                    Debe contener un mínimo de 8 carácteres, una mayúscula, una
                                    minúscula, un número y un carácter especial.
                                </small>
                        </div>

                        <br>
                        <br>

                        <div id="idEURB" name="idEURB">
                            <label class="text">Género</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"
                                <?php
                                    if($usuario_gen == "option1"){
                                        echo 'checked';
                                    }
                                ?>
                                >
                                <label class="form-check-label" for="inlineRadio1">Hombre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"
                                <?php
                                    if($usuario_gen == "option2"){
                                        echo 'checked';
                                    }
                                ?>
                                >
                                <label class="form-check-label" for="inlineRadio1">Mujer</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" 
                                <?php
                                    if($usuario_gen == "option3"){
                                        echo 'checked';
                                    }
                                ?>
                                >
                                <label class="form-check-label" for="inlineRadio1">No binario</label>
                            </div>
                        </div>

                        <div id="idEUText">
                            <label class="form-label mt-4">Fecha de Nacimiento</label>
                        </div>
                        <input type="date" class="form-control" id="edit_birth" name="edit_birth" placeholder="21/11/2003" value="<?php echo $fechabirth;?>"> 

                        <div class="row">
                            <div id="idEUBtns2" class="d-flex justify-content-between">
                                <button id="btnEU" type="submit">Confirmar cambios</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-7">
                        <a id="idCLBtns" class="nav-link d-flex justify-content-between" href="UserProfile.php">
                            <button id="btnCL" type="button">Volver al perfil del usuario</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
        <script src="JS/bootstrap.min.js"></script>
        <script src="JS/Register.js"></script>
    </body>
</html>