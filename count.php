<?php
// Include Functions File
include('include/functions.php');

// Connect to MsSQL or error, then Select
msSQL_conn($msdbhost, $msdbase, $msdbuser, $msdbpass);

// Query Database
$result = mssql_query("SELECT COUNT(CL.CallID) AS AspCalls FROM  [CallLog] CL, [Profile] P WHERE CL.CustID = P.CustID AND (CL.CallStatus IN ('Open', 'Reopened')) AND (P.RevelationType IN ('REV ASP LV', 'REV ASP SJ'))");

// Loop through the results and display to screen
echo "Open VE Tickets: ";
while ($row = mssql_fetch_row($result)) {
	echo $row[0];
    }
//echo "<br>";
// Query Database
// $result = mssql_query("SELECT COUNT(CL.CallID) AS AspCalls FROM  [CallLog] CL, [Profile] P WHERE CL.CustID = P.CustID AND (CL.CallStatus IN ('Open', 'Reopened')) AND (P.RevelationType IN ('Revelation', 'Mutli Ag Prod', ''))");
// Loop through the results and display to screen
// echo "Open Traditional Tickets: ";
// while ($row = mssql_fetch_row($result)) {
// 	echo $row[0];
//    }
?>
