<?php
include('email_config.php');
require('phpmailer/PHPMailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->isSMTP();              
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;   
$mail->Username = EMAIL_USER;   
$mail->Password = EMAIL_PASS; 
$mail->SMTPSecure = 'tls';     
$mail->Port = 587;             
$options = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->smtpConnect($options); 
$mail->FromName = 'Collin';  
$mail->addAddress($email);                       
$mail->isHTML(true);                              
$message = 'thank you';
$mail->Subject = $message;
$mail->Body = $message;
$mail->AltBody = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>