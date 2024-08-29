<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['submitEmail'])) {

    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pontillojoshua024@gmail.com'; // SMTP username
        $mail->Password   = 'pfvjicwhgqckrvhq'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //'ssl'; //PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 465; //587;

        //Recipients
        $mail->setFrom('crymwach@gmail.com', 'CRYMWACH');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = "CRYMWACH";
        $mail->send();
        //  echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request method.';
}
