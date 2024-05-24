<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Búsqueda Dinámica</title>
    <link rel="stylesheet" href="css/buscador.css">
    <link rel="stylesheet" href="inactivity_timer.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.7/css/searchPanes.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.7/js/dataTables.searchPanes.min.js"></script>
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: "800",
                scrollX: true,
                language: {
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    search: "Buscar:",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                },
                dom: 'Plfrtip',
                searchPanes: {
                    controls: false,
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15] // Especifica todas las columnas que deseas agregar a los paneles de búsqueda
                }
            });
        });
    </script>
    <style>
        /* Estilo personalizado */
        .botoness {
            margin-bottom: 10px;
        }
        .dataTables_length{
            display: none;
        }
    </style>
</head>
<body>
    <div class="botoness">
        <form action="inicio.php" method="post">
            <button type="submit">Cargar Los Datos Excel</button>
        </form>
        <form action="descargar.php" method="post">
            <button type="submit">Descargar Datos en Excel</button>
        </form>
        <form action="login.php" method="get">
            <button class="Btn">
                <div class="sign">
                    <svg viewBox="0 0 512 512">
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                        ></path>
                    </svg>
                </div>
                <div class="text">  Salir</div>
            </button>
        </form>
    </div>

    <!-- Aquí se agregará automáticamente el campo de búsqueda proporcionado por DataTables -->

    <?php
    require 'session_check.php';
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    include 'conexion.php';

    $table = 'datos_exceldatos1_1714747072';
    $query = "SELECT *, id AS editable_id FROM `{$table}`";

    // Verifica si se ha proporcionado un término de búsqueda
    if (!empty($_GET['search'])) {
        $searchTerm = "%" . $_GET['search'] . "%";
        $query .= " WHERE `CODIGO DE FICHA` LIKE :search OR 
                       `NIVEL DE FORMACION` LIKE :search OR 
                       `NOMBRE_RESPONSABLE` LIKE :search";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    } else {
        $stmt = $con->prepare($query);
    }

    $stmt->execute();

    echo "<table id='dataTable'><thead><tr>";
    $columns = $con->query("SHOW COLUMNS FROM `{$table}`")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }
    echo "<th>Editar</th></tr></thead><tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            if ($key != 'editable_id' && $key != 'ESTADO') {
                echo "<td>$value</td>";
            }
        }
        echo "<td><form action='actualizar_cumple1.php' method='post'>";
        echo "<input type='hidden' name='id' value='{$row['editable_id']}'>";
        echo "<select name='ESTADO'>";
        echo "<option value='abierto'" . ($row['ESTADO'] === 'abierto' ? ' selected' : '') . ">abierto</option>";
        echo "<option value='cerrado'" . ($row['ESTADO'] === 'cerrado' ? ' selected' : '') . ">cerrado</option>";
        echo "</select>";
        echo "<input type='submit' value='Actualizar'>";
        echo "</form></td>";

        echo "<td><a href='editar.php?id=" . $row['editable_id'] . "'><button type='button'>Editar</button></a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>

</body>
</html>
