<?php
// Include Functions File
include('include/functions.php');

// Setup Vars
$total = 0;
$today_date = date("Y-m-d");
$user = "denikes";

// Connect to MsSQL or error, then Select
msSQL_conn($msdbhost, $msdbase, $msdbuser, $msdbpass);

// Query Database
$result = mssql_query("Select distinct CallLog.CallID from CallLog where (CallLog.ClosedBy = '$user' AND CallLog.ClosedDate = '$today_date' ) order by CallLog.CallID");

// Loop through the results and display to screen
echo '<b><font color="red">Open VE Calls</font></b> user: ' . $user . '<br>', chr(10);
while ($row = mssql_fetch_row($result)) {
    $total = $total + 1;
//    echo 'Ticket: ' . $row[0] . '<br>', chr(10);
    }
echo 'Total closed today: <b><u>' . $total . '</u></b><hr>', chr(10);

// Connect to MySQL dbase and get usernames
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE `dept`='Infogenesis POS' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());

?>
