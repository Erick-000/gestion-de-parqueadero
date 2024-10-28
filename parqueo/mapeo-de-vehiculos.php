<?php 
// Incluye el archivo de configuración para acceder a la base de datos y variables del sistema.
include('../app/config.php');

// Incluye los datos del usuario en sesión, para asegurar que esté autenticado y cargar su información.
include('../layout/admin/datos_usuario_sesion.php');    
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Incluye la sección 'head', que puede contener estilos, scripts y metadatos comunes para la página. -->
  <?php include('../layout/admin/head.php') ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Incluye el menú de navegación del administrador. -->
    <?php include('../layout/admin/menu.php') ?>

    <div class="content-wrapper">
        <div class="container">
            <h2>Listado de espacios</h2>
            <br>
            <!-- Tabla que muestra el listado de usuarios. -->
            <table class="table table-bordered table-sm table-striped">
                <th><center>Nro</center></th>
                <th>Nro espacios</th>
                <th><center>Acción</center></th>
                <?php
                // Inicializa un contador para numerar los usuarios.
                $contador = 0;

                // Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
                $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1'");
                
                // Ejecuta la consulta.
                $query_mapeos->execute();

                // Obtiene todos los resultados de la consulta y los almacena en un array.
                $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);

                // Itera sobre cada usuario obtenido de la base de datos.
                foreach ($mapeos as $mapeo) {
                    // Extrae los datos de cada usuario.
                    $id_map = $mapeo['id_map'];
                    $nro_espacio = $mapeo['nro_espacio'];

                    // Incrementa el contador para mostrar el número de cada usuario.
                    $contador = $contador + 1;
                ?>
                
                <!-- Muestra los datos de cada usuario en una fila de la tabla. -->
                <tr>
                    <td><center><?php echo $contador; ?></center></td>
                    <td><?php echo $nro_espacio; ?></td>
                    <td>
                        <center>
                            <!-- Enlace para eliminar el usuario, redirige a 'delete.php' con el ID del usuario. -->
                            <a href="delete.php?id=<?php echo $id_rol ?>" class="btn btn-danger">Eliminar</a>
                        </center>
                    </td>
                </tr>

                <?php
                }
                ?>
            </table>
        </div>
    </div>

    <!-- Incluye el pie de página del administrador. -->
    <?php include('../layout/admin/footer.php') ?>
</div>
<!-- Incluye scripts adicionales para el funcionamiento de la página. -->
<?php include('../layout/admin/footer_link.php') ?>
</body>
</html>
