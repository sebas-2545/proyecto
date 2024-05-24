<?php
require 'session_check.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Determinar la página a la que redirigir según el rol del usuario
$page = '';
switch ($_SESSION['role']) {
    case 1:
        $page = 'buscadorinstru.php';
        break;
    case 2:
        $page = 'buscador.php';
        break;
    case 3:
        $page = 'buscador.php';
        break;
    default:
        // En caso de un rol desconocido, redirigir a una página predeterminada
        $page = 'login.php';
        break;
}

// Redirigir a la página correspondiente
header("Location: $page");
exit();
?>
