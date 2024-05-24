<?php
require 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = $_POST['role_id'];

    // Aquí puedes imprimir o registrar en un archivo de registro el valor de $role_id para asegurarte de que sea el correcto
    // echo "Role ID: " . $role_id;

    $stmt = $con->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->bindParam(1, $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('El nombre de usuario ya está registrado. Por favor, elige otro nombre.'); window.location='login.php';</script>";
    } else {
        $stmt = $con->prepare("INSERT INTO usuarios (username, password, role_id) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $role_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Registro exitoso.'); window.location='login.php';</script>";
        } else {
            echo "Error en el registro.";
        }
    }
}

?>

