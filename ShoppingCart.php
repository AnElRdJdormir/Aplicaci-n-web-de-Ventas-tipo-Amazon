<?php 
include ('mostrar_carrito.php');
$usuario_id = $_SESSION['usuario_id'];
$usuario_type= $_SESSION['usuario_type'];


$carrito = $ShowCarrito->MostrarCarrito($usuario_id);
$total = 0;
$cantiTotal = 0;

if (isset($_SESSION['success_message'])) {
    echo '<div id="successMessage" 
    class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Figure Out! | Carrito de compras</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/ShoppingCartDesign.css">
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
        <div id="idShCSubtitulos" class="row">
            <label class="text">Carrito de Compras</label>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div id="idShoppingCartProduct" class="col-8">

                    <?php
                        while ($row = $carrito->fetch_assoc()) {

                            $carritoproduct_id = $row['carproduct_id'];
                            $carproduct_productoid = $row['carproduct_productoid'];
                            $carproduct_carritoid = $row['carproduct_carritoid'];


                            $carproduct_precio = $row['carproduct_precio'];
                            $carproduct_cantidad = $row['carproduct_cantidad'];

                            $producto_name = $row['producto_name'];   
                            $producto_desc = $row['producto_desc'];
                            $producto_img = $row['producto_img'];

                            $itemTotal = $row['carproduct_subtotal'];
                            $total += $itemTotal;

                            $cantidad = $row['carproduct_cantidad'];
                            $cantiTotal += $cantidad;

                            echo '<div class="row">';

                            echo '<div class="col-3">';
                            echo '<img id="idWLFoto" src="data:image/jpeg;base64,' . $producto_img . '" class="img-fluid" alt="ListaImagen">';
                            echo '</div>';

                            echo '<div id="idWLInfo" class="col-3">';
                            echo '<h5>' . $producto_name . '</h5>';
                            echo '<p class="text-muted">' . $producto_desc . '</p>';
                            echo '</div>';

                            echo '<div id="idWLInfo" class="col info">';
                            echo '<label class="item-1">Cantidad: </label>&nbsp;<label>' . $carproduct_cantidad . '</label>';
                            echo '</div>';

                            echo '<div id="idWLInfo" class="col-2 info text-right">';
                            echo '<label class="item-1">Precio: </label>&nbsp;<label> $' . $itemTotal . '.00 MXN</label>';
                            echo '</div>';

                            echo '<div id="idWLInfo" class="col">';
                            echo '<a id="idSHEliminarProducto" href="eliminarproductocarrito.php?carritoproduct_id=' 
                                . $carritoproduct_id . '"  class="btn btn-primary">
                                    <img src="Images/BoteBasuraR.png" width="30px"/>
                                  </a>';
                            echo '</div>';

                            echo '</div>';

                        }
                    ?>
                </div>       

                <div id="idShoppingCart" class="col">
                    <div id="idShCDireccion" class="col">
                        <h4 class="card-title">Dirección de envío</h4>
                        <div class="row border-bottom">
                            <p class="card-subtitle mb-2 text-muted">Para obtener su Dirección de Envío haga click al botón</p>
                        </div>

                        <!-- Aquí se mostrará la dirección -->
                        <p id="direccionEnvioResultado"></p>
                        <button id="btnShCDireccion" class="btn btn-primary" onclick="obtenerUbicacion()">Obtener Dirección</button>
                    </div>

                    <div id="idShCTotal" class="col">
                        <div id="idShCTextoPrecio" class="row border-bottom">
                            <div class="col">
                                <label class="text item-1">Total de artículos</label>
                            </div>
                            <div class="col-7">
                                <label class="text"><?php echo number_format($cantiTotal); ?> artículo(s)</label>
                            </div>
                        </div>
                        <div id="idShCTextoPrecio" class="row">
                            <div class="col">
                                <label id="idShCTextoTotal" class="text item-1">Total</label>
                            </div>
                            <div class="col-7">
                                <label id="idShPrecioTotal" class="text">$<?php echo number_format($total, 2); ?> MXN</label>
                            </div>
                        </div>
                        <div id="idShCTextoPrecio" class="row">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
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
        
     
    <script>
    // Oculta el mensaje de éxito después de 15 segundos
    setTimeout(function () {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 6000);
    </script>
    

    <script>
  function obtenerUbicacion() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        obtenerDatosUbicacion(lat, lon);
      });
    } else {
      alert("La geolocalización no está soportada por tu navegador.");
    }
  }

  function obtenerDatosUbicacion(lat, lon) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        const ciudad = data.address.city || data.address.village || data.address.town;
        const estado = data.address.state;

        // Combina diferentes campos que pueden contener información sobre la calle
        const posiblesCalles = [
          data.address.road,
          data.address.street,
          data.address.suburb,
          data.address.neighbourhood
        ];

        // Filtra las calles que no son nulas ni indefinidas
        const callesValidas = posiblesCalles.filter(calle => calle != null && calle != undefined);

        // Usa la primera calle válida, o muestra un mensaje alternativo si no hay calles válidas
        const calle = callesValidas.length > 0 ? callesValidas[0] : "Calle no disponible";

        const pais = data.address.country;
        const codigoPostal = data.address.postcode || "Código postal no disponible";

        // Muestra la dirección obtenida en el párrafo específico
        const direccionTexto = `Ciudad: ${ciudad}, Estado: ${estado}, Calle: ${calle}, País: ${pais}, Código Postal: ${codigoPostal}`;
        document.getElementById('direccionEnvioResultado').innerHTML = direccionTexto;
      })
      .catch(error => {
        console.error("Error al obtener datos de ubicación:", error);
        // Muestra un mensaje de error en el párrafo específico
        document.getElementById('direccionEnvioResultado').innerHTML = "Error al obtener la dirección de envío.";
      });
  }
</script>

<script src="https://www.paypal.com/sdk/js?client-id=AZBMPJQPnbZQmBjS73bd8KF4PFq0nRFdMnrjg3U1dagAOZVuYX85ZG6pSEaJDghAMnPS5yExgcXBG2Ce&currency=MXN"></script>
<script>
  paypal.Buttons({
    style: {
      color: 'black',
      label: 'pay'
    },
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: <?php echo $total; ?> 
          }
        }]
      });
    },

    onApprove: function(data, actions){
        actions.order.capture().then(function (detalles){
            window.location.href="comprar.php"
        });
    },

    onCancel: function(data){
       alert("Pago cancelado")
    }

  }).render('#paypal-button-container');
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>




<!--
            <div class="row align-items-start">
                <div id="idShCProductoContainer" class="col">
                    <div id="idShCProducto" class="row">
                        <a class="icon-link col" href="#" class="col">
                            <img id="idShCFotoProducto" src="Images/Productos/Plush_Papyrus.jpg" >
                        </a>
    
                        <div id="idShCInfoProducto" class="col">
                            <a id="idShCNombreProducto" class="nav-link" href="#">Nombre del producto</a>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a id="idShCTag1Producto" class="nav-link" href="#">Tag 1</a>
                                </li>
                                <li class="list-inline-item">
                                    <label class="text">|</label>
                                </li>
                                <li class="list-inline-item">
                                    <a id="idShCTag2Producto" class="nav-link" href="#">Tag 2</a>
                                </li>
                            </ul>
                            <a id="idShCVendedorProducto" class="nav-link" href="#">Vendedor</a>
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <label id="idShCPrecioProducto" class="text">$0.00 MXN</label>
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <input id="idShCCantidadCarrito" type="number" step="1" max="10" min="1" value="1" name="quantity" class="quantity-field text-center item-1">
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <button id="btnShCQuitarProductoCarrito" type="button">
                                <img src="Images/BoteBasuraB.png" width="30px"/>
                            </button>
                        </div>
                    </div>
    
                    <div id="idShCProducto" class="row">
                        <a class="icon-link col" href="#" class="col">
                            <img id="idShCFotoProducto" src="Images/Productos/Figure_Killua.jpg" >
                        </a>
    
                        <div id="idShCInfoProducto" class="col">
                            <a id="idShCNombreProducto" class="nav-link" href="#">Nombre del producto</a>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a id="idShCTag1Producto" class="nav-link" href="#">Tag 1</a>
                                </li>
                                <li class="list-inline-item">
                                    <label class="text">|</label>
                                </li>
                                <li class="list-inline-item">
                                    <a id="idShCTag2Producto" class="nav-link" href="#">Tag 2</a>
                                </li>
                            </ul>
                            <a id="idShCVendedorProducto" class="nav-link" href="#">Vendedor</a>
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <label id="idShCPrecioProducto" class="text">$0.00 MXN</label>
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <input id="idShCCantidadCarrito" type="number" step="1" max="10" min="1" value="1" name="quantity" class="quantity-field text-center item-1">
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <button id="btnShCQuitarProductoCarrito" type="button">
                                <img src="Images/BoteBasuraB.png" width="30px"/>
                            </button>
                        </div>
                    </div>
    
                    <div id="idShCProducto" class="row">
                        <a class="icon-link col" href="#" class="col">
                            <img id="idShCFotoProducto" src="Images/Productos/Keychain_Sharon.png" >
                        </a>
    
                        <div id="idShCInfoProducto" class="col">
                            <a id="idShCNombreProducto" class="nav-link" href="#">Nombre del producto</a>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a id="idShCTag1Producto" class="nav-link" href="#">Tag 1</a>
                                </li>
                                <li class="list-inline-item">
                                    <label class="text">|</label>
                                </li>
                                <li class="list-inline-item">
                                    <a id="idShCTag2Producto" class="nav-link" href="#">Tag 2</a>
                                </li>
                            </ul>
                            <a id="idShCVendedorProducto" class="nav-link" href="#">Vendedor</a>
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <label id="idShCPrecioProducto" class="text">$0.00 MXN</label>
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <input id="idShCCantidadCarrito" type="number" step="1" max="10" min="1" value="1" name="quantity" class="quantity-field text-center item-1">
                        </div>
    
                        <div id="idShCInfoProducto" class="col">
                            <button id="btnShCQuitarProductoCarrito" type="button">
                                <img src="Images/BoteBasuraB.png" width="30px"/>
                            </button>
                        </div>
                    </div>
                </div>
-->