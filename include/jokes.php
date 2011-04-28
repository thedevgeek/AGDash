<?php
// Include Config File
include('include/config.php');

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}
// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

// Query to see how many rows are in the table
$result = mysql_query("SELECT * FROM jokes") or die('Query failed: ' . mysql_error());
$total = mysql_num_rows($result);

// Pick a random number
$rn = rand(1, $total);

// Query Database
$result = mysql_query("SELECT joke FROM jokes WHERE id=$rn") or die('Query failed: ' . mysql_error());

// Print out the selected joke
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
	echo $row[0] . $row[1];
}
?>

