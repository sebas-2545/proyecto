<?php

// Verifica si se ha proporcionado el parámetro 'redirect' en la URL
// Verifica si se ha proporcionado el parámetro 'redirect' en la URL
if(isset($_GET['redirect'])) {
    // Obtiene y decodifica la URL encriptada
    $url_codificada = $_GET['redirect'];
    $url_decodificada = base64_decode(urldecode($url_codificada));
    
    // Redirige al usuario a la URL decodificada
    header("Location: $url_decodificada");
    exit;
} else {
    // Si no se proporcionó 'redirect', muestra un mensaje de error
    echo "No se proporcionó ninguna URL para redireccionar.";
}


?>
