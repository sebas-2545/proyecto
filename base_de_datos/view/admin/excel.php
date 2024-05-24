<?php
   session_start();
   include '../../conn.php';
   
   if(isset($_SESSION['email'])){
   
       $email=$_SESSION['email'];
       $id_rol= $_SESSION['id_rol'];
       
       if($id_rol!=1){
   
           header("Location:  http://localhost/xampp/juan/view/login.php");
       }
   }else{
       header("Location:  http://localhost/xampp/juan/view/login.php");
       exit();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  type="text/css" href="../../public/css/instructor.css">

</head>
<body>
    <header>

        <div class="container">
        <H1> Hello <?php
        
        $fecha_hoy = date("Y-m-d H:i:s");
        echo  "                    ". $fecha_hoy ; ?></H1>
        <a href="../../view/admin/admin.php">ADMIN</a>
        <a href="#">INSTRUCTOR</a>
            <form action="../../controller/cerrar.php" method="post">
                <button type="submit" id="cerrar-sesion"><img src="../../public/Img/apagado.png" alt="" width="70%" height="3%"></button>
        </form>
        </div>
    </header>
    
    <div class="wallpaper" style="background-image: linear-gradient(#022534f5, #022534f5))">
        <div class="icon">
            <div class="imagen"><img src=" " alt=""></div>
            <div class="texto"><p>© Sena</p></div>
        </div>
        <div class="content">
            <div class="logo">
                <img src="" alt="">
            </div>
            <form action="../../controller/instructores.php" method="post">
            
            <div class="formulario">
                <div class="campos">
                    <div class="parte-1">
                        <div class="asociado-nombre">
                            <input type="text" id="nombre" name="nombre" class="input-nombre" placeholder="nombre" required>
                        </div>
                        <div class="asociado-identificacion">
                            <input type="text" id="identificacion" name="identificacion" class="input-identificacion" placeholder="identificacion " required>
                        </div>
                    </div>
                    <div class="parte2">
                        <div class="asociado-email">
                            <input type="email" id="email" name="email" class="input-email" placeholder=" email " required>
                        </div>
                    </div>
                    <div class="parte-3">
                        <div class="asociado-telefono">
                            <input type="tel" id="telefono" name="telefono" class="input-telefono" placeholder="telefono" required>
                        </div>
                        <div class="asociado-direccion">
                            <input type="text" id="direccion" name="direccion" class="input-direccion" placeholder="direccion " required>
                        </div>
                    </div>
                    
                </div>
                <div class="contra">
                    <button type="submit" class="guardar" onclick="return confirm('¿Estás seguro de que deseas inscribir este recurso?')">Guardar</button>

                </div>
            </div>
            </form>
        </div>
    </div>

    
</body>
</html>