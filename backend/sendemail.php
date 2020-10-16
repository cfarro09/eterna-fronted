<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
