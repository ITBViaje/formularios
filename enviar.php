<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST['name']));
    $telefono = htmlspecialchars(trim($_POST['tel']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $localidad = htmlspecialchars(trim($_POST['localidad']));
    $consulta = htmlspecialchars(trim($_POST['consulta']));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'licmarialu@gmail.com'; // Tu cuenta Gmail
        $mail->Password = 'drhe uhqy bwps sebs'; // Tu clave de aplicación
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remitente fijo
        $mail->setFrom('no-reply@tusitio.com', 'Formulario Web');

        // Responder al correo del usuario
        $mail->addReplyTo($email, $nombre);

        // Destinatario: dueño del sitio
        $mail->addAddress('licmarialu@gmail.com', 'Responsable del Sitio');

        $mail->Subject = 'Nuevo mensaje desde el formulario';
        $mail->Body = "Nombre: $nombre\nTeléfono: $telefono\nEmail: $email\nLocalidad: $localidad\nConsulta: $consulta";

        $mail->send();
        header("Location: contactossi.html");
        exit;
    } catch (Exception $e) {
        echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Acceso denegado.";
}
?>
