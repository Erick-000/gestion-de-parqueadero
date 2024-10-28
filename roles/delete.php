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

            <h2>Eliminación de roles</h2>

            <?php
                $id_rol = $_GET['id'];

                // Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
                $query_roles = $pdo->prepare("SELECT * FROM tb_roles WHERE id_rol = '$id_rol' AND estado = '1'");
                
                // Ejecuta la consulta.
                $query_roles->execute();

                // Obtiene todos los resultados de la consulta y los almacena en un array.
                $roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);

                // Itera sobre cada usuario obtenido de la base de datos.
                foreach ($roles as $role) {
                    // Extrae los datos de cada usuario.
                    $id_rol = $role['id_rol'];
                    $nombre = $role['nombre'];
                }
                ?>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Tarjeta para la creación de un nuevo usuario. -->
                        <div class="card" style="border: 1px solid #606060">
                            <div class="card-header" style="background-color: #d92005; color: #ffffff;">
                                <h4>¿Estas seguro de eliminar el rol?</h4>
                            </div>
                            <div class="card-body">
                                <!-- Formulario para ingresar los datos del nuevo usuario. -->
                               <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" class="form-control" id="nombre" value="<?php echo $nombre; ?>" disabled >
                               </div>
                                <div class="form-group">
                                    <!-- Botón para guardar los datos del nuevo usuario. -->
                                    <button class="btn btn-danger" id="btn_eliminar">Eliminar</button>
                                    <!-- Botón para cancelar la operación y volver a la lista de usuarios. -->
                                    <a href="<?php echo $URL;?>/roles/" class="btn btn-default">Cancelar</a>
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
    $('#btn_eliminar').click(function () {
        // Obtiene los valores de los campos de nombre.
        var id_rol = '<?php echo $id_rol; ?>';4
            // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
            var url = 'controller_delete.php';
            $.get(url, {id_rol:id_rol}, function (datos) {
                // Muestra la respuesta de la operación en el div con id 'respuesta'.
                $('#respuesta').html(datos);
            });
        }
    );
</script>
