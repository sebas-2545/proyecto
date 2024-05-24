<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require 'session_check.php';
require 'vendor/autoload.php';
require 'conexion.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

error_log('Inicio del script de carga de archivo');
$tableName = 'datos_exceldatos1_1714747072'; 

if (isset($_POST['submit']) && isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    error_log('Información del archivo: ' . print_r($file, true));

    if ($file['error'] === 0 && $file['size'] > 0) {
        $allowedTypes = ['xls', 'xlsx'];
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (in_array($fileExtension, $allowedTypes)) {
            $destinationPath = "upl/uploads/" . basename($file['name']);
            
            if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
                error_log('Archivo movido a: ' . $destinationPath);
                try {
                    // Realizar la verificación antes de importar los datos
                    if (!tableIsEmpty($con, $tableName)) {
                        $diferenciasEncontradas = compararDatos($destinationPath, $con, $tableName);
                        if ($diferenciasEncontradas) {
                            importarDatos($destinationPath, $con);
                            echo "<script>alert('Datos importados con éxito en la tabla.'); window.location='inicio.php';</script>";
                        } else {
                            echo "<script>alert('No se encontraron diferencias significativas.'); window.location='inicio.php';</script>";
                        }
                    } else {
                        importarDatos($destinationPath, $con);
                        echo "<script>alert('Datos importados con éxito en la tabla.'); window.location='inicio.php';</script>";
                    }
                } catch (Exception $e) {
                    error_log('Error al procesar los datos: ' . $e->getMessage());
                    echo "<script>alert('Error al procesar los datos: " . $e->getMessage() . "'); window.location='inicio.php';</script>";
                }
            } else {
                error_log('Error al mover el archivo a la ubicación deseada.');
                echo "<script>alert('Error al mover el archivo a la ubicación deseada.'); window.location='inicio.php';</script>";
            }
        } else {
            error_log('Tipo de archivo no permitido: ' . $fileExtension);
            echo "<script>alert('Error: El archivo seleccionado no es un Excel válido.'); window.location='inicio.php';</script>";
        }
    } else {
        error_log('Error en el archivo o archivo vacío.');
        echo "<script>alert('Error: No se ha podido cargar el archivo o el archivo está vacío.'); window.location='inicio.php';</script>";
    }
}

function tableIsEmpty($pdo, $tableName) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM $tableName");
    return $stmt->fetchColumn() == 0;
}

function importarDatos($archivoExcel, $pdo) {
    try {
        $documento = IOFactory::load($archivoExcel);
        error_log('Archivo Excel cargado exitosamente');
    } catch (Exception $e) {
        error_log('Error al cargar el archivo Excel: ' . $e->getMessage());
        throw new Exception("Error al cargar el archivo Excel: " . $e->getMessage());
    }

    $hojaExcel = $documento->getActiveSheet();
    $header = $hojaExcel->rangeToArray('A1:' . $hojaExcel->getHighestColumn() . '1', NULL, TRUE, FALSE)[0];

    $indiceFechaInicio = array_search('FECHA_INICIO_FICHA', $header);
    $indiceFechaTerminacion = array_search('FECHA_TERMINACION_FICHA', $header);
    $indiceFinEtapaElectiva = array_search('FECHA TERMINACIÓN E.LECTIVA', $header);
    $indiceFinPracticas = array_search('FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA', $header);
    $indiceFechaLimitePracticas = array_search('FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA', $header);
    $indiceNivelFormacion = array_search('NIVEL DE FORMACION', $header);
    $indiceEstado = array_search('ESTADO', $header); // Añade esto

    $tableName = 'datos_exceldatos1_1714747072';
    $data = $hojaExcel->rangeToArray('A2:' . $hojaExcel->getHighestColumn() . $hojaExcel->getHighestRow(), NULL, TRUE, FALSE);
    $placeholders = array_fill(0, count($header), '?');
    $sql = "INSERT INTO `$tableName` (" . implode(', ', array_map(function($h) { return "`$h`"; }, $header)) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $stmt = $pdo->prepare($sql);

    foreach ($data as $row) {
        $nivelFormacion = $row[$indiceNivelFormacion];

        if (!empty($row[$indiceFechaInicio]) && is_numeric($row[$indiceFechaInicio])) {
            $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[$indiceFechaInicio]);
            $row[$indiceFechaInicio] = $dateTime->format('Y-m-d');
        }
        if (!empty($row[$indiceFechaTerminacion]) && is_numeric($row[$indiceFechaTerminacion])) {
            $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[$indiceFechaTerminacion]);
            $row[$indiceFechaTerminacion] = $dateTime->format('Y-m-d');
        }

        list($row[$indiceFinEtapaElectiva], $row[$indiceFinPracticas], $row[$indiceFechaLimitePracticas]) = calculateAdditionalDates(
            $row[$indiceFechaInicio], $row[$indiceFechaTerminacion], $nivelFormacion);

        // Establecer un valor predeterminado para 'ESTADO' si es NULL
        if (empty($row[$indiceEstado])) {
            $row[$indiceEstado] = 'default_value'; // Reemplaza 'default_value' con el valor predeterminado que desees
        }

        if (count($row) == count($header)) {
            try {
                $stmt->execute($row);
                error_log('Fila insertada exitosamente: ' . implode(', ', $row));
            } catch (Exception $e) {
                error_log('Error al insertar la fila: ' . $e->getMessage());
                throw new Exception("Error al ejecutar la consulta: " . $e->getMessage());
            }
        } else {
            error_log('El número de columnas en los datos no coincide con el número de columnas en el encabezado.');
            throw new Exception("El número de columnas en los datos no coincide con el número de columnas en el encabezado.");
        }
    }
}

function calculateAdditionalDates($fechaInicio, $fechaTerminacion, $nivelFormacion) {
    $fechaInicio = new DateTime($fechaInicio);
    $fechaTerminacion = new DateTime($fechaTerminacion);

    $finEtapaElectiva = $inicioPracticas = $finPracticas = $fechaLimitePracticas = null;

    if ($nivelFormacion == "TECNOLOGO") {
        $finEtapaElectiva = clone $fechaInicio;
        $finEtapaElectiva->add(new DateInterval('P21M'));
        $inicioPracticas = clone $finEtapaElectiva;
        $finPracticas = clone $inicioPracticas;
        $finPracticas->add(new DateInterval('P0M'));
        $fechaLimitePracticas = clone $inicioPracticas;
        $fechaLimitePracticas->add(new DateInterval('P24M'));
    } elseif ($nivelFormacion == "TECNICO") {
        $finEtapaElectiva = clone $fechaInicio;
        $finEtapaElectiva->add(new DateInterval('P6M'));
        $inicioPracticas = clone $finEtapaElectiva;
        $finPracticas = clone $inicioPracticas;
        $finPracticas->add(new DateInterval('P0M'));
        $fechaLimitePracticas = clone $inicioPracticas;
        $fechaLimitePracticas->add(new DateInterval('P24M'));
    } else {
        error_log('Nivel de formación no reconocido: ' . $nivelFormacion);
        throw new Exception("Nivel de formación no reconocido: " . $nivelFormacion);
    }

    if (!$finEtapaElectiva || !$finPracticas || !$fechaLimitePracticas) {
        error_log('Error calculando fechas.');
        throw new Exception("Error calculando fechas.");
    }

    return [
        $finEtapaElectiva->format('Y-m-d'),
        $finPracticas->format('Y-m-d'),
        $fechaLimitePracticas->format('Y-m-d')
    ];
}

function compararDatos($archivoExcel, $pdo, $tableName) {
    try {
        $documento = IOFactory::load($archivoExcel);
        error_log('Archivo Excel cargado exitosamente');
    } catch (Exception $e) {
        error_log('Error al cargar el archivo Excel: ' . $e->getMessage());
        throw new Exception("Error al cargar el archivo Excel: " . $e->getMessage());
    }

    $hojaExcel = $documento->getActiveSheet();
    $excelHeader = $hojaExcel->rangeToArray('A1:' . $hojaExcel->getHighestColumn() . '1', NULL, TRUE, FALSE)[0];
    error_log('Encabezados del archivo Excel: ' . implode(', ', $excelHeader));

    // Convertir los datos del archivo Excel a un formato comparable
    $excelData = $hojaExcel->toArray(NULL, TRUE, TRUE, TRUE);
    error_log('Número de filas en el archivo Excel: ' . count($excelData));

    // Construir la consulta SQL para obtener los datos de la tabla
    $columnsQuery = "SHOW COLUMNS FROM `$tableName`";
    $stmt = $pdo->query($columnsQuery);
    $tableColumns = array_map(function($row) {
        return $row['Field'];
    }, $stmt->fetchAll(PDO::FETCH_ASSOC));
    error_log('Columnas de la tabla de la base de datos: ' . implode(', ', $tableColumns));

    $columns = implode(', ', array_map(function($h) { return "`$h`"; }, $tableColumns));
    $sql = "SELECT $columns FROM `$tableName`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $dbData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log('Número de filas en la tabla de la base de datos: ' . count($dbData));

    // Verificar si los datos del archivo Excel ya existen en la base de datos
    $differencesFound = false;

    foreach ($excelData as $excelRow) {
        $excelRowData = array_combine($excelHeader, $excelRow);
        $rowDifferencesFound = true; // Consideramos que hay diferencias hasta comprobar lo contrario

        foreach ($dbData as $dbRow) {
            foreach ($tableColumns as $column) {
                if (array_key_exists($column, $excelRowData) && array_key_exists($column, $dbRow)) {
                    if ($excelRowData[$column] == $dbRow[$column]) {
                        $rowDifferencesFound = false; // Si encontramos al menos una coincidencia, no hay diferencias
                        break;
                    }
                } else {
                    error_log("La columna '$column' no existe en los datos del Excel o de la base de datos.");
                }
            }
            if ($rowDifferencesFound) {
                break; // Si se encontraron diferencias para esta fila, no necesitamos comparar más filas
            }
        }

        if ($rowDifferencesFound) {
            $differencesFound = true;
            error_log("Diferencias encontradas en la fila del Excel: " . implode(', ', $excelRow));
            break; // Salir del bucle si encontramos alguna diferencia
        }
    }

    return $differencesFound;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cargar Archivo Excel</title>
    <link rel="stylesheet" href="css/inicio.css">
    <script src="inactivity_timer.js"></script>
</head>
<body>
    <div class="container">
        <h1>Cargar Archivo Excel</h1>
        <form action="inicio.php" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">Seleccione archivo Excel para cargar:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" accept=".xls,.xlsx">
            <input type="submit" value="Subir Archivo" name="submit">
        </form>
    </div>
    <div class="regresar">
        <button id="redirectButton">
            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
            <span>Regresar</span>
        </button>
    </div>
    <script>
        document.getElementById('redirectButton').addEventListener('click', function() {
            window.location.href = 'http://localhost/xampp/composer/buscador.php?search=';
        });
    </script>
</body>
</html>
