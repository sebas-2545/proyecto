<?php
$host = 'localhost';
$dbname = 'recuperar';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$query = $conn->query("SELECT FechaFormalizacion, FechaEvaluacionParcial, FechaEvaluacionFinal, FechaEstadoPorCertificar, FechaRespuestaCertificacion FROM registroetapaproductiva");
$data = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>
