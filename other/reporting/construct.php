<?php
// Include files
include('../functions.php');
require('includes/phpmailer/class.phpmailer.php');
require('includes/fpdf/fpdf.php');

// Set Vars
$date = date("m-d-Y_giA");
$filename = "daily/" . $date . ".pdf";
$sub_date = date('D M j, Y');
$subject = "Call count for " . $sub_date;
$shelby_c = 0;
$heart_c = 0;
$elzia_c = 0;
$tony_c = 0;
$today_date = date("Y-m-d");

// Connect to MsSQL or error, then Select
msSQL_conn($msdbhost, $msdbase, $msdbuser, $msdbpass);

// Query Database
$result = mssql_query("Select distinct CallLog.CallID from CallLog where (CallLog.ClosedBy = 'denikes' AND CallLog.ClosedDate = '$today_date' ) order by CallLog.CallID");
while ($row = mssql_fetch_row($result)) {
        $shelby_c = $shelby_c + 1;
}

// Query Database
$result = mssql_query("Select distinct CallLog.CallID from CallLog where (CallLog.ClosedBy = 'rushh' AND CallLog.ClosedDate = '$today_date' ) order by CallLog.CallID");
while ($row = mssql_fetch_row($result)) {
        $heart_c = $heart_c + 1;
}

// Query Database
$result = mssql_query("Select distinct CallLog.CallID from CallLog where (CallLog.ClosedBy = 'georget' AND CallLog.ClosedDate = '$today_date' ) order by CallLog.CallID");
while ($row = mssql_fetch_row($result)) {
        $tony_c = $tony_c + 1;
}

// Query Database
$result = mssql_query("Select distinct CallLog.CallID from CallLog where (CallLog.ClosedBy = 'eburch' AND CallLog.ClosedDate = '$today_date' ) order by CallLog.CallID");
while ($row = mssql_fetch_row($result)) {
        $elzia_c = $elzia_c + 1;
}

// Create the PDF
$pdf=new FPDF();
$title='AGDash PDF end of day call report';
$pdf->SetTitle($title);
$pdf->SetAuthor('Shelby DeNike via DenBox'); 
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',32);
$pdf->Cell(0,15,'AGDash Generated Call Counts',0,1,'C');
// $pdf->SetFont('Arial','',14);
// $pdf->Cell(0,15,'Listed as follows, Employee name, Current Open Calls, Current Closed Calls',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,4,'Shelby DeNike - Closed Calls: '.$shelby_c . ', Open Calls: ',0,1,'C');
$pdf->Cell(0,4,'Heart Rush - Closed Calls: '.$heart_c . ', Open Calls: ',0,1,'C');
$pdf->Cell(0,4,'Tony George - Closed Calls: '.$tony_c . ', Open Calls: ',0,1,'C');
$pdf->Cell(0,4,'Elzia Burch - Closed Calls: '.$elzia_c . ', Open Calls: ',0,1,'C');
$pdf->Output($filename, 'F');

// Setup the email
$mail             = new PHPMailer();
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
$mail->Subject    = $subject;
$body             = "Please see the attached PDF for call box information.";
$mail->MsgHTML($body);

// Email out to the required people.
$address = "shelby.denike@agilysys.com";
$mail->AddAddress($address, "Shelby DeNike");
$address = "tony.george@agilysys.com";
$mail->AddAddress($address, "Tony George");
$address = "heart.rush@agilysys.com";
$mail->AddAddress($address, "Heart Rush");
$address = "elzia.burch@agilysys.com";
$mail->AddAddress($address, "Elzia Burch");

// Attach the PDF
$mail->AddAttachment($filename);      // attachment

// Give status update
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
?>
