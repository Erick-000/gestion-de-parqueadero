<?php
// Incluimos el archivo de configuración 
include('app/config.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Document</title>
</head>

<body style="background-image: url('public/images/piso.jpg');
    background-repeat:repeat;
    z-index: -3;
    background-size: 100vw 100vh">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="./public/images/oasispark.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            OasisPark
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"> Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"> Sobre nosotros </a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Promociones
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Mensual</a>
                        <a class="dropdown-item" href="#">Dias</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"> Fichas </a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"> Contactanos </a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </nav>


    <br>
    <div class="container">
        <div class="card-body" style="display: block;">
            <div class="row">

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
                    $estado_espacio = $mapeo['estado_espacio'];

                    if ($estado_espacio == "LIBRE") { ?>
                        <div class="col">
                            <center>
                                <h2><?php echo $nro_espacio; ?></h2>
                                <button class="btn btn-success" style="width: 100%;height: 114px">
                                    <p><?php echo $estado_espacio; ?></p>
                                </button>
                            </center>
                        </div>
                    <?php
                    }

                    if ($estado_espacio == "OCUPADO") { ?>
                        <div class="col">
                            <center>
                                <h2><?php echo $nro_espacio; ?></h2>
                                <button class="btn btn-danger">
                                    <img src="<?php $URL; ?>./public/images/auto1.png" width="60px" alt="">
                                </button>
                                <p><?php echo $estado_espacio; ?></p>
                            </center>
                        </div>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </div>
        </div>
    </div>



    <!-- Scripts necesarios para el funcionamiento de Bootstrap y jQuery -->
    <script src="public/js/jquery-3.7.1.min.js"></script>
    <script src="public/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>

<!-- Modal para el inicio de sesión -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inicio de Sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""> Usuario/Email </label>
                            <input type="email" id="usuario" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""> contraseña </label>
                            <input type="password" id="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div id="respuesta">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
                <button type="button" class="btn btn-primary" id="btn_ingresar"> Ingresar </button>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar la lógica de inicio de sesión con AJAX -->
<script>
    // Al hacer clic en el botón de ingresar, se ejecuta la función login
    $('#btn_ingresar').click(function() {
        login();
    });

    // Al presionar la tecla "Enter" en el campo de contraseña, también se ejecuta la función login
    $('#password').keypress(function(e) {
        if (e.which == 13) {
            login();
        }
    });

    // Función que realiza el proceso de autenticación
    function login() {
        var usuario = $('#usuario').val(); // Obtiene el valor del campo usuario
        var password_user = $('#password').val(); // Obtiene el valor del campo contraseña

        // Validaciones para verificar si se ingresaron los datos requeridos
        if (usuario == "") {
            alert('Por favor ingrese su usuario');
            $('#usuario').focus();
        } else if (password_user == "") {
            alert('Por favor ingrese su contraseña');
            $('#password').focus();
        } else {
            // Envia los datos mediante AJAX a un controlador en el servidor
            var url = 'login/controller_login.php';
            $.post(url, {
                usuario: usuario,
                password_user: password_user
            }, function(datos) {
                $('#respuesta').html(datos); // Muestra la respuesta del servidor en el div "respuesta"
            });
        }
    }
</script>