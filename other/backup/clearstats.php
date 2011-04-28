<?php
include('config.php');

/// Clear Employee Call Counts
// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}
// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

// Query Database
$result = mysql_query("SELECT * FROM employees ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
   echo "Settings " . $row[1] . " call count to 0<br>";
   $updatedb = "UPDATE employees SET tickets=0 WHERE name='$row[1]'";
   mysql_query($updatedb);
}
?>
