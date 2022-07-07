<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
function send_email($emailrecipiente,$titulo, $conteudo)
{
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls"; 
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "botj6883@gmail.com";
//$mail->SMTPDebug  = 2; 
$mail->Password   = "rddmpvzbxnlfjinm";
$mail->IsHTML(true);
$mail->SetLanguage("pt", 'class/phpMailer/language/');
$mail->AddAddress($emailrecipiente, "recipient-name");
$mail->SetFrom("botj6883@gmail.com", "no-replybot");
$mail->AddReplyTo($emailrecipiente, "no-reply");
$mail->AddCC($emailrecipiente, "cc-recipient-name");
$mail->Subject = $titulo;
$content = $conteudo;
$mail->MsgHTML($content); 
if(!$mail->Send()) {
  return;
  var_dump($mail);
} else {
  return;
}}
?>