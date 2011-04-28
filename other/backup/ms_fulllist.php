<?php
// Include Config File
include('../config.php');

// Setup Connection to DBASE or error
$dbhandle = mssql_connect($msdbhost, $msdbuser, $msdbpass) or die('Could not connect to SQL Server on $msdbhost'); 

// Grab Server Version information
$version = mssql_query('SELECT @@VERSION');
$row = mssql_fetch_array($version);
echo '<small><b>Server Information:</b> ' . $row[0] . '</small><hr>';

// Select Database
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 

// Get information from tables
// $query = "select Groupname from Asgnmnt";
// $result = mssql_query($query) or die("Query has a problem : $query");
// echo $query . '<BR><hr>';
// echo $result;

$result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by groupname,boxcount DESC");
while ($row = mssql_fetch_row($result)) {
    printf("%s %s<BR>\n", $row[2], $row[1]);
}

//close the connection
mssql_close($dbhandle);
?>
