<?php
include '../conn.php';
session_start();

$email=$_POST['user'];
$contrasena=$_POST['pass'];
//user
$sql="SELECT * FROM user WHERE cedula = '$email'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
//user
if($res->num_rows > 0){
        $id_rol=$row['id_rol'];
        if($id_rol==2){
            if(password_verify($contrasena,$row['contrasena'])){
                $_SESSION['id_rol']=$id_rol;
                $_SESSION['email'] = $email;
                $id=$row['id'];
                $cons="SELECT * FROM registroetapaproductiva WHERE id_user='$id'";
                $sisa=$conn->query($cons);
                 $sisa->num_rows;
                if($sisa->num_rows > 0){
                    echo "HOLA MUNDO";
                    //header("Location: ../../aprendiz/aprendiz.php");
                    //exit;
                }else{
                    echo "HOLA LOL";
                    //header("Location: ../../aprendiz/editar.php");
                    //exit;
                }
            }else{
                "<script>
				alert ('El usuario o clave incorrecta');

				window.location='loginAprendiz.php';
			  </script>";
            }
        }
}else {
        "<script>
        alert ('El usuario o clave incorrecta');

        window.location='loginAprendiz.php';
        </script>";
}

?>