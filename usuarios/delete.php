<?php
// Incluye el archivo de configuración para la conexión a la base de datos y configuración general.
include('../app/config.php');

// Incluye el archivo que gestiona los datos del usuario en sesión, asegurando que el usuario esté autenticado.
include('../layout/admin/datos_usuario_sesion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Incluye la cabecera de la página, que puede contener estilos y scripts necesarios. -->
    <?php include('../layout/admin/head.php'); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Incluye el menú de navegación del administrador. -->
    <?php include('../layout/admin/menu.php'); ?>

    <div class="content-wrapper">
        <br>
        <div class="container">
            <?php
            // Obtiene el ID del usuario desde la URL a través del método GET.
            $id_get = $_GET['id'];

            // Prepara la consulta SQL para obtener los datos del usuario con el ID proporcionado, asegurando que esté activo (estado = '1').
            $query_usuario = $pdo->prepare("SELECT * FROM tb_usuarios WHERE id = '$id_get' AND estado = '1'");
            
            // Ejecuta la consulta.
            $query_usuario->execute();

            // Almacena todos los resultados de la consulta en un array asociativo.
            $usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);

            // Recorre los resultados obtenidos y guarda los datos del usuario en variables.
            foreach($usuarios as $usuario) {
                $id = $usuario['id'];
                $nombres = $usuario['nombres'];
                $email = $usuario['email'];
                $password_user = $usuario['password_user'];
            }
            ?>

            <h2>Eliminación del Usuario</h2>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Tarjeta para confirmar la eliminación del usuario. -->
                        <div class="card card-danger" style="border: 1px solid #777777">
                            <div class="card-header">
                                <h4 class="card-title">¿Estás seguro de eliminar este usuario?</h4>
                            </div>
                            <div class="card-body">
                                <!-- Muestra los datos del usuario, pero los campos están deshabilitados para evitar ediciones. -->
                                <div class="form-group">
                                    <label for="">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" value="<?php echo $nombres;?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $email;?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" id="password_user" value="<?php echo $password_user;?>" disabled>
                                </div>
                                <div class="form-group">
                                    <!-- Botón para confirmar la eliminación del usuario. -->
                                    <button class="btn btn-danger" id="btn_eliminar">Eliminar</button>
                                    <!-- Botón para cancelar la eliminación y volver a la lista de usuarios. -->
                                    <a href="<?php echo $URL;?>/usuarios/" class="btn btn-default">Cancelar</a>
                                </div>
                                <!-- Div para mostrar la respuesta de la petición de eliminación. -->
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
<!-- Incluye scripts adicionales necesarios para la página. -->
<?php include('../layout/admin/footer_link.php'); ?>
</body>
</html>

<script>
    // Evento que se activa al hacer clic en el botón de eliminar.
    $('#btn_eliminar').click(function () {
        // Obtiene los valores de los campos de nombre, email y password.
        var nombres = $('#nombres').val();
        var email = $('#email').val();
        var password_user = $('#password_user').val();
        // Obtiene el ID del usuario a eliminar.
        var id_user = '<?php echo $id_get = $_GET['id'];?>';

        // Valida que los campos no estén vacíos antes de proceder a eliminar.
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
            // Si todo está correcto, envía una petición GET al archivo 'controller_delete.php' con los datos del usuario para eliminarlo.
            var url = 'controller_delete.php';
            $.get(url, {nombres:nombres, email:email, password_user:password_user, id_user:id_user}, function (datos) {
                // Muestra la respuesta de la petición en el div con id 'respuesta'.
                $('#respuesta').html(datos);
            });
        }
    });
</script>
