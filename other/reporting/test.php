<?php
require_once('includes/phpmailer/class.phpmailer.php');

$mail             = new PHPMailer();
//$body             = file_get_contents('contents.html');
//$body             = eregi_replace("[\]",'',$body);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "denbox.server@gmail.com";  // GMAIL username
$mail->Password   = "denbox878";            // GMAIL password
$mail->SetFrom('shelby.denike@agilysys.com', 'DenBox Server');
$mail->AddReplyTo("shelby.denike@agilysys.com","DenBox Server");
$mail->Subject    = "Subject";
$body		  = "This is the message body, whatever I type in here gets mailed in the body";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = "shelby.denike@agilysys.com";
$mail->AddAddress($address, "Shelby Denike");
//$mail->AddAttachment("images/");      // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
    
?>
