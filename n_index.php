<?php
include('include/functions.php');
include('include/header.php');
$dept = $_GET['dept'];
?>
<table cellspacing="0" cellpadding="0" border="0" bgcolor="#cccccc" height="100%" width="90%">
<tr>

<!-- Beging Left Column -->
<td VALIGN="top" bgcolor="white" width="30%">
<center><br>
<br>
<!-- Begin Stats -->
<?php
// Connect to Database
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
if ($dept == "") {
echo '<table border="0" cellspacing="1" cellpadding="0" width="100%">
  <thead>
   <tr>
     <th align=left><b>Department</b></th>
     <th align=right><b>Open</b></th>
   </tr>
  </thead>
<tbody>';
$pie_chart = "totals.png";
$result = mysql_query("SELECT * FROM dept ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());

$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[2] < 1) {
        // do nothing
} else {
        echo "<tr class=cclist><td align=left>" . $row[1] . "</td><td align=right>" . $row[2] . "</td></tr>\n";
}
}
} else {
echo '<table border="0" cellspacing="1" cellpadding="0" width="100%">
  <thead>
   <tr>
     <th align=left><b>Employee</b></th>
     <th align=right><b>Open</b></th>
     <th align=right><b>Closed</b></th>
   </tr>
  </thead>
<tbody>';
// Query Database
$result = mysql_query("SELECT * FROM dept WHERE name ='$dept'") or die('Query failed: ' . mysql_error());
$row = mysql_fetch_array($result);
$pie_chart = $row[3];

$result = mysql_query("SELECT * FROM employees WHERE dept='$dept' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
//      echo "<tr class=cclist><td align=left>" . $row[2] . "</td><td align=right>" . $row[3] . "</td></tr>\n";
if ($row[3] < 1) {
        // do nothing
} else {
	if ($row[7] == 1){
		if ($row[8] == 2){
	        echo '<tr class=cclist><td align=left><b>' . $row[2] . ' - VE</b></td><td align=right>' . $row[3] . "</td><td align=right>" . $row[6] . "</td></tr>\n";
		}
		if ($row[8] == ""){
	        echo '<tr class=cclist><td align=left>' . $row[2] . ' - VE</td><td align=right>' . $row[3] . "</td><td align=right>" . $row[6] . "</td></tr>\n";
		}
	} else {
		if ($row[8] == 2){
	        echo '<tr class=cclist><td align=left><b>' . $row[2] . "</b></td><td align=right>" . $row[3] . "</td><td align=right>" . $row[6] . "</td></tr>\n";
		}
	        if ($row[8] == ""){
	        echo '<tr class=cclist><td align=left>' . $row[2] . "</td><td align=right>" . $row[3] . "</td><td align=right>" . $row[6] . "</td></tr>\n";
		}
}
}
}
}
?>

<!-- Print out Info Box -->
<br>
</tbody>
</table>
<?php 
if ($dept == "") {
echo '<br><br>
<div style="border: 1px dotted #ccc;">
<br>Looking to have AGDash at your fingertips? then <a href="http://denbox/agdashwin">Download AGDashWin</a> for your desktop.<br><br>
</div>';} else {
echo '<br><small>All Closed stats are based on 12:01am - Current time PST</small>';
} ?>
</center>
</td>

<!-- Beging Right Column -->
<td VALIGN="top" bgcolor="white" width="70%">
<center>
<br><br>
<div id="page_effect" style="display:none;">
	<img align="center" src="img/<?php echo $pie_chart;?>">
</div>
</center>
</td>
</tr>
</table>
<br>
<?php include('include/jokes.php');?>

</center>
<?php
include('include/footer.php');
ob_end_flush();
?>
