<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

// Inicia la sesión para poder trabajar con las variables de sesión.
session_start();

// Verifica si existe una sesión iniciada con la variable 'usuario_sesion'.
if (isset($_SESSION['usuario_sesion'])) {
    // Si la sesión está iniciada, la destruye para cerrar la sesión del usuario.
    session_destroy();
    
    // Redirige al usuario a la página de inicio, utilizando la URL base definida en la configuración.
    header("Location: " . $URL . "/");
}
