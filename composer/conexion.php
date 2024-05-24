<?php
$database="exel";
$user="root";
$password='';

try{
    $con =new PDO('mysql:host=localhost;dbname='.$database,$user,$password);

}catch(PDOException $e){
    echo "error". $e->getMessage();
}
?>