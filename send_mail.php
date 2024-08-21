<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Debug: Muestra los datos recibidos
file_put_contents('debug.txt', print_r($_POST, true));

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'felipe.291105@gmail.com'; // Tu correo
    $mail->Password = 'rmur vofh lapd telo'; // Contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('felipe.291105@gmail.com', 'Cristian Carmona');
    $mail->addAddress('felipe.291105@gmail.com'); // Cambia el destinatario según sea necesario

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Mensaje de Contacto desde el Formulario';

    // Crea el cuerpo del correo con los datos del formulario
    $body = '<h1>Datos del Contacto</h1>';
    $body .= '<p><strong>Nombre:</strong> ' . htmlspecialchars($_POST['nombre']) . '</p>';
    $body .= '<p><strong>Teléfono:</strong> ' . htmlspecialchars($_POST['telefono']) . '</p>';
    $body .= '<p><strong>Correo:</strong> ' . htmlspecialchars($_POST['correo']) . '</p>';
    $body .= '<p><strong>Tema:</strong> ' . htmlspecialchars($_POST['tema']) . '</p>';
    $body .= '<p><strong>Mensaje:</strong><br>' . nl2br(htmlspecialchars($_POST['mensaje'])) . '</p>';

    $mail->Body = $body;

    // Envía el correo
    $mail->send();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
}
?>
