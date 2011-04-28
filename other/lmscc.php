<table border="0" cellspacing="1" cellpadding="0" width="100%">
  <thead>
   <tr>
     <th align=left><b>Employee Name</b></th>
     <th align=right><b>Tickets</b></th>
   </tr>
  </thead>
<tbody>
<?php
// Include Config File
include('config.php');

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}
// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='LMS' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
        echo "<tr class=cclist><td align=left>" . $row[2] . "</td><td align=right>" . $row[3] . "</td></tr>\n";
}
}
?>
<br>
</tbody>
</table>

