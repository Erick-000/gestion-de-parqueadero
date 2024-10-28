<?php
// Incluye el archivo de configuración que contiene la conexión a la base de datos y configuraciones generales.
include('../app/config.php');

// Incluye el archivo que gestiona la sesión del usuario administrador, asegurando que esté autenticado.
include('../layout/admin/datos_usuario_sesion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Incluye la cabecera de la página, donde se pueden definir estilos y scripts necesarios para el diseño. -->
    <?php include('../layout/admin/head.php'); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Incluye el menú de navegación del administrador. -->
    <?php include('../layout/admin/menu.php'); ?>
    
    <div class="content-wrapper">
        <br>
        <div class="container">

            <h2>Creación de un nuevo usuario</h2>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Tarjeta para la creación de un nuevo usuario. -->
                        <div class="card" style="border: 1px solid #606060">
                            <div class="card-header" style="background-color: #007bff; color: #ffffff;">
                                <h4>Nuevo Usuario</h4>
                            </div>
                            <div class="card-body">
                                <!-- Formulario para ingresar los datos del nuevo usuario. -->
                               <div class="form-group">
                                   <label for="">Nombres</label>
                                   <input type="text" class="form-control" id="nombres">
                               </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" id="password_user">
                                </div>
                                <div class="form-group">
                                    <!-- Botón para guardar los datos del nuevo usuario. -->
                                    <button class="btn btn-primary" id="btn_guardar">Guardar</button>
                                    <!-- Botón para cancelar la operación y volver a la lista de usuarios. -->
                                    <a href="<?php echo $URL;?>/usuarios/" class="btn btn-default">Cancelar</a>
                                </div>
                                <!-- Div donde se mostrará la respuesta de la operación de guardado. -->
                                <div id="respuesta"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>

        </div>

    </div>
    <!-- Incluye el pie de página del administrador. -->
    <?php include('../layout/admin/footer.php'); ?>
</div>
<!-- Incluye scripts adicionales que necesita la página. -->
<?php include('../layout/admin/footer_link.php'); ?>
</body>
</html>

<script>
    // Evento que se activa cuando se hace clic en el botón de guardar.
    $('#btn_guardar').click(function () {
        // Obtiene los valores de los campos de nombre, email y contraseña.
        var nombres = $('#nombres').val();
        var email = $('#email').val();
        var password_user = $('#password_user').val();

        // Validaciones para asegurar que los campos no estén vacíos antes de enviar los datos.
        if(nombres == ""){
            alert('Debe de llenar el campo nombres');
            $('#nombres').focus();
        } else if(email == ""){
            alert('Debe de llenar el campo de email');
            $('#email').focus();
        } else if(password_user == ""){
            alert('Debe de llenar el campo de password');
            $('#password_user').focus();
        } else {
            // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
            var url = 'controller_create.php';
            $.get(url, {nombres:nombres, email:email, password_user:password_user}, function (datos) {
                // Muestra la respuesta de la operación en el div con id 'respuesta'.
                $('#respuesta').html(datos);
            });
        }
    });
</script>
