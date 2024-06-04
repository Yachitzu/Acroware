<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
class Email
{
    public static function enviarEmail($email,$asunto,$cuerpo)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'acroware2002@outlook.com';
            $mail->Password = 'Acr@ware';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('acroware2002@outlook.com', 'Acroware');
            $mail->addAddress($email);
            $mail->Subject = $asunto;
            $mail->Body = $cuerpo;
            $mail->isHTML(true);
            if ($mail->send()){
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            echo 'Mensaje' . $mail->ErrorInfo;
        }
    }
}
