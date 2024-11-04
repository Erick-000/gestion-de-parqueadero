<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group header
 * @group footer
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/TCPDF-main/tcpdf.php');
include('../app/config.php');

//Cargar el encabezado 

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
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79, 150), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de parqueo');
$pdf->setTitle('Sistema de parqueo');
$pdf->setSubject('Sistema de parqueo');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 7);

// add a page
$pdf->AddPage();


// create some HTML content
$html = '
<div>
    <p style="text-align: center">
        <b> '.$nombre_parqueo.' </b> <br>
        '.$actividad_empresa.' <br>
        NIT: 900882406-5 <br>	
        Sucursal No ' .$sucursal.'<br>
        DIRECCIÓN: '.$direccion.' <br>
        TELÉFONO: '.$telefono.' <br>
        '.$departamento_ciudad.' 
        -----------------------------------------------------------------------------------
            <b> Facura Nro. </b> 0001
        -----------------------------------------------------------------------------------
            <div style="text-align:left">
            <b> DATOS DEL CLIENTE </b> <br>
            <b> CLIENTE: </b> LUIS FELIPE ROBLEDO SANTOS <br>
            <b> CC: </b> 107729881 <br>
            <b> Fecha de la factura: </b> Quibdó, 4 de Noviembre del 2024
            -----------------------------------------------------------------------------------<br>
            <b> De: </b> 4/11/2024 <b> Hora: </b> 4:00 P.M <br>
            <b> A: </b> 4/11/2024 <b> Hora: </b> 6:00 P.M <br>
            <b> Tiempo: </b> 2 horas 
            -----------------------------------------------------------------------------------<br>
            <table border="1" cellpadding ="1" >
            <tr>
                <td style="text-align:center" width="101px" ><b> Detalle </b></td>
                <td style="text-align:center" width="45px" ><b> Precio </b></td>
                <td style="text-align:center" width="45px" ><b> Cantidad </b></td>
                <td style="text-align:center" width="45px" ><b> Total </b></td>
            </tr>

            <tr>
                <td>Servicio de parqueo de 2 horas en el cuviculo 10 </td>
                <td style="text-align:center"> 8.000 </td>
                <td style="text-align:center"> 1 </td>
                <td style="text-align:center"> COL$ 8.000 </td>
            </tr>
            </table>
            <p style="text-align:rigth">
            <b> Monto Total: </b> COL$ 8.000
            </p>

            <p>
             <b> Son: </b> Ocho mil pesos
            </p>
             ----------------------------------------------------------------------------------- <br>
            <b> USUARIO:</b> ERICK MANUEL MORENO PALACIOS 
            <p style="text-align:center" >
            <img src="https://cdn.urbantecno.com/rootear/2015/07/qr.jpg" width="100px">
            </p>

            <p style="text-align:center" ><b> GRACIAS POR SU PREFERENCIA </b></p>

        </div>
    </p>
</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
