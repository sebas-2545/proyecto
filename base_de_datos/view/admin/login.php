


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  type="text/css" href="../../public/css/styles.css">

    <script src="../public/js/script.js"></script>
    <title>Inicio</title>
</head>
<body>
    <div class="blur">
        <div class="login-content">
            <div class="formulario">
                <div class="eleccion">
                    <button id="btnLogin" class="boton boton-login default-hover">Login</button>
                    <button id="btnRegistrar" class="boton boton-registrar">Registrar</button>
                </div>
                <div class="entar" id="login">
                    <div class="Title"><img src="../../Img/Frase.png" alt=""></div>
                    <div class="login">
                    <form action="../../controller/admin.php" method="post">

                        <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                        <input type="password" id="password" name="contra" placeholder="Contraseña" required>
                        <button type="submit">Ingresar</button>
                    </form>
                    <a href="../recuperar.php">RECUPERAR</a>
                    </div>
                </div>
            </div>
            <div class="logo"><img src="Img/Logo.png" alt=""></div>
        </div>
    </div>
</body>
</html>