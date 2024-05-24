<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
if(!isset($_SESSION['user'])){
    header('Location: instructor.php');
}
?>