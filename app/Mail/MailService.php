<?php

// app/Mail/MailService.php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class MailService
{
    public function sendEmail($to, $subject, $message)
    {

        try {

            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kalukav55@gmail.com';
            $mail->Password = 'yqxkfutrrtisngcm';
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPSecure = null;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom($to, 'Sender Name');
            $mail->addAddress('kalukav55@gmail.com', 'Recipient Name');

            //Content
            $mail->isHTML(true);
            $mail->addReplyTo($to, 'Information');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

?>
