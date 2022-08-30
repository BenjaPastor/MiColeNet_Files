<?php
use \PHPMailer\PHPMailer\Exception;
use \PHPMailer\PHPMailer\PHPMailer;
require '../../../Model/PHPMailer/Exception.php';
require '../../../Model/PHPMailer/PHPMailer.php';
require '../../../Model/PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    $nombre = $_POST["name"];
    $email = $_POST["email"];
    $asunto = $_POST["subject"];
    $mensaje = $_POST["message"];

    //Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output
    $mail->isSMTP(); // Send using SMTP
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'bpastoraltea@gmail.com'; // SMTP username
    $mail->Password = 'B3nj4m1n!2015'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 587; // TCP port to connect to

    $mail->setFrom('info@micole.net', 'MiCole.net');
    $mail->addAddress('benja@infoaltea.net', 'Benja'); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Nuevo contacto desde MiCole.net';
    $mail->Body = 'Nombre: '. $nombre;
    $mail->Body .= 'Email: '. $email;
    $mail->Body .= 'Asunto: '. $asunto;
    $mail->Body .= 'Mensaje: '. $mensaje;

    $mail->send();
    echo 'OK';
    

} catch (Exception $e) {
    echo "Mensaje NO enviado. Mailer Error: {$mail->ErrorInfo}";
}


