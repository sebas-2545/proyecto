<?php
// Incluir el archivo autoload de Composer
require '../vendor/autoload.php';
include '../conn.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$email=$_POST['email'];
$sql="SELECT * FROM user WHERE email='$email'";
$resul=$conn->query($sql);

if($resul->num_rows >0){
// Configurar el servidor SMTP
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';

// Configurar la autenticación SMTP
$mail->SMTPAuth = true;
$mail->Username = 'sebdyjxjig@gmail.com';
$mail->Password = 'yehqmblvhwdshhai';

// Establecer el remitente y destinatario
$mail->setFrom('sebdyjxjig@gmail.com', 'juan');
$mail->addAddress($email, 'sebnastian');

// Configurar el asunto y cuerpo del mensaje
$mail->Subject = 'recuperacion de contraseña';
$mail->Body    = 'Tu contraseña es ' . 'http://localhost/xampp/juan/view/restablecer.php' ;

// Enviar el correo electrónico
if ($mail->send()) {
    echo '¡Correo electrónico enviado correctamente!';
} else {
    echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;

}
}else{
    echo "Correo no encontrado ";
}
?>