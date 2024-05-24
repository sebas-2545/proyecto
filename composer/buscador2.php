<?php
require 'session_check.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include 'conexion.php';

$table = 'datos_exceldatos1_1714747072';
$query = "SELECT *, id AS editable_id FROM `{$table}`";

if (isset($_GET['filter']) && $_GET['filter'] == 'myFichas' && isset($_SESSION['role_id'])) {
    $userName = $_SESSION['role_id'];
    $query .= " WHERE `NOMBRE_RESPONSABLE` = :userName"; // Usar el nombre del usuario para filtrar
    $stmt = $con->prepare($query);
    $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
} else if (!empty($_GET['search'])) {
    $searchTerm = "%" . $_GET['search'] . "%";
    $query .= " WHERE `CODIGO DE FICHA` LIKE :search OR 
                       `NIVEL DE FORMACION` LIKE :search OR 
                       `NOMBRE_RESPONSABLE` LIKE :search OR
                       // Otras condiciones de búsqueda si son necesarias
                       ";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
} else {
    $stmt = $con->prepare($query);
}

$stmt->execute();

echo "<table><thead><tr>";
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
    echo "<td>...</td>";  // Continúa con el resto del manejo de la fila
    echo "</tr>";
}
echo "</tbody></table>";
?>