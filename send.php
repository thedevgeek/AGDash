<?php
// Include Config File
include('include/config.php');
include('include/header.php');

// Setup Connection to DBASE or error
$dbhandle = mssql_connect($msdbhost, $msdbuser, $msdbpass) or die('Could not connect to SQL Server on $msdbhost'); 

// Select Database
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 
?>
<br><center><h2>
<table border="0" cellspacing="1" cellpadding="0" width="98%">
<tbody>
<?php
require_once('include/class.phpmailer.php');
$sender_name = $_POST["name"]; 
$sender_email = $_POST["email"]; 
$sender_info = $_POST["information"]; 

$mail             = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "denbox.server@gmail.com";  // GMAIL username
$mail->Password   = "denbox878";            // GMAIL password
$mail->SetFrom($sender_email, $sender_name);
$mail->AddReplyTo($sender_email, $sender_name);
$mail->Subject    = "AGDash Bug Report";
$body             = $sender_info;
$mail->MsgHTML($body);
$address = "shelby.denike@agilysys.com";
$mail->AddAddress($address, "Shelby Denike");
if(!$mail->Send()) {
  echo "Submission Error: " . $mail->ErrorInfo;
} else {
  echo "Submission Sent!";
}
?>
</tbody>
</table>

