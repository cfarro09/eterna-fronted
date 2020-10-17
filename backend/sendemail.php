<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

$message = "<ul>
<li>Nombre: ". $data["nombre"]."</li>
<li>Correo: ". $data["email"]."</li>
<li>Teléfono: ". $data["telefono"]."</li>
<li>Fecha: ". "Fecha: " . date('d/m/Y', time()). "</li>";

if (isset($data["distrito"]))
    $message .= "<li>Distrito: ". $data["distrito"]."</li>";
if (isset($data["provincia"]))
    $message .= "<li>Provincia: ". $data["provincia"]."</li>";

$message .= "</ul>";

$asunto = $data["subject"];

$mail = new PHPMailer;

try {
    $mail->isSMTP(); // tell to use smtp
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->CharSet = "utf-8"; // set charset to utf8
    $mail->SMTPAuth = false;  // use smpt auth
    $mail->SMTPSecure = "tls"; // or ssl
    $mail->Host = "158.69.156.166";
    $mail->Port = 25; // most likely something different for you. This is the mailtrap.io port i use for testing. 
    $mail->setFrom("noreply@eterna.com.pe", "Firstname Lastname");
    $mail->Subject = $asunto;
    $mail->MsgHTML($message);
    $mail->addAddress("contacto@eterna.com.pe", "Recipient Name");
    $mail->send();
} catch (Exception $e) {
    dd($e);
}
die('success');
