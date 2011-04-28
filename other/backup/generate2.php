<?php
// Include Config File
include('config.php');
include('functions.php');
include("pChart/pData.class");  
include("pChart/pChart.class");  

// Clear Employee Call Counts

mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
// $result = mysql_query("SELECT * FROM dept ORDER BY `id` DESC") or die('Query failed: ' . mysql_error());
$result = mysql_query("SELECT * FROM dept") or die('Query failed: ' . mysql_error());

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
   echo $row[1] . '<br>';
//   $updatedb = "UPDATE employees SET tickets=0 WHERE name='$row[1]'";
   mysql_query($updatedb);
}
?>
