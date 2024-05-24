<?php
include '../conn.php';

 $nombre=$_POST['nombre'];
 $identificacion=$_POST['identificacion'];
 $email=$_POST['email'];
 $telefono=$_POST['telefono'];

 $sql="INSERT INTO intructores (name,identificaion,correo,telefono) values('$nombre','$identificacion','$email','$telefono')";
 if ($conn->query($sql) === true) {

    echo "su registro fue exitoso".header('Location: http://localhost/xampp/juan/view/admin/admin.php');
    
}else {

   echo "error" . $sql ."<br>" . $conn->error;
   
}
?>