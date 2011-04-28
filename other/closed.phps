<?php
// Include Config File
include('config.php');

// Setup Vars
$total_closed = "";

// Get date, and set all time vars
$today_date = date("Y-m-d");
$current_time = date("G:i:s");
$start_time = "00:00:00";
$end_time = "23:59:59";

$start_date = $_GET['sdate'];
$end_date = $_GET['edate'];
$dept = $_GET['dept'];
?>
<!-- Begin HTML -->
<html>
<head>
<title>Closed Calls</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/date.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.datePicker.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
</head>
<body>
<form name="chooseDateForm" id="chooseDateForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
<fieldset>
<legend>Select Filter Dates</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<input name="sdate" id="start_date" class="date-pick" value="<?php echo $today_date;?>">
	<input name="edate" id="end_date" class="date-pick" value="<?php echo $today_date;?>">
	<select name="dept">
	    <option value="All" selected>All</option>
	    <option value="InfoGenesis POS">InfoGenesis POS</option>
	    <option value="V1">V1</option>
	    <option value="IG Customer Service">IG Customer Service</option>
	    <option value="DMS">DMS</option>
	    <option value="Eatec">Eatec</option>
	    <option value="Guest 360">Guest 360</option>
	    <option value="Escalate to QA">Escalate to QA</option>
	    <option value="Level III Escalations">Level III Escalations</option>
	    <option value="QA">QA</option>
	    <option value="LMS">LMS</option>
	    <option value="LMS DEV">LMS DEV</option>
	    <option value="UK POS">UK POS</option>
	</select>
	<input type="submit" value="Submit">
    </td>
    <td>
<?php
// Check to see if any dates were sent, and give error or proceed
if ( $start_date == NULL ) {
	echo '	<center><blink>Please select a date</blink></center>';
	die;
} else {
	echo '	<center>Closed Calls from ' . $start_date . ' - ' . $end_date . ', ' . $start_time . ' - ' . $end_time . '</center>';
}
echo '
    </td>
  </tr>
</table>
</fieldset>
</form>';

// Connect to MySQL or error
$mydbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$mydbconnect) {die('Could not connect: ' . mysql_error());}

// Connect to MsSQL or error, then select Database, then Query
$msdbconnect = mssql_connect($msdbhost, $msdbuser, $msdbpass);
if (!$msdbconnect) {die('Could not connect: ' . mssql_error());}
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 
$result = mssql_query("select distinct(groupname),Assignee,COUNT(ClosedBy) as 'ClosedCount' from Asgnmnt join calllog on asgnmnt.callid=calllog.callid where CallLog.CallStatus = 'Closed' and (asgnmnt.dateresolv between '$start_date' and '$end_date') and (ClosedDate between '$start_date' and '$end_date') and (ClosedTime between '$start_time' and '$end_time') AND whoresolv IS NOT NULL group by Assignee,groupname order by ClosedCount DESC");

// less crapy temp header
?>


<center>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td><b>Employee</b></td>
  <td><b>Heat Name</b></td>
  <td><b>Department</b></td>
  <td><b>Tickets</b></td>
</tr>
<?php
// Loop through the results and display to screen
while ($row = mssql_fetch_row($result)) {

	// Set Vars for loop
	$heat_name = $row[1];

	// Match heat name to users real name
	mysql_select_db($dbase) or die( "Unable to select database<br>");
	$myresult = mysql_query("SELECT * FROM employees WHERE name='$heat_name'") or die('Query failed: ' . mysql_error());
	$myrow = mysql_fetch_array( $myresult );

	// Print Information to Screen
	if ( $row[0] == $dept ) {
		echo '<tr>
	  <td>' . $myrow[2] . '</td>
	  <td>' . $row[1] . '</td>
	  <td>' . $row[0] . '</td>
	  <td>' . $row[2] . '</td>
	  </tr>' . "\n";
	$total_closed = $total_closed + $row[2];
	}

	if ( $dept == "All" ) {
		echo '<tr>
	  <td>' . $myrow[2] . '</td>
	  <td>' . $row[1] . '</td>
	  <td>' . $row[0] . '</td>
	  <td>' . $row[2] . '</td>
	</tr>' . "\n";
	$total_closed = $total_closed + $row[2];
	}
}
echo '<tr>
  <td>Total</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>' . $total_closed . 
'</td>
</tr>
</table>
</center>
';
?>
</body>
</html>
