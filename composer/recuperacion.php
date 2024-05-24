<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperación de Contraseña</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="wrapper">
        <h2>Cambiar Contraseña</h2>
        <form action="recuperacion.php" method="post">
            Usuario:<br>
            <input type="text" name="username" required><br>
            Contraseña Actual:<br>
            <input type="password" name="current_password" required><br>
            Nueva Contraseña:<br>
            <input type="password" name="new_password" required><br>
            <input type="submit" value="Cambiar Contraseña">
        </form>
    </div>
</body>
</html>


<?php
require 'conexion.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($current_password, $user['password'])) {
        
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $updateSql = "UPDATE usuarios SET password = ? WHERE username = ?";
        $updateStmt = $con->prepare($updateSql);
        $updateStmt->bindParam(1, $new_password_hash);
        $updateStmt->bindParam(2, $username);
        $updateStmt->execute();

        if ($updateStmt->rowCount() > 0) {
            echo "<p>Contraseña cambiada con éxito.</p>";
        } else {
            echo "<p>Error al cambiar la contraseña.</p>";
        }
    } else {
        echo "<p>Usuario o contraseña incorrecta.</p>";
    }
}
?>
