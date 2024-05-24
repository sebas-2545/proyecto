<?php
include '../conn.php';

$email=$_POST['email'];
$contrasena=$_POST['contra'];
$ver=$_POST['contra2'];
$sql="SELECT * FROM user WHERE email = '$email'";
$res=$conn->query($sql);
if($res->num_rows > 0){
    
    $row=$res->fetch_assoc();
    
    if ($contrasena == $ver) {
        $secret= password_hash($contrasena,PASSWORD_DEFAULT);
        $updat="UPDATE user SET contrasena = '$secret' WHERE email = '$email'";
        $conn->query($updat);
        echo "Contraseña restablecidad" . header("Location: ../view/login.php") ;
    }else{
        echo "Las contraseñas no son las mismas ";
    }
    
   
}else{
    echo "email no encotrado";
}
?>