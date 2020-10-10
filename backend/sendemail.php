<?php

$data = json_decode(file_get_contents('php://input'), true);

$email = "admin@admin.com";

$header = 'From: ' . $email . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

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

var_dump($message); die;

try {
    if (mail($para, $asunto, utf8_decode($message), $header)) {
        echo "Mensaje Enviado Correctamene, nos podremos en contacto con Usted";
    } else {
        echo "Mensaje no Enviado";
    }
} catch (Exception $e) {
    var_dump($e);
}


var_dump($message);
?>