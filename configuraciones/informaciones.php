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
            <h2>Listado de Informaciones</h2>
            <br>

            <a  href="create_informaciones.php" class="btn btn-primary"> Registrar nuevo </a> <br> <br>

            <!-- Tabla que muestra el listado de usuarios. -->
            <table class="table table-bordered table-sm table-striped">
                <th><center>Nro</center></th>
                <th>Nombre del parqueo </th>
                <th> Actividad de la Empresa</th>
                <th> Sucursal </th>
                <th> Dirección </th>
                <th> Teléfono </th>
                <th> Departamento o ciudad </th>
                <th> País </th>
                <th><center>Acción</center></th>
                <?php
                // Inicializa un contador para numerar los usuarios.
                $contador = 0;

                // Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
                $query_informaciones = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1'");
                
                // Ejecuta la consulta.
                $query_informaciones->execute();

                // Obtiene todos los resultados de la consulta y los almacena en un array.
                $informaciones = $query_informaciones->fetchAll(PDO::FETCH_ASSOC);

                // Itera sobre cada usuario obtenido de la base de datos.
                foreach ($informaciones as $informacion) {
                    // Extrae los datos de cada usuario.
                    $id_informacion = $informacion['id_informacion'];
                    $nombre_parqueo = $informacion['nombre_parqueo'];
                    $actividad_empresa = $informacion['actividad_empresa'];
                    $sucursal = $informacion['sucursal'];
                    $direccion = $informacion['direccion'];
                    $telefono = $informacion['telefono'];
                    $departamento_ciudad = $informacion['departamento_ciudad'];
                    $pais = $informacion['pais'];
                

                    // Incrementa el contador para mostrar el número de cada usuario.
                    $contador = $contador + 1;
                ?>
                
                <!-- Muestra los datos de cada usuario en una fila de la tabla. -->
                <tr>
                    <td><center><?php echo $contador; ?></center></td>
                    <td><?php echo $nombre_parqueo; ?></td>
                    <td><?php echo $actividad_empresa; ?></td>
                    <td><?php echo $sucursal; ?></td>
                    <td><?php echo $direccion; ?></td>
                    <td><?php echo $telefono; ?></td>
                    <td><?php echo $departamento_ciudad; ?></td>
                    <td><?php echo $pais; ?></td>
                    <td>
                        <center>
                            <!-- Enlace para editar el usuario, redirige a 'update.php' con el ID del usuario. -->
                            <a href="update_configuraciones.php?id=<?php echo $id_informacion; ?>" class="btn btn-success">Editar</a>
                            <!-- Enlace para eliminar el usuario, redirige a 'delete.php' con el ID del usuario. -->
                            <a href="delete_configuraciones.php?id=<?php echo $id_informacion; ?>" class="btn btn-danger">Eliminar</a>
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
