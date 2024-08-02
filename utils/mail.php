<?php
require_once dirname(__DIR__)."/constant/constant.php";
require_once dirname(__DIR__).'/vendor/phpmailer/phpmailer/src/Exception.php';
require_once dirname(__DIR__).'/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once dirname(__DIR__).'/vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $message): bool
{
    global $application_name,$email_host,$email_port,$email_host_user,$email_host_password;
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = $email_host;
        $mail->SMTPAuth = true;
        $mail->Username = $email_host_user;
        $mail->Password = $email_host_password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = $email_port;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //Recipients
        $mail->setFrom($email_host_user, $application_name);
        $mail->addAddress($to);
        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

;

function emailTemplate($brandName, $message, $href,$buttonText,$country): string
{
    return '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div class="brand" style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #fff;text-decoration:none;font-weight:600">' . $brandName . '</a>
    </div>
    <p style="font-size:1.1em">Hi,</p>
    <p>' . $message . '</p>
    <a href="' . $href . '" style="background:#3498db;color:#fff;text-decoration:none;padding:10px 25px;display:inline-block;border-radius:5px;margin:25px 0">.' . $buttonText . '</a>
    <p style="font-size:0.9em;">Regards,<br />.' . $brandName . '</p>
    <hr style="border:none;border-top:1px solid #eee" />
    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
      <p>' . $brandName . ' Inc</p>
      <p>' . $country . '</p>
    </div>
  </div>
</div>';
};