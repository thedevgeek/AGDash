<?php
include('include/functions.php');
$count = 0;

// Connect to Database
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Get all the data from the "example" table
$result = mysql_query("SELECT * FROM employees WHERE dept = 'Infogenesis POS'") or die(mysql_error());  

// keeps getting the next row until there are no more to get
while($row = mysql_fetch_array( $result )) {
	// Print out the contents of each row into a table
	echo $row['realname'] . ' - ' . $row['tickets'] . '<br>';
	$count = $row['tickets'] + $count;
} 
echo 'Total : ' . $count;
?>
