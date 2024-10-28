<?php 

    // Incluye el archivo de configuración que contiene la conexión a la base de datos.
    include('../app/config.php');

    // Inicia la sesión para poder trabajar con variables de sesión.
    session_start();

    // Recibe los datos enviados desde el formulario de login.
    $usuario_user = $_POST['usuario'];
    $password_user = $_POST['password_user'];

    // Variables para almacenar temporalmente los valores de email y password desde la base de datos.
    $email_tabla = ''; 
    $password_tabla = '';

    // Prepara una consulta SQL para seleccionar al usuario que coincide con el email y la contraseña proporcionados, y que tenga el estado activo (1).
    $query_login = $pdo->prepare("SELECT * FROM tb_usuarios WHERE email = '$usuario_user' AND password_user = '$password_user' AND estado = 1 ");
    $query_login->execute(); // Ejecuta la consulta.
    $usuarios = $query_login->fetchAll(PDO::FETCH_ASSOC); // Obtiene los resultados de la consulta.

    // Recorre los resultados obtenidos y almacena los valores de email y contraseña de la base de datos en las variables.
    foreach($usuarios as $usuario){
         $email_tabla = $usuario['email'];
         $password_tabla = $usuario['password_user'];
    }

    // Verifica si el email y la contraseña proporcionados coinciden con los datos de la base de datos.
    if(($usuario_user == $email_tabla) && ($password_user == $password_tabla) ){
        ?>
        <!-- Si los datos son correctos, muestra un mensaje de éxito -->
        <div class="alert alert-success" role="alert">
            Datos de inicio de sesión correctos
        </div>
        <!-- Redirige al usuario a la página principal -->
        <script> location.href = "principal.php" </script>
        <?php
        // Guarda el email del usuario en la variable de sesión para mantener la sesión activa.
        $_SESSION['usuario_sesion'] = $email_tabla;
        
    } else {
        ?>
        <!-- Si los datos son incorrectos, muestra un mensaje de error -->
        <div class="alert alert-danger" role="alert">
            Usuario o contraseña incorrectos
        </div>
        <!-- Limpia el campo de contraseña y enfoca el cursor en él para facilitar la corrección del error -->
        <script> $('#password').val("");$('#password').focus(); </script>
        <?php
    }

   // Código comentado que parece ser una prueba manual de verificación de email.
   // if( $usuario == "erickmanuel238@gmail.com"){
        ?>
       <!--
       <div class="alert alert-success" role="alert">
            Usuario correcto
        </div>  
       -->
        <?php
   // } else {
        ?>
       <!--
       <div class="alert alert-danger" role="alert">
            Usuario incorrecto
        </div>  
       -->
        <?php
   // }

?>
