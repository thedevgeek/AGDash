<?php
echo "<H1>Agilysys Call Count</H1>";
// Include Config File
include('../config.php');

// Setup Connection to DBASE or error
$dbhandle = mssql_connect($msdbhost, $msdbuser, $msdbpass) or die('Could not connect to SQL Server on $msdbhost'); 

// Select Database
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 

$result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by groupname,boxcount DESC");
// NOT SO OLD $result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by Groupname,boxcount,Assignee DESC");
// $result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by boxcount DESC");
while ($row = mssql_fetch_row($result)) {
//    printf("%s %s<BR>\n", $row[2], $row[1]);
// print_r($row);
// row[0] - Department
// row[1] - Call Count
// row[2] - Name

if ($row[0] == "InfoGenesis POS") {
    echo '<BR>' .  $row[0] . ' - ' . $row[2] . ' - ' . $row[1];
// } elseif ($row[0] == "Applications Hosting") {
//     echo '<BR><font color="blue"><b>' .  $row[0] . '</font></b> - ' . $row[2] . ' - ' . $row[1];
// } elseif ($row[0] == "DMS") {
//     echo '<BR><font color="green"><b>' .  $row[0] . '</font></b> - ' . $row[2] . ' - ' . $row[1];
// } elseif ($row[0] == "Eatec") {
//     echo '<BR><font color="yellow"><b>' .  $row[0] . '</font></b> - ' . $row[2] . ' - ' . $row[1];
} else {
    echo '<BR>' .  $row[0] . ' - ' . $row[2] . ' - ' . $row[1];
}
}

//close the connection
mssql_close($dbhandle);
?>
