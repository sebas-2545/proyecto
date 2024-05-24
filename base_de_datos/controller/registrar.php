<?php
include '../conn.php';

$contraseña=$_POST['contra'];
$email=$_POST['email'];
$rol=2;
$secret= password_hash($contraseña,PASSWORD_DEFAULT);

$sql="INSERT INTO user (email,contrasena,id_rol) VALUES ('$email','$secret','$rol')";

if ($conn->query($sql) === true) {

    echo "su registro fue exitoso". header("Location: ../view/login.php") ;

}else {

   echo "error" . $sql ."<br>" . $conn->error;
   
}
?>