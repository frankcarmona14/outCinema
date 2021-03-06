<?php
session_start();

$email = $_SESSION['user_email']; //Se recuperan los datos de email y codigo de acceso aleatorio guardados en la página anterior.

use PHPMailer\PHPMailer\PHPMailer;  //Para enviar el correo electrónico, se hace uso de la librería PHPMailer.
use PHPMailer\PHPMailer\Exception;  //PHPMailer está pensada para enviar correos electrónicos desde un hosting real.
//Sin embargo, acomodando un poco el código he conseguido que funcione en localhost.
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

switch ($_REQUEST['motivo']) {
    case "confirmarCuenta":
        $codigoRandom = $_SESSION['codigoRandom'];
        $asunto = "Confirmación de Cuenta";
        $mensaje = "Su código de confirmación de cuenta de OutCinema es: <b>" . $codigoRandom . "</b><br>Si usted no se ha registrado en nuestra aplicación, le ofrecemos una disculpa y le rogamos hacer caso omiso a este correo.";
        $redirect = "validarConfirmacion.php";
        break;
    case "cambiarPassword":
        $codigoRandom = $_SESSION['codigoRandom'];
        $asunto = "Cambio de Contraseña";
        $mensaje = "Su código de acceso provisional es: <b>" . $codigoRandom . "</b>";
        $redirect = "passwordProvisional.php";
        break;
    case "enviarEntradas":
        $asunto = "Confirmación de Compra";
        $mensaje = "A continuación, le adjuntamos un PDF con toda la información correspondiente a la compra de sus entradas.";
        $redirect = "infoEntradas.php?resumen";
        break;
}
$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';      //El host del servidor de correos electrónicos que estamos usando. En nuestro caso, Gmail.             
    $mail->SMTPAuth   = true;
    $mail->Username   = 'outcinema.recovery@gmail.com';    //Nuestro correo de usuario en gmail.                
    $mail->Password   = 'outcinema_pass';                  //La contraseña para acceder a esa cuenta de correo.             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('outcinema.recovery@gmail.com', 'Out Cinema'); //Los datos del remitente que verá el usuario en el mensaje.
    $mail->addAddress($email); //La dirección a la que enviaremos el mensaje. Es el correo electrónico introducido por el usuario en la página anterior.

    $mail->isHTML(true); //Nos permite formatear el correo como si se tratara de código html, usando etiquetas y demás.
    $mail->CharSet = 'UTF-8'; //Se establece UTF-8 como sistema de codificación de texto para el correo, así permite enviar ñ y letras con tilde.
    $mail->Subject = $asunto; //El asunto del correo.
    $mail->Body    = $mensaje; //El mensaje en sí. En este caso, el código aleatorio que generamos.
    if ($_REQUEST['motivo'] == "enviarEntradas") {
        $mail->AddAttachment("EntradasConfirmadas/" . $_SESSION['id_transaccion'] . ".pdf");
    }
    $mail->send(); //Se envía el correo.
    header("Location: $redirect");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo $email;
}
