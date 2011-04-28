<?php
// Include Config File
include('include/config.php');
include('include/header.php');

// Setup Connection to DBASE or error
$dbhandle = mssql_connect($msdbhost, $msdbuser, $msdbpass) or die('Could not connect to SQL Server on $msdbhost'); 

// Select Database
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 
?>
<br><center><h2>
Listed tickets are not assigned to a correct department, they are simple assigned to "Support".
</h2>If you see your name here please check your tickets to make sure they are assigned correctly.</center>
<table border="0" cellspacing="1" cellpadding="0" width="98%">
  <thead>
   <tr>
     <th align=left><b>Employee Name</b></th>
     <th align=right><b>Tickets</b></th>
   </tr>
  </thead>
<tbody>
<?php
$result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by groupname,boxcount DESC");
while ($row = mssql_fetch_row($result)) {
if ($row[0] == "Support") {
    echo "<tr class=cclist><td align=left>" . $row[1] . "</td><td align=right>" . $row[2] . "</td></tr>\n";
} else {
// Do Nothing
}
}
//close the connection
mssql_close($dbhandle);
?>
</tbody>
</table>

