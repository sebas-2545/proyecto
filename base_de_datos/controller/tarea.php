<?php

include '../conn.php';
if(isset($_GET['id'])){
$tarea=$_GET['PENDIENTE'];
$car=$_GET['id'];

$upa="UPDATE registroetapaproductiva 
    SET tarea='$tarea' where id = '$car'";
    if ($conn->query($upa) === true) {
        echo "su registro fue exitoso" . header("Location: http://localhost/xampp/juan/view/seccion/instructor.php");
    }else {
    
       echo "error" . $sql ."<br>" . $conn->error;
       
    }
}
?>