<?php
// Include Config File
// include('config.php');
include('functions.php');
include("pChart/pData.class");  
include("pChart/pChart.class");  

// Clear Employee Call Counts
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());

// Zero out employee numbers and display them
zero_emp($result);

// Connect to MsSQL or error, then Select
msSQL_conn($msdbhost, $msdbase, $msdbuser, $msdbpass);

$result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by boxcount DESC");

// Setup Ticket Totals
zero_tickets();

while ($row = mssql_fetch_row($result)) {
if ($row[0] == "InfoGenesis POS") {

	mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);
	// Print Information to Screen
        echo '<b><font color="red">Infogenesis POS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$igposcount = $row[2] + $igposcount;
	echo 'POS COUNT UPPED TO : ' . $igposcount;
        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='InfoGenesis POS'";
        mysql_query($updatedb);
	
} elseif ($row[0] == "Guest 360") {
	// Connect and Select
	mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="blue">Guest 360 record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

        $guest360count = $row[2] + $guest360count;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='Guest 360'";
        mysql_query($updatedb);

} elseif ($row[0] == "IG Customer Service") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="purple">IG Customer Service record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

        $igcscount = $row[2] + $igcscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='IG Customer Service'";
        mysql_query($updatedb);

} elseif ($row[0] == "Level III Escalations") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="blue">Level III Escalations record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$lvl3count = $row[2] + $lvl3count;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='Level III Escalations'";
        mysql_query($updatedb);

} elseif ($row[0] == "V1") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="green">V1 record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$v1count = $row[2] + $v1count;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='V1'";
        mysql_query($updatedb);

} elseif ($row[0] == "V1 INTS") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="#999">V1 INTS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$v1intscount = $row[2] + $v1intscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='V1 INTS'";
        mysql_query($updatedb);

} elseif ($row[0] == "V1 NET") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="#fcc">V1NET record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$v1netcount = $row[2] + $v1netcount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='V1 NET'";
        mysql_query($updatedb);

} elseif ($row[0] == "MMS") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="black">MMS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$mmscount = $row[2] + $mmscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='MMS'";
        mysql_query($updatedb);

} elseif ($row[0] == "IG Customer Service") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="purple">IG Customer Service record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$igcscount = $row[2] + $igcscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='IG Customer Service'";
        mysql_query($updatedb);

} elseif ($row[0] == "LMS") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="orange">LMS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$lmscount = $row[2] + $lmscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='LMS'";
        mysql_query($updatedb);

} elseif ($row[0] == "LMS DEV") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="#999">LMS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$lmsdevcount = $row[2] + $lmsdevcount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='LMS DEV'";
        mysql_query($updatedb);

} elseif ($row[0] == "Interface Team") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="brown">Interface Team record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$intcount = $row[2] + $intcount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='Interface Team'";
        mysql_query($updatedb);

} elseif ($row[0] == "QA") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="cyan">QA Team record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$qacount = $row[2] + $qacount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='QA'";
        mysql_query($updatedb);

} elseif ($row[0] == "Eatec") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="cyan">Eatec record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$eacount = $row[2] + $eacount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='Eatec'";
        mysql_query($updatedb);

} elseif ($row[0] == "DMS") {
        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="cyan">DMS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$dmscount = $row[2] + $dmscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='DMS'";
        mysql_query($updatedb);

}
}

echo "Creating IG POS Graph...<br>";
// ******************************
// Generate Pie Graph for IG POS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='InfoGenesis POS' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,400);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,341,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,343,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/igpos.png");  

echo "Creating IG CS Graph...<br>";
// ******************************
// Generate Pie Graph for IG CS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='IG Customer Service' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,400);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,341,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,343,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/igcs.png");  

echo "Creating Lvl3 Graph...<br>";
// ******************************
// Generate Pie Graph for Lvl3
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='Level III Escalations' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,275);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,271,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,273,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/lvl3.png");
  
echo "Creating LMS Graph...<br>";
// ******************************
// Generate Pie Graph for LMS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='LMS' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  

// Initialise the graph
$Test = new pChart(570,400);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,341,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,343,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/lms.png");  

echo "Creating LMS DEV Graph...<br>";
// *******************************
// Generate Pie Graph for LMS DEV
// *******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='LMS DEV' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(590,400);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,587,341,5,240,240,240);
$Test->drawRoundedRectangle(5,5,589,343,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/lmsdev.png");  

echo "Creating V1 Graph...<br>";
// ******************************
// Generate Pie Graph for V1
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='V1' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,400);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,341,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,343,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/v1.png");  

echo "Creating V1 INTS  Graph...<br>";
        // STUPID FIX FOR V1 INTS DEPARTMENT

        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="red">APPLY FIX FOR V1 INTS BEFORE GRAPH IS CREATED</font></b><br>';

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets =  '1' WHERE id='179'";
        mysql_query($updatedb);

echo "Creating V1 INTS Graph...<br>";
// ******************************
// Generate Pie Graph for V1 INTS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='V1 INTS' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,275);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,271,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,273,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/v1ints.png");  

echo "Creating V1 NET  Graph...<br>";
        // STUPID FIX FOR V1 NET DEPARTMENT

        // Connect and Select
        mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="red">APPLY FIX FOR V1 NET BEFORE GRAPH IS CREATED</font></b><br>';

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets =  '1' WHERE id='183'";
        mysql_query($updatedb);

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets =  '1' WHERE id='186'";
        mysql_query($updatedb);

echo "Creating V1 NET Graph...<br>";
// ******************************
// Generate Pie Graph for V1 NET
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='V1 NET' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,275);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,271,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,273,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/v1net.png");  

echo "Creating MMS Graph...<br>";
	// STUPID FIX FOR MMS DEPARTMENT

	// Connect and Select
	mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="red">APPLY FIX FOR QA BEFORE GRAPH IS CREATED</font></b><br>';

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets =  '1' WHERE id='182'";
        mysql_query($updatedb);

// ******************************
// Generate Pie Graph for MMS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='MMS' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,275);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,271,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,273,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/mms.png");  

echo "Creating QA Graph...<br>";
	// STUPID FIX FOR QA DEPARTMENT

	// Connect and Select
	mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="red">APPLY FIX FOR QA BEFORE GRAPH IS CREATED</font></b><br>';

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets =  '1' WHERE id='177'";
        mysql_query($updatedb);

// ******************************
// Generate Pie Graph for QA
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='QA' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,275);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,271,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,273,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/qa.png");  

echo "Creating DMS Graph...<br>";
	// STUPID FIX FOR DMS DEPARTMENT

	// Connect and Select
	mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

        // Print Information to Screen
        echo '<b><font color="red">APPLY FIX FOR QA BEFORE GRAPH IS CREATED</font></b><br>';

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets =  '1' WHERE id='181'";
        mysql_query($updatedb);

// ******************************
// Generate Pie Graph for DMS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM employees WHERE dept='DMS' ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[3] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[2]);
         array_push($ticketlist, $row[3]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,275);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,271,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,273,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/dms.png");  

echo "Update Open Total open tickets...<br>";
// *****************************************
// Push the total ticket count to the dbase.
// *****************************************

	// Connect and Select
	mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

	// Query Database and update record       
	$updatedb = "UPDATE dept SET tickets='$guest360count' WHERE name='Guest 360'";
        mysql_query($updatedb);
	
	$updatedb = "UPDATE dept SET tickets='$igposcount' WHERE name='Infogenesis POS'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$lvl3count' WHERE name='Level III Escalations'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$v1count' WHERE name='V1'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$v1netcount' WHERE name='V1 NET'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$eacount' WHERE name='Eatec'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$mmscount' WHERE name='MMS'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$igcscount' WHERE name='IG Customer Service'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$lmscount' WHERE name='LMS'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$lmsdevcount' WHERE name='LMS DEV'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$qacount' WHERE name='QA'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$intcount' WHERE name='Interface Team'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$v1intscount' WHERE name='V1 INTS'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$dmscount' WHERE name='DMS'";
        mysql_query($updatedb);

echo "Creating Totals Graph...<br>";
// ******************************
// Generate Pie Graph for Totals
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect and Select
mySQL_conn($dbhost, $dbase, $dbuser, $dbpass);

// Query Database
$result = mysql_query("SELECT * FROM dept ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
if ($row[2] < 1) {
        // do nothing
} else {
         array_push($namelist, $row[1]);
         array_push($ticketlist, $row[2]);
}
}

// Dataset definition   
$DataSet = new pData;  
$DataSet->AddPoint(array($ticketlist),"Serie1");  
$DataSet->AddPoint(array($namelist),"Serie2");  
$DataSet->AddAllSeries();  
$DataSet->SetAbsciseLabelSerie("Serie2");  
 
// Initialise the graph
$Test = new pChart(570,275);
$Test->loadColorPalette("pChart/color2.txt");
$Test->drawFilledRoundedRectangle(7,7,567,271,5,240,240,240);
$Test->drawRoundedRectangle(5,5,569,273,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("pChart/fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
  
$Test->Render("img/totals.png");  

	echo "Update Complete.<br>";
?>
