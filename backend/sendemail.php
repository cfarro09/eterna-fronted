<?php

$data = json_decode(file_get_contents('php://input'), true);

$email = "admin@admin.com";


$message = "Este mensaje fue enviado por: " . $data["nombre"] . " \r\n";
$message .= "Su e-mail es: " . $data["email"] . " \r\n";
$message .= "Su Asunto es: " . $data["subject"] . " \r\n";
$message .= "Su telefono es: " . $data["telefono"] . " \r\n";

if (isset($data["distrito"]))
    $message .= "Su distrito es: " . $data["distrito"] . " \r\n";

if (isset($data["residencia"]))
    $message .= "Su residencia es: " . $data["residencia"] . " \r\n";

$message .= "Enviado el: " . date('d/m/Y', time());

$para = 'fdcarlosd1@gmail.com';
$asunto = $data["subject"];

$ff = mail($para, $asunto, $message, $header);

var_dump($ff);
die;

require 'phpmailer/class.phpmailer.php';

$mail = new PHPMailer;
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';  // Specify main and backup server
$mail->SMTPAuth = false;                               // Enable SMTP authentication
//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'admin@eterna.com';
$mail->FromName = 'Administrador de correo';
$mail->AddAddress($para);  // Add a recipient
$mail->IsHTML(true);        // Set email format to HTML
$mail->Subject = $asunto;
$mail->Body = $message;

if (!$mail->Send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    print_r($mail);
    exit;
}

echo "Message has been sent\n";


// try {

//     if (mail($para, $asunto, utf8_decode($message), $header)) {
//         echo "Mensaje Enviado Correctamene, nos podremos en contacto con Usted";
//     } else {
//         echo "Mensaje no Enviado";
//     }
// } catch (Exception $e) {
//     var_dump($e);
// }


// var_dump($message);
