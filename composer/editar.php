<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


require 'session_check.php';
require 'conexion.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: ID no proporcionado o inválido.');
}

$id = intval($_GET['id']);
$stmt = $con->prepare("SELECT * FROM datos_exceldatos1_1714747072 WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die('Registro no encontrado.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="css/editar.css">
    <script src="inactivity_timer.js"></script>

</head>
<body>
    <h1>Editar Registro</h1>
    <form action="actualizar_registro.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="INSTRUCTOR_SEGUIMIENTO_ACTUAL">INSTRUCTOR SEGUIMIENTO ACTUAL</label><br>
        <input type="text" name="INSTRUCTOR_SEGUIMIENTO_ACTUAL" value="<?php echo htmlspecialchars($row['INSTRUCTOR_SEGUIMIENTO_ACTUAL']); ?>"><br>
        <label for="Correo_Instructor">Correo Instructor</label><br>
        <input type="email" name="Correo_Instructor" value="<?php echo htmlspecialchars($row['Correo_Instructor']); ?>" required><br>
        <label for="INSTRUCTOR_ANTERIOR">INSTRUCTOR ANTERIOR</label><br>
        <input type="text" name="INSTRUCTOR_ANTERIOR" value="<?php echo htmlspecialchars($row['INSTRUCTOR_ANTERIOR']); ?>"><br>
        <label for="CORREO">CORREO</label><br>
        <input type="email" name="CORREO" value="<?php echo htmlspecialchars($row['CORREO']); ?>" ><br>
        <input type="submit" value="Actualizar">
    </form>
    <button id="redirectButton">
  <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
  <span>Regresar</span>
</button>

    <script>
        document.getElementById('redirectButton').addEventListener('click', function() {
            window.location.href = 'http://localhost/xampp/composer/buscador.php?search=';
        });
    </script>
</body>
</html>
