<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nueva.css">
    <link rel="stylesheet"  type="text/css" href="../public/css/nueva.css">

    <title>Nueva Contraseña</title>
</head>

<body>
    <section>
        <div class="login-box">
            <form id="recu" action="../controller/restablecer.php" method="post">
                <h2>Restablecer Contraseña</h2>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input name="email" id="email" type="email" required>
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input name="contra" id="contra" type="password" required>
                    <label>Nueva Contraseña</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input name="contra2" type="password" required>
                    <label>Confirmar Nueva Contraseña</label>
                </div>
                <button type="submit">Restablecer</button>
            </form>
            

        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>






