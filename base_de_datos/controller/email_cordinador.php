<?php
// Incluir el archivo autoload de Composer
require '../vendor/autoload.php';
include '../conn.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();

// Configurar el servidor SMTP
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';

// Configurar la autenticación SMTP
$mail->SMTPAuth = true;
$mail->Username = 'sebdyjxjig@gmail.com';
$mail->Password = 'yehqmblvhwdshhai';

// Establecer el remitente y destinatario
$mail->setFrom('sebdyjxjig@gmail.com', 'juan');
$mail->addAddress('sebdyjxjig@gmail.com', 'CORDIANDOR');

// Configurar el asunto y cuerpo del mensaje
$mail->Subject = 'CORDINADOR';
$mail->Body    = 'ESTE MESANJE ES PAR INFORMARLE QUE EL SEÑOR JUAN SEBASTIAN CIFUENTES ES UN EXECELENTE TRABAJDOR Y CUMPLE CON TODAS SUS OBLIGACIONES' ;

// Enviar el correo electrónico
if ($mail->send()) {
    echo '¡Correo electrónico enviado correctamente!';
} else {
    echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;

}

?>