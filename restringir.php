<?php
session_start();

function verificarRol($rolPermitido) {
    // Verificar si el usuario ha iniciado sesión y tiene el rol permitido
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $rolPermitido) {
        // Si el usuario no tiene permiso, redirigirlo a la página de inicio de sesión o a otra página adecuada
        header("Location: Login.html"); // Puedes cambiar esto según tus necesidades
        exit();
    }
}

// Ejemplo de uso:
// En la parte superior de cada página donde quieras restringir el acceso, puedes llamar a esta función con el rol permitido

// Para administradores
verificarRol('administrador');

// Para vendedores
verificarRol('vendedor');

// Y así sucesivamente para otros roles según tus necesidades
?>
