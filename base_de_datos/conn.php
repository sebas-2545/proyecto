<?php
$local="localhost";
$database="recuperar";
$user="root";
$password='';

try{
    $conn =new mysqli($local,$user,$password,$database,);
}catch(PDOException $e){
    echo "error". $e->getMessage();
}
?>