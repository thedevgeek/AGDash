<?php
include('config.php');

// Database Connect/Select
function mySQL_conn($dbhost, $dbase, $dbuser, $dbpass) {
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) { die('Could not connect: ' . mysql_error()); }
mysql_select_db($dbase) or die( "Unable to select database<br>");
}

// msSQL Database Connect/Select
function msSQL_conn($msdbhost, $msdbase, $msdbuser, $msdbpass) {
$dbhandle = mssql_connect($msdbhost, $msdbuser, $msdbpass) or die('Could not connect to SQL Server on $msdbhost'); 
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 
}

// Zero out employees
function zero_emp($result) {
$i = 0;
while(($row = mysql_fetch_array($result)) !== false) {
	$i++;
	echo "Settings " . $row[1] . " call count to 0<br>";
	$updatedb = "UPDATE employees SET tickets=0 WHERE name='$row[1]'";
	mysql_query($updatedb);
}
}
?>
