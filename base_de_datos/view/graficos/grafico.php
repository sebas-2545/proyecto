<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica con Chart.js y DataTables</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <style>
        #myTable_wrapper .dataTables_length,
        #myTable_wrapper .dataTables_info,
        #myTable_wrapper .dataTables_paginate,
        #myTable thead,
        #myTable tbody {
            display: none;
        }
    </style>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>FechaFormalizacion</th>
                <th>FechaEvaluacionParcial</th>
                <th>FechaEvaluacionFinal</th>
                <th>FechaEstadoPorCertificar</th>
                <th>FechaRespuestaCertificacion</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
    $(document).ready(function() {
        function updateChart(chart, tableData) {
            var conteo_columna1 = tableData.filter(function(e) {
                return e.FechaFormalizacion;
            }).length;
            var conteo_columna2 = tableData.filter(function(e) {
                return e.FechaEvaluacionParcial;
            }).length;
            var conteo_columna3 = tableData.filter(function(e) {
                return e.FechaEvaluacionFinal;
            }).length;
            var conteo_columna4 = tableData.filter(function(e) {
                return e.FechaEstadoPorCertificar;
            }).length;
            var conteo_columna5 = tableData.filter(function(e) {
                return e.FechaRespuestaCertificacion;
            }).length;

            chart.data.labels = ['FechaFormalizacion', 'FechaEvaluacionParcial', 'FechaEvaluacionFinal', 'FechaEstadoPorCertificar', 'FechaRespuestaCertificacion'];
            chart.data.datasets[0].data = [conteo_columna1, conteo_columna2, conteo_columna3, conteo_columna4, conteo_columna5];
            chart.update();
        }

        $.ajax({
            url: 'http://localhost/xampp/base_de_datos/view/graficos/db.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    console.error('Error del servidor: ' + data.error);
                    return;
                }

                // DataTables
                var table = $('#myTable').DataTable({
                    data: data,
                    columns: [
                        { data: 'FechaFormalizacion' },
                        { data: 'FechaEvaluacionParcial' },
                        { data: 'FechaEvaluacionFinal' },
                        { data: 'FechaEstadoPorCertificar' },
                        { data: 'FechaRespuestaCertificacion' }
                    ]
                });

                // Initialize Chart.js
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: [{
                            label: 'Conteo de Fechas',
                            data: [],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Update chart with initial data
                var initialData = table.rows({ search: 'applied' }).data().toArray();
                updateChart(myChart, initialData);

                // Event listener for table draw event to update chart data
                table.on('draw', function() {
                    var tableData = table.rows({ search: 'applied' }).data().toArray();
                    updateChart(myChart, tableData);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
    </script>
</body>
</html>
