<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$email = isset($_POST['email']) ? $_POST['email'] : null;
$subject = isset($_POST['subject']) ? $_POST['subject'] : 'Konu';
$content = isset($_POST['content']) ? $_POST['content'] : null;

if (!$email) {
    echo "E-posta adresini girin";
} elseif (!$content) {
    echo "Lütfen mail içeriğini giriniz";
} else {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth   = true; //Enable SMTP authentication
        $mail->Username   = 'semih2626eski@gmail.com'; //SMTP username
        $mail->Password   = 'h5n4xsgc'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption
        $mail->Port       = 587; //TCP port to connect to
        $mail->CharSet    = 'UTF-8'; //Set charset to UTF-8

        //Recipients
        $mail->setFrom('semih2626eski@gmail.com', 'semih karatas');
        $mail->addAddress($email); //Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
        echo 'Mesajınız başarıyla gönderildi.';
    } catch (Exception $e) {
        echo "Mesaj gönderilemedi. Hata: {$mail->ErrorInfo}";
    }
}
?>