<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
} 

$maxInactive = 500; 

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $maxInactive)) {
    session_unset();  
    session_destroy(); 
    header("Location: login.php");  
    exit;
}
$_SESSION['last_activity'] = time();  

$session_lifetime = 100;  

if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();  
} else if (time() - $_SESSION['created'] > $session_lifetime) {
    session_regenerate_id(true);  
    $_SESSION['created'] = time(); 
}
?>
