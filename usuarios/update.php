<?php

// Incluye el archivo de configuración para acceder a la base de datos y variables del sistema.
include('../app/config.php');

// Incluye los datos del usuario en sesión, para asegurar que esté autenticado y cargar su información.
include('../layout/admin/datos_usuario_sesion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
        <!-- Incluye la sección de 'head', que puede contener estilos, scripts y metadatos comunes -->
    <?php include('../layout/admin/head.php'); ?>
    
    <body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Incluye el menú de navegación del administrador -->
    <?php include('../layout/admin/menu.php'); ?>
    <div class="content-wrapper">
        <br>
        <div class="container">

            <?php
            // Obtiene el ID del usuario a editar a partir de los parámetros GET.
            $id_get = $_GET['id'];

            // Prepara una consulta para obtener los datos del usuario con el ID especificado y que esté activo (estado = '1').
            $query_usuario = $pdo->prepare("SELECT * FROM tb_usuarios WHERE id = '$id_get' AND estado = '1' ");
            // Ejecuta la consulta preparada.
            $query_usuario->execute();

            // Obtiene los resultados de la consulta y los almacena en un array.
            $usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);

            // Itera sobre los resultados obtenidos (aunque se espera un solo usuario).
            foreach($usuarios as $usuario) {
                // Asigna los valores de los campos del usuario a variables locales.
                $id = $usuario['id'];
                $nombres = $usuario['nombres'];
                $email = $usuario['email'];
                $password_user = $usuario['password_user'];
            }
            ?>

            <h2>Actualización del Usuario</h2>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                        <!-- Muestra un formulario para editar los datos del usuario -->
                        <div class="card card-success" style="border: 1px solid #777777">
                            <div class="card-header">
                                <h3 class="card-title">Edición del Usuario</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nombres</label>
                                    <!-- Campo de entrada para los nombres del usuario -->
                                    <input type="text" class="form-control" id="nombres" value="<?php echo $nombres;?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <!-- Campo de entrada para el email del usuario -->
                                    <input type="email" class="form-control" id="email" value="<?php echo $email;?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <!-- Campo de entrada para la contraseña del usuario -->
                                    <input type="text" class="form-control" id="password_user" value="<?php echo $password_user;?>">
                                </div>
                                <div class="form-group">
                                    <!-- Botón para actualizar los datos del usuario -->
                                    <button class="btn btn-success" id="btn_editar">Actualizar</button>
                                    <!-- Botón para cancelar y regresar a la lista de usuarios -->
                                    <a href="<?php echo $URL;?>/usuarios/" class="btn btn-default">Cancelar</a>
                                </div>
                                <!-- Aquí se mostrarán los mensajes de respuesta de la operación -->
                                <div id="respuesta"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>

        </div>

    </div>
    <!-- Incluye el pie de página del administrador -->
    <?php include('../layout/admin/footer.php'); ?>
</div>
<!-- Incluye scripts adicionales para el funcionamiento de la página -->
<?php include('../layout/admin/footer_link.php'); ?>
</body>
</html>


<script>
    // Evento que se dispara al hacer clic en el botón de actualizar.
    $('#btn_editar').click(function () {
        // Obtiene los valores de los campos del formulario.
        var nombres = $('#nombres').val();
        var email = $('#email').val();
        var password_user = $('#password_user').val();
        // Obtiene el ID del usuario desde los parámetros GET.
        var id_user = '<?php echo $id_get = $_GET['id'];?>';

        // Verifica que los campos no estén vacíos antes de enviar la solicitud.
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
            // Si todos los campos están completos, envía una solicitud GET a 'controller_update.php' con los datos.
            var url = 'controller_update.php';
            $.get(url, {
                nombres: nombres,
                email: email,
                password_user: password_user,
                id_user: id_user
            }, function (datos) {
                // Muestra la respuesta del servidor en el elemento con id 'respuesta'.
                $('#respuesta').html(datos);
            });
        }
    });
</script>