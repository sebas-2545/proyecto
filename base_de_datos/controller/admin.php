<?php
include '../conn.php';
session_start();

$email=$_POST['email'];
$contrasena=$_POST['contra'];
//user
$sql="SELECT * FROM user WHERE email = '$email'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();

//user    
    if($res->num_rows > 0){
        $id_rol=$row['id_rol'];

        if($id_rol==1){


        if(password_verify($contrasena,$row['contrasena'])){
            $_SESSION['id_rol']=$id_rol;
            $_SESSION['email'] = $email;
            header('Location: ../view/admin/admin.php');
        }else{
            echo "usuario  o contrsena incoorectos";
        }
    }else{
        echo "usuario  o contrsena incoorectos";
    }
}
?>