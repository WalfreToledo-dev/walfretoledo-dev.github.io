<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Configurar el servidor SMTP
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'correo.conacto.to.grow@hotmail.com';
    $mail->Password = 'ToGrow2023';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;


    if (!empty($_POST)) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $whatsapp = $_POST['whatsapp'];

        $message = $_POST['message'];

        if (empty($name)) {
               $errors[] = 'Nombre no puede ir vacio';
           }

        if (empty($email)) {
               $errors[] = 'Correo no puede ir vacío';
           }

        if (empty($message)) {
               $errors[] = 'Mensaje no puede ir vacio';
           }
    }

    if (!empty($errors)) {
       $allErrors = join('<br/>', $errors);
       $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
    // Configurar el correo electrónico






    $mail->setFrom('correo.conacto.to.grow@hotmail.com', mb_encode_mimeheader($name, 'UTF-8'));
    $mail->addAddress('contacto@togrow.com.mx', 'Contacto ToGrow');

    // Configura el contenido del correo electrónico

    $subject = 'Solicitud de información desde el sitio web';
    $mail->Subject = mb_encode_mimeheader($subject, 'UTF-8');
//     $Body = 'Faltan algunos ajustes pero creo que estan en corto, ya mañanita jefazo, bueno al rato jajajaja';
    $Body = "Nombre del interesado: $name\nInformación de contacto: $whatsapp, $email\n\nMensaje es el siguiente:\n$message";
    $mail->Body = $Body;

    // Enviar el correo electrónico
    $mail->send();
     header('Location: ../contacto.html');
} catch (Exception $e) {
    echo 'El mensaje no se pudo enviar. Error: ', $mail->ErrorInfo;
}