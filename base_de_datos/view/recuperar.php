
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  type="text/css" href="../public/css/recuperar.css">

    <title>Recuperar Contraseña</title>
</head>
<body>
    <section>
        <div class="login-box">
            <form class="formulario-recuperacion" id="recoveryForm" action="../controller/recupe_contra.php" method="post">
                <h2>Recuperar Contraseña</h2>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input id="email" type="email"name="email" required>
                    <label>Email</label>
                </div>
                <button type="submit">Enviar Correo de Recuperación</button>
                <div class="register-link">
                    <p>Volver al<a href="./login.php">Inicio de Sesión</a></p>
                </div>
            </form>
        </div>
    </section>
    <script src="js/recuperar.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

       