<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../layout/admin/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../layout/admin/menu.php'); ?>
        <div class="content-wrapper">
            <br>
            <div class="container">

                <h2> Creación de nueva información</h2>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Registre los datos con mucho cuidado </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for=""> Nombre del parqueadero <span style="color:red" > <b>*</b> </span> </label>
                                        <input type="text" class="form-control" id="nombre_parqueo" style="text-transform: uppercase;" >
                                    </div>
                                    <div class="col-md-5">
                                        <label for=""> Actividad de la empresa <span style="color:red" > <b>*</b> </span> </label>
                                        <input type="text" class="form-control" id="actividad_empresa" style="text-transform: uppercase;" >
                                    </div>
                                    <div class="col-md-2">
                                        <label for=""> Sucursal <span style="color:red" > <b>*</b> </span> </label>
                                        <input type="text" class="form-control" id="sucursal" style="text-transform: uppercase;" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""> Dirección <span style="color:red" > <b>*</b> </span> </label>
                                        <input type="text" class="form-control" id="direccion" style="text-transform: uppercase;" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""> Teléfono <span style="color:red" > <b>*</b> </span> </label>
                                        <input type="text" class="form-control" id="telefono" style="text-transform: uppercase;" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""> Departamento o Ciudad <span style="color:red" > <b>*</b> </span> </label>
                                        <input type="text" class="form-control" id="departamento_ciudad" style="text-transform: uppercase;" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""> País <span style="color:red" > <b>*</b> </span> </label>
                                        <input type="text" class="form-control" id="pais" style="text-transform: uppercase;" >
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="informaciones.php" class="btn btn-default btn-block">Cancelar</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block" id="btn_registrar_informacion">
                                            Registrar
                                        </button>
                                    </div>
                                </div>

                                <div id="respuesta">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_link.php'); ?>
</body>

</html>

<script>
    // Evento que se activa cuando se hace clic en el botón de registrar.
    $('#btn_registrar_informacion').click(function() {

        var nombre_parqueo = $('#nombre_parqueo').val();
        var actividad_empresa = $('#actividad_empresa').val();
        var sucursal = $('#sucursal').val();
        var direccion = $('#direccion').val();
        var telefono = $('#telefono').val();
        var departamento_ciudad = $('#departamento_ciudad').val();
        var pais = $('#pais').val();

        // Validaciones para asegurar que los campos no estén vacíos antes de enviar los datos.
        if (nombre_parqueo == "") {
            alert('Debe de llenar el campo nombre del parqueo');
            $('#nombre_parqueo').focus();

        }else if (actividad_empresa == "") {
            alert('Debe de llenar el campo actividad de la empresa');
            $('#actividad_empresa').focus();
        
        }else if(sucursal == ""){
            alert('Debe de llenar el campo sucursal');
            $('#sucursal').focus();
        
        }else if(direccion == ""){
            alert('Debe de llenar el campo dirección');
            $('#direccion').focus();
        
        }else if(telefono == ""){
            alert('Debe de llenar el campo teléfono');
            $('#telefono').focus();
        
        }else if(departamento_ciudad == ""){
            alert('Debe de llenar el campo departamento o ciudad');
            $('#departamento_ciudad').focus();
        
        }else if(pais == ""){
            alert('Debe de llenar el campo país');
            $('#pais').focus();
        
        }else {
            // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
            var url = 'controller_create_informaciones.php';
            $.get(url, {
                nombre_parqueo: nombre_parqueo,
                actividad_empresa: actividad_empresa,
                sucursal: sucursal,
                direccion: direccion,
                telefono: telefono,
                departamento_ciudad: departamento_ciudad,
                pais: pais
            }, function(datos) {
                // Muestra la respuesta de la operación en el div con id 'respuesta'.
                $('#respuesta').html(datos);
            });
        }
    });
</script>