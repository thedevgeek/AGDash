<?php
// Include Files
include('include/functions.php');
include('include/pChart/pData.class');  
include('include/pChart/pChart.class');  

// Set Vars
$today_date = date("Y-m-d");

// Zero Employees/Department
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);
zero_emp($result);
zero_dept($result);

// Connect to MsSQL or error, then Select
msSQL_conn($msdbhost, $msdbase, $msdbuser, $msdbpass);
$ms_result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by boxcount DESC");

// Query Database for departments and create array of departments
$dept_query = "SELECT * FROM `dept`";
$dept_result = mysql_query($dept_query) or die('Query failed: ' . mysql_error());
while($dept_row = mysql_fetch_array($dept_result)){$dept_array[$dept_row['name']] = 1;}

// Process information one employee at a time, matching to a department.
while ($ms_row = mssql_fetch_row($ms_result)) {
if($dept_array[$ms_row[0]]) {
	// Set Closed total to Zero and start again
	$closed_total = 0;

	// Update Employee tickets
	mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);
	$emp_ticket_update = "UPDATE employees SET tickets='$ms_row[2]' WHERE name='$ms_row[1]' AND dept='$ms_row[0]'";
	mysql_query($emp_ticket_update);

	// Setup Department name
	$closed_name = $ms_row[1];
	$closed_dept = $ms_row[0];
	$dept_name = $ms_row[0];
	$dept_ticket_add = $ms_row[2];

	// Query Database
	$dept_ticket_result = mysql_query("SELECT * FROM `dept` WHERE `name` = '$dept_name'") or die('Query failed: ' . mysql_error());

	// Fetch Current Ticket count and update 
	$dept_tickets = mysql_fetch_array($dept_ticket_result) or die(mysql_error());
	$new_count = $dept_tickets['tickets'] + $dept_ticket_add;
	$dept_ticket_update = mysql_query("UPDATE `dept` SET `tickets` =  '$new_count' WHERE `name` = '$dept_name' LIMIT 1") or die('Query failed: ' . mysql_error());

	// SETUP THE CLOSED COUNTS
	// Query Database
	$closed_result = mssql_query("Select distinct CallLog.CallID from CallLog where (CallLog.ClosedBy = '$closed_name' AND CallLog.ClosedDate = '$today_date' ) order by CallLog.CallID");

	// Loop through the results and display to screen
	while ($closed_row = mssql_fetch_row($closed_result)){
	$closed_total = $closed_total + 1;
	}
	// Query Database, updated closed ticket count
	$closed_mysql_result = mysql_query("UPDATE `employees` SET `closed_tickets` = '$closed_total' WHERE `name` = '$closed_name' AND `dept` = '$closed_dept' LIMIT 1") or die('Query failed: ' . mysql_error());
}}

// Update the IG POS Department
$ig_pos_count = 0;
$result = mysql_query("SELECT * FROM employees WHERE dept = 'Infogenesis POS'") or die(mysql_error());
while($row = mysql_fetch_array( $result )) {
        $ig_pos_count = $row['tickets'] + $ig_pos_count;
}
$correct_igpos = mysql_query("UPDATE `dept` SET `tickets` =  '$ig_pos_count' WHERE `name` = 'Infogenesis POS' LIMIT 1") or die('Query failed: ' . mysql_error());
// End IG Department Fix

$dept_query = "SELECT * FROM `dept`";
$dept_result = mysql_query($dept_query) or die('Query failed: ' . mysql_error());

// Create Pie Charts
while($dept_row = mysql_fetch_array($dept_result)){
// echo "Creating pie chart for " . $dept_row[1] . "<br>";

// Include Hot Fix File (Needs resolved)
include('chart_hot_fix.php');

// Init Arrays
$pie_namelist = array();
$pie_ticketlist = array();

// Query Database
$pie_result = mysql_query("SELECT * FROM employees WHERE dept='$dept_row[1]' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Create the Arrays
$i = 0;
while(($pie_row = mysql_fetch_array($pie_result)) !== false){
$i++;
if ($pie_row[3] < 1) { /* Do nothing, this shold be addressed to fix the Fake Employee */ } else {
	array_push($pie_namelist, $pie_row[2]);
	array_push($pie_ticketlist, $pie_row[3]);
}}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($pie_ticketlist),"Serie1");  
$DataSet->AddPoint(array($pie_namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  

// Initialise the graph
$Test = new pChart(570,400);
$Test->loadColorPalette("include/pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,341,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,343,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("include/pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
$Test->Render("img/$dept_row[3]");  
}

// Create Totals Chart
// Init Arrays
$pie_namelist = array();
$pie_ticketlist = array();

// Query Database
$pie_result = mysql_query("SELECT * FROM dept ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Create the Arrays
$i = 0;
while(($pie_row = mysql_fetch_array($pie_result)) !== false){
$i++;
if ($pie_row[2] < 1) { /* Do nothing, this shold be addressed to fix the Fake Employee */ } else {
	array_push($pie_namelist, $pie_row[1]);
	array_push($pie_ticketlist, $pie_row[2]);
}}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($pie_ticketlist),"Serie1");  
$DataSet->AddPoint(array($pie_namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  

// Initialise the graph
$Test = new pChart(570,400);
$Test->loadColorPalette("include/pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,341,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,343,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("include/pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
$Test->Render("img/totals.png");  
?>
