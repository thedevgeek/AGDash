<?php
include('include/functions.php');
include('include/header.php');
$dept = $_GET['dept'];
?>
<table cellspacing="0" cellpadding="0" border="0" bgcolor="#cccccc" height="100%" width="98%">
<tr>

<!-- Beging Left Column -->
<td VALIGN="top" bgcolor="white" width="38%">
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
     <th align=right><b>O</b></th>
     <th align=right><b>C</b></th>
<!--     <th align=right><b>J</b></th>
     <th align=right><b>TO</b></th> -->
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
	if ($row[VE] == 1){
		if ($row[level] == 2){
	        echo '<tr class=cclist>
<td align=left><b>' . $row[2] . ' - VE</b></td>
<td align=right>' . $row[3] . "</td>
<td align=right>" . $row[6] . "</td>
<!-- <td align=right>" . $row[7] . "</td>
<td align=right>" . $row[8] . "</td> -->
</tr>\n";
		}
		if ($row[level] == ""){
	        echo '<tr class=cclist>
<td align=left>' . $row[2] . ' - VE</td>
<td align=right>' . $row[3] . "</td>
<td align=right>" . $row[6] . "</td>
<!-- <td align=right>" . $row[7] . "</td>
<td align=right>" . $row[8] . "</td> -->
</tr>\n";
		}
	} else {
		if ($row[level] == 2){
	        echo '<tr class=cclist>
<td align=left><b>' . $row[2] . "</b></td>
<td align=right>" . $row[3] . "</td>
<td align=right>" . $row[6] . "</td>
<!-- <td align=right>" . $row[7] . "</td>
<td align=right>" . $row[8] . "</td> -->
</tr>\n";
		}
	        if ($row[level] == ""){
	        echo '<tr class=cclist>
<td align=left>' . $row[2] . "</td>
<td align=right>" . $row[3] . "</td>
<td align=right>" . $row[6] . "</td>
<!-- <td align=right>" . $row[7] . "</td>
<td align=right>" . $row[8] . "</td> -->
</tr>\n";
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
<br>Looking to have AGDash at your fingertips? then <a href="http://denbox/agdashwin">Download AGDashWin</a> for your desktop. Or <a href="http://denbox/shelby/chrome">Download</a> the Google Chrome plugin<br><br>
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
<br><br><br><br>
<center><h2>Pie Charts are<br>currently disabled.</h2></center>
<!-- <?php echo '<img align="center" src="img/' . $pie_chart . '">';?> -->
</div>
</center>
</td>
</tr>
</table>
<?php //include('include/miners.php');?>
<br>
<?php include('include/jokes.php');?>
</center>
<?php
include('include/footer.php');
ob_end_flush();
?>
