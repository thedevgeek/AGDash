<?php
// Include Config File
include('../config.php');

// Setup Vars
$total_closed = "";

// Get date, and set all time vars
$today_date = date("Y-m-d");
$current_time = date("G:i:s");
$start_time = "00:00:00";
$end_time = "23:59:59";

$start_date = $today_date;
$end_date = $today_date;

// $start_date = $_GET['sdate'];
// $end_date = $_GET['edate'];
// $dept = $_GET['dept'];

// Connect to MySQL or error
$mydbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$mydbconnect) {die('Could not connect: ' . mysql_error());}

// Connect to MsSQL or error, then select Database, then Query
$msdbconnect = mssql_connect($msdbhost, $msdbuser, $msdbpass);
if (!$msdbconnect) {die('Could not connect: ' . mssql_error());}
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 
$result = mssql_query("select distinct(groupname),Assignee,COUNT(ClosedBy) as 'ClosedCount' from Asgnmnt join calllog on asgnmnt.callid=calllog.callid where CallLog.CallStatus = 'Closed' and (asgnmnt.dateresolv between '$start_date' and '$end_date') and (ClosedDate between '$start_date' and '$end_date') and (ClosedTime between '$start_time' and '$end_time') AND whoresolv IS NOT NULL group by Assignee,groupname order by ClosedCount DESC");
while ($row = mssql_fetch_row($result)) {
    $total_closed = $total_closed + $row[2];
}
echo $total_closed;
?>
