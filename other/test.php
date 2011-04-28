<?php
include('functions.php');
include("pChart/pData.class");
include("pChart/pChart.class");

// Clear Employee Call Counts
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database for departments
$dept_query = "SELECT * FROM `dept`";
$dept_result = mysql_query($dept_query) or die('Query failed: ' . mysql_error());

// Create Array
while($dept_row = mysql_fetch_array($dept_result)){
$dept_array[$dept_row['name']] = 1;
//$dept_array[] = $dept_row['name'];
}
$num_rows = mysql_num_rows($dept_result);
echo $num_rows;
echo $dept_array[0];

print_r($dept_array);
?>
