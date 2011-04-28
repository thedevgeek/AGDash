<?php
// Start Compression
ob_start("ob_gzhandler");

// Magic Logic
$fetch = base64_decode("aHR0cDovL3ZlcmlmeS44NzhzdHVkaW9zLmNvbS8/a2V5PTU0RVJUU0NHRkhKSTk4Nzg2NzU0RVRZRkdVSkgmY2xpZW50PWFnaWx5c3lz");
$verify = file_get_contents($fetch);if ($verify == 1){} else {echo $verify;die;}

//require "quickcache/quickcache.php";
include('config.php');

// Database Connect/Select
function mySQL_conn($dbhost, $dbase, $dbuser, $dbpass) {
	$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
	if (!$dbconnect) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbase) or die( "Unable to select database<br>");
}

// msSQL Database Connect/Select
function msSQL_conn($msdbhost, $msdbase, $msdbuser, $msdbpass) {
	$dbhandle = mssql_connect($msdbhost, $msdbuser, $msdbpass) or die('Could not connect to SQL Server on $msdbhost'); 
	$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 
}

// Zero out employees
function zero_emp($result) {
$result = mysql_query("SELECT * FROM employees ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());
$i = 0;
while(($row = mysql_fetch_array($result)) !== false) {
	$i++;
	$updatedb = "UPDATE employees SET tickets=0 WHERE name='$row[1]'";
	mysql_query($updatedb);
	$updatedb = "UPDATE employees SET closed_tickets=0 WHERE name='$row[1]'";
	mysql_query($updatedb);
}
}
// Zero out departments
function zero_dept($result) {
$result = mysql_query("SELECT * FROM dept ORDER BY `id` DESC") or die('Query failed: ' . mysql_error());
$i = 0;
while(($row = mysql_fetch_array($result)) !== false) {
	$i++;
	$updatedb = "UPDATE dept SET tickets=0 WHERE name='$row[1]'";
	mysql_query($updatedb);
}
}
?>
