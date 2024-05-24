<?php
session_start();
include '../../conn.php';

if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $id_rol= $_SESSION['id_rol'];
    if($id_rol!=3 && $id_rol!=1){

        header("Location:  http://localhost/xampp/juan/view/login.php");
    }
    $sql = "SELECT * FROM registroetapaproductiva";
    $res = $conn->query($sql);
    //
    

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
    <link rel="stylesheet" href="../../public/css/menu.css">
    <title>Menu</title>
</head>
<body>
<body>
<div class="container">
        <div class="image">
            <a href="./instructor.php" title="Aprendiz"><img src="../../public/Img/aprendices.png" alt="Imagen 1"></a>
            <a href="" title="Ficha"><img src="../../public/Img/hojadevida5.png" alt="Imagen 2"></a>
        </div>
        <div class="image">
            <a href="https://sena4.sharepoint.com/sites/Etapaproductiva9226/" title="sheckpoint"><img src="../../public/Img/4ta-revolucion-icono2.png" alt="Imagen 3"></a>
            <a href="#" title="email "><img src="../../public/Img/ida.png" alt="Imagen 4"></a>
        </div>
</body>
</body>
</html>