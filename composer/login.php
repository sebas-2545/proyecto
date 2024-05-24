<?php
require 'session_check.php';
require 'conexion.php';


$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role_id'];
        $_SESSION['last_activity'] = time();

    
        header("Location: welcome.php");
        exit();
    } else {
        $login_error = "Usuario o contraseña inválidos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="css/login.css">
    
</head>
<body>
<div class="wrapper">
    <div class="flip-card__inner">
        <input type="checkbox" class="toggle" id="cardToggle">
        <div class="slider-labels">
            <label for="cardToggle" class="slider"></label>
        </div>
        <div class="flip-card__front">
            <h2>Iniciar Sesión</h2>
            <form method="post" action="login.php">
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="submit" value="Iniciar sesión">
                <?php if ($login_error) echo "<p style='color: red;'>$login_error</p>"; ?>
            </form>
        </div>
        <div class="flip-card__back">
            <h2>Registro</h2>
            <form method="post" action="registro.php">
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <select name="role_id" required>
                    <?php
                    $roles = $con->query("SELECT id, nombre FROM roles");
                    while ($row = $roles->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Registrar">
            </form>
        </div>
    </div>
</div>


    <script>
document.getElementById('cardToggle').addEventListener('change', function() {
    const cardInner = document.querySelector('.flip-card__inner');
    const labels = document.querySelectorAll('label');
    
   

    cardInner.classList.toggle('is-flipped');
});

    </script>
</body>
</html>
