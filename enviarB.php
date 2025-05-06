<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST['name']));
    $telefono = htmlspecialchars(trim($_POST['tel']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $localidad = htmlspecialchars(trim($_POST['localidad']));
    $consulta = htmlspecialchars(trim($_POST['consulta']));

    $to = "tuemail@dominio.com";
    $subject = "Nuevo mensaje de contacto";
    $message = "Nombre: $nombre\nTeléfono: $telefono\nEmail: $email\nLocalidad: $localidad\nConsulta: $consulta";
    $headers = "From: no-reply@tudominio.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        header("Location: contactossi.html");
        exit;
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "Acceso denegado.";
}
?>