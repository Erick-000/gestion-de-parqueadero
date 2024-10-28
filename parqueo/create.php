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

                <h2> Creación de un nuevo espacio </h2>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Llene todos los campos</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Nro del espacio</label>
                                            <input type="number" id="nro_espacio" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Estado del espacio</label>
                                            <select name="" id="estado_espacio" class="form-control">
                                                <option value="Libre">Libre</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Observaciones</label>
                                            <textarea name="" id="obs" class="form-control" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-default btn-block" >Cancelar</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block" id="btn_registrar" >
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
    $('#btn_registrar').click(function () {
        
        var nro_espacio = $('#nro_espacio').val();
        var estado_espacio = $('#estado_espacio').val();
        var obs = $('#obs').val();

        // Validaciones para asegurar que los campos no estén vacíos antes de enviar los datos.
        if(nro_espacio == ""){
            alert('Debe de llenar el campo nro de espacio');
            $('#nro_espacio').focus();
        } else {
            // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
            var url = 'controller_create.php';
            $.get(url, {nro_espacio:nro_espacio,estado_espacio:estado_espacio,obs:obs}, function (datos) {
                // Muestra la respuesta de la operación en el div con id 'respuesta'.
                $('#respuesta').html(datos);
            });
        }
    });
</script>