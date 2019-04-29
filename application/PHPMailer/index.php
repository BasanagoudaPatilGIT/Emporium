<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'senaidbacinovic@gmail.com';
$mail->Password = 'amy_backo31';

$mail->setFrom('senaidbacinovic@gmail.com', 'Senaid Bacinovic');
$mail->addAddress('hello@codingpassiveincome.com');
$mail->Subject = 'SMTP email test';
$mail->Body = 'this is some body';

if ($mail->send())
    echo "Mail sent";
?>