<?php
session_start();
include '../../conn.php';

if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $id_rol= $_SESSION['id_rol'];
    if($id_rol!=5){

        header("Location:  http://localhost/xampp/juan/view/login.php");
    }
    $sql = "SELECT * FROM registroetapaproductiva";
    $res = $conn->query($sql);
    //
    

}else{
    header("Location:  http://localhost/xampp/juan/view/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../public/css/instructor.css">
    <link href="../../DataTables/datatables.min.css" rel="stylesheet">

    <!-- select -->
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

</head>
<body>
    <header>
        <div class="containere">
            <h1>Hello <?php echo $email. " ". date_default_timezone_set('America/Bogota');
echo date("Y-m-d H:i:s"); date("Y-m-d H:i:s");?></h1>
            <form action="../../controller/cerrar.php" method="post">
                <button type="submit" id="cerrar-sesion"><img src="../../public/Img/apagado.png" alt="" width="70%" height="3%"></button>
            </form>
        </div>
    </header>

    
    <div class="container mt-4">
    <div class="table-responsive">
        <table id="miTabla" class="table table-striped table-bordered table-hover">
            <thead class="bg-success text-white">
                <tr>
                    <th scope="col">Fecha de Registro</th>
                    <th scope="col">Número de Documento de Identidad</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Número de Ficha</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Nivel Académico</th>
                    <th scope="col">Programa de Formación</th>
                    <th scope="col">Número de Celular</th>
                    <th scope="col">Empresa de Inicio de Etapa Productiva</th>
                    <th scope="col">Fecha de Inicio de Etapa</th>
                    <th scope="col">Fecha de Fin de Etapa</th>
                    <th scope="col">Nombre del Instructor/Lectivo</th>
                    <th scope="col">Dirección de la Empresa</th>
                    <th scope="col">Municipio/Ciudad</th>
                    <th scope="col">Nombre del Jefe Inmediato</th>
                    <th scope="col">Teléfono del Jefe Inmediato</th>
                    <th scope="col">Correo del Jefe Inmediato</th>
                    <th scope="col">Tipo de Alternativa de Etapa Productiva</th>
                    <th scope="col">Documentos Entregados</th>
                    <th scope="col">Respuesta Magna</th>
                    <th scope="col">Registro de Etapa Productiva</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Fecha de Formalización</th>
                    <th scope="col">Fecha de Evaluación Parcial</th>
                    <th scope="col">Fecha de Evaluación Final</th>
                    <th scope="col">Fecha de Estado por Certificar</th>
                    <th scope="col">Fecha de Respuesta de Certificación</th>
                    <th scope="col">URL del Formulario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de Solicitud de Paz y Salvo</th>
                    <th scope="col">Fecha de Respuesta del Coordinador</th>
                    <th scope="col">Observaciones de Seguimiento</th>
                    <th scope="col">Formato GFPIF023</th>
                    <th scope="col">Copia de Contrato</th>
                    <th scope="col">Formato GFPIF165</th>
                    <th scope="col">RUT o NIT</th>
                    <th scope="col">EPS</th>
                    <th scope="col">ARL</th>
                    <th scope="col">Formato GFPIF023 Completo</th>
                    <th scope="col">Formato GFPIF147 Bitácoras</th>
                    <th scope="col">Certificación de Finalización</th>
                    <th scope="col">Estado por Certificar</th>
                    <th scope="col">Copia de Cédula</th>
                    <th scope="col">Pruebas TyT</th>
                    <th scope="col">Destrucción de Carnet</th>
                    <th scope="col">Certificado APE</th>
                    <th scope="col">REGISTRO SGVA</th>
                    <th scope="col"> Responder</th>
                    <th scope="col">PDF</th>
                </tr>
            </thead>
            <div id="filter-controls" class="clear-filter"></div>

            <tbody>
                <?php
                $sqll = "SELECT * FROM intructores where correo='$email'";
                $ext = "completar la información";
                $extt = "Pdf";
                $ress = $conn->query($sqll);
                $roww = $ress->fetch_assoc();
                while ($row = $res->fetch_assoc()) {
                    if ('PENDIENTE' == $row['tarea']) {
                        $id = $row['Id'];
                        $redi = './magna.php?id=' . $id;
                        $urll = '../../controller/pdf.php?id=' . $id;
                        echo "<tr>";
                        echo "<td>" . $row['FechaRegistro'] . "</td>";
                        echo "<td>" . $row['NumeroDocumentoIdentidad'] . "</td>";
                        echo "<td>" . $row['NombreCompleto'] . "</td>";
                        echo "<td>" . $row['NumeroFicha'] . "</td>";
                        echo "<td>" . $row['CorreoElectronico'] . "</td>";
                        echo "<td>" . $row['NivelAcademico'] . "</td>";
                        echo "<td>" . $row['ProgramaFormacion'] . "</td>";
                        echo "<td>" . $row['NumeroCelular'] . "</td>";
                        echo "<td>" . $row['EmpresaInicioEtapaProductiva'] . "</td>";
                        echo "<td>" . $row['FechaInicioEtapa'] . "</td>";
                        echo "<td>" . $row['FechaFinEtapa'] . "</td>";
                        echo "<td>" . $row['NombreInstructorLectivo'] . "</td>";
                        echo "<td>" . $row['DireccionEmpresa'] . "</td>";
                        echo "<td>" . $row['MunicipioCiudad'] . "</td>";
                        echo "<td>" . $row['NombreJefeInmediato'] . "</td>";
                        echo "<td>" . $row['TelefonoJefeInmediato'] . "</td>";
                        echo "<td>" . $row['CorreoJefeInmediato'] . "</td>";
                        echo "<td>" . $row['TipoAlternativaEtapaProductiva'] . "</td>";
                        echo "<td>" . $row['DocumentosEntregados'] . "</td>";
                        echo "<td>" . $row['Respuesmagna'] . "</td>";
                        echo "<td>" . $row['Registroetapaproductiva'] . "</td>";
                        echo "<td>" . $row['observaciones'] . "</td>";
                        echo "<td>" . $row['FechaFormalizacion'] . "</td>";
                        echo "<td>" . $row['FechaEvaluacionParcial'] . "</td>";
                        echo "<td>" . $row['FechaEvaluacionFinal'] . "</td>";
                        echo "<td>" . $row['FechaEstadoPorCertificar'] . "</td>";
                        echo "<td>" . $row['FechaRespuestaCertificacion'] . "</td>";
                        echo "<td>" . $row['URLFormulario'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "<td>" . $row['FechaSolicitudPazySalvo'] . "</td>";
                        echo "<td>" . $row['FechaRespuestaCoordinador'] . "</td>";
                        echo "<td>" . $row['ObservacionesSeguimiento'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF023'] . "</td>";
                        echo "<td>" . $row['CopiaContrato'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF165'] . "</td>";
                        echo "<td>" . $row['RUToNIT'] . "</td>";
                        echo "<td>" . $row['EPS'] . "</td>";
                        echo "<td>" . $row['ARL'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF023Completo'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF147Bitacoras'] . "</td>";
                        echo "<td>" . $row['CertificacionFinalizacion'] . "</td>";
                        echo "<td>" . $row['EstadoPorCertificar'] . "</td>";
                        echo "<td>" . $row['CopiaCedula'] . "</td>";
                        echo "<td>" . $row['PruebasTyT'] . "</td>";
                        echo "<td>" . $row['DestruccionCarnet'] . "</td>";
                        echo "<td>" . $row['CertificadoAPE'] . "</td>";
                        echo "<td>" . $row['tarea'] . "</td>";

                        echo "<td><a href='$redi' class='btn btn-outline-success btn-sm'>Responder</a></td>";
                        echo "<td><a href='$urll' class='btn btn-outline-success btn-sm'>PDF</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
<script src="https://cdn.datatables.net/searchpanes/1.0.1/js/dataTables.searchPanes.min.js"></script>

    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>  


    <script>
$(document).ready(function(){
    var table= $('#miTabla').DataTable({
        "dom": '<"top"lf>rt<"bottom"ip><"clear">',

        "pageLength": 10, // Define la cantidad predeterminada de filas por página
        "lengthMenu": [10], // Elimina la opción de elegir la cantidad de registros por página
        "info": false,
        "language": {
            "search": "Buscador:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrados de _MAX_ registros totales)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });


    $('<button type="button">Limpar</button>')
        .appendTo('#filter-controls')
        .addClass('clear-filter')
        .on('click', function() {
            $('#miTabla').DataTable().search('').columns().search('').draw();
            $('.filter-dropdown select').val('').trigger('change');
        });

    $('thead th').each(function() {
        var filterDropdown = $('<div class="filter-dropdown"></div>').appendTo($(this));

        // Adiciona evento de clique
        $(this).on('click', function(e) {
            e.stopPropagation();
            $('.filter-dropdown').not(filterDropdown).hide();
            filterDropdown.toggle();
        });

        // Fecha o menu suspenso ao clicar em outro lugar na página
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.filter-dropdown').length) {
                $('.filter-dropdown').hide();
            }
        });

        var column = table.column($(this).index());
        var select = $('<select><option value=""></option></select>')
            .appendTo(filterDropdown)
            .on('click', function(e) {
                e.stopPropagation(); // Impede a propagação do evento de clique
            })
            .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
            });

        column.data().unique().sort().each(function(d, j) {
            select.append('<option value="' + d + '">' + d + '</option>');
        });
    });
});
</script>
</body>
</html>