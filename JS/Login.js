$(document).ready(function(){
    $('#btnLogin').click(function(){
        var usuario = $('#txtLUserEmail').val();
        var contrasena = $('#txtLPassword').val();
        var correo = $('#txtLUserEmail').val();

        if(usuario == "" && correo == ""){
            alert("No se ha llenado el campo 'Nombre de Usuario o Correo', por favor escríbalo.");
            return false;
        }else if(contrasena == ""){
            alert("No se ha llenado el campo 'Contraseña', por favor escríbalo.");
            return false;
        }

        $.ajax({
            type: "post",
            url:"/login.php",
            data: {"username": usuario, "password": contrasena, 
            "email": correo, "foto": imagen},
            success: function(){
                alert("Usuario creado!");
                window.location.href='Dashboard2.html';
            },
            error: function(err) {
                console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
                alert("Error al crear usuario, intente de nuevo.");
            }
        });
    });
});