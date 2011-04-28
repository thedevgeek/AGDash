<?php
include('functions.php');

mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);
$result = mysql_query("SELECT * FROM dept") or die('Query failed: ' . mysql_error());

$i = 0;
while(($row = mysql_fetch_array($result)) !== false) {
	$i++;
	$departments[] = $row[1];
}

echo '<pre>';
print_r($departments);
echo '</pre>';
?>
