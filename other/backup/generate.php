<?
// Include Config File
include('config.php');

/// Clear Employee Call Counts
// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}
// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

// Query Database
$result = mysql_query("SELECT * FROM employees ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error());

// Print the results of the Query (#, title, url)
$i = 0;
while(($row = mysql_fetch_array($result)) !== false)
{
$i++;
   echo "Settings " . $row[1] . " call count to 0<br>";
   $updatedb = "UPDATE employees SET tickets=0 WHERE name='$row[1]'";
   mysql_query($updatedb);
}

// Connect to MsSQL or error, then select Database, then Query
$dbhandle = mssql_connect($msdbhost, $msdbuser, $msdbpass) or die('Could not connect to SQL Server on $msdbhost'); 
$selected = mssql_select_db($msdbase) or die("Could not open database $msdbase"); 
$result = mssql_query("select Groupname,Assignee,count(distinct asgnmnt.callid) as boxcount from Asgnmnt inner join calllog on asgnmnt.callid=calllog.callid and whoresolv='' where calllog.callstatus = 'Open' or calllog.callstatus = 'Reopened' group by Groupname,Assignee order by boxcount DESC");

// Setup Ticket Totals
$igposcount = "";
$lvl3count = "";
$v1count = "";
$mmscount = "";
$igcscount = "";
$lmscount = "";

while ($row = mssql_fetch_row($result)) {
if ($row[0] == "InfoGenesis POS") {
	// Connect to MySQL Database
	$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
	mysql_select_db($dbase) or die( "Unable to select database<br>");

	// Print Information to Screen
        echo '<b><font color="red">Infogenesis POS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$igposcount = $row[2] + $igposcount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='InfoGenesis POS'";
        mysql_query($updatedb);
	
	// Close the MySQL Database
	mysql_close($dbconnect);

} elseif ($row[0] == "Level III Escalations") {
// Connect to MySQL Database
        $dbconnect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
        mysql_select_db($dbase) or die( "Unable to select database<br>");

        // Print Information to Screen
        echo '<b><font color="blue">Level III Escalations record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$lvl3count = $row[2] + $lvl3count;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='Level III Escalations'";
        mysql_query($updatedb);

        // Close the MySQL Database
        mysql_close($dbconnect);

} elseif ($row[0] == "V1") {
// Connect to MySQL Database
        $dbconnect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
        mysql_select_db($dbase) or die( "Unable to select database<br>");

        // Print Information to Screen
        echo '<b><font color="green">V1 record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$v1count = $row[2] + $v1count;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='V1'";
        mysql_query($updatedb);

        // Close the MySQL Database
        mysql_close($dbconnect);

} elseif ($row[0] == "MMS") {
// Connect to MySQL Database
        $dbconnect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
        mysql_select_db($dbase) or die( "Unable to select database<br>");

        // Print Information to Screen
        echo '<b><font color="black">MMS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$mmscount = $row[2] + $mmscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='MMS'";
        mysql_query($updatedb);

        // Close the MySQL Database
        mysql_close($dbconnect);

} elseif ($row[0] == "IG Customer Service") {
// Connect to MySQL Database
        $dbconnect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
        mysql_select_db($dbase) or die( "Unable to select database<br>");

        // Print Information to Screen
        echo '<b><font color="purple">IG Customer Service record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$igcscount = $row[2] + $igcscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='IG Customer Service'";
        mysql_query($updatedb);

        // Close the MySQL Database
        mysql_close($dbconnect);

} elseif ($row[0] == "LMS") {
// Connect to MySQL Database
        $dbconnect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
        mysql_select_db($dbase) or die( "Unable to select database<br>");

        // Print Information to Screen
        echo '<b><font color="orange">LMS record imported</font>, Name: ' . $row[1] . ', Tickets: ' . $row[2] . '</b><br>';

	$lmscount = $row[2] + $lmscount;

        // Query Database and update record
        $updatedb = "UPDATE employees SET tickets='$row[2]' WHERE name='$row[1]' AND dept='LMS'";
        mysql_query($updatedb);

        // Close the MySQL Database
        mysql_close($dbconnect);

} else {
	// echo "Not a valid account";
}
}
//Close the MsSQL connection
mssql_close($dbhandle);

echo "Creating IG POS Graph...<br>";
// ******************************
// Generate Pie Graph for IG POS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}

// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

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

// Standard inclusions     
include("pChart/pData.class");  
include("pChart/pChart.class");  
  
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
  
$Test->Render("img/igpos.png");  

echo "Creating Lvl3 Graph...<br>";
// ******************************
// Generate Pie Graph for Lvl3
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}

// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

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

// Standard inclusions     
include("pChart/pData.class");  
include("pChart/pChart.class");  
  
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

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}

// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

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

// Standard inclusions     
include("pChart/pData.class");  
include("pChart/pChart.class");  
  
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
  
$Test->Render("img/lms.png");  

echo "Creating V1 Graph...<br>";
// ******************************
// Generate Pie Graph for V1
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}

// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

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

// Standard inclusions     
include("pChart/pData.class");  
include("pChart/pChart.class");  
  
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
  
$Test->Render("img/v1.png");  

echo "Creating MMS Graph...<br>";
// ******************************
// Generate Pie Graph for MMS
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}

// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

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

// Standard inclusions     
include("pChart/pData.class");  
include("pChart/pChart.class");  
  
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

echo "Creating Totals Graph...<br>";
// ******************************
// Generate Pie Graph for Totals
// ******************************

// Init Arrays
$namelist = array();
$ticketlist = array();

// Connect to Database
$dbconnect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$dbconnect) {
   die('Could not connect: ' . mysql_error());
}

// Select Database
mysql_select_db($dbase) or die( "Unable to select database<br>");

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

// Standard inclusions     
include("pChart/pData.class");  
include("pChart/pChart.class");  
  
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

echo "Update Open Total open tickets...<br>";
// *****************************************
// Push the total ticket count to the dbase.
// *****************************************
// $igposcount = "0";
// $lvl3count = "0";
// $v1count = "0";
// $mmscount = "0";
// $igcscount = "0";
// $lmscount = "0";

	// Connect to MySQL Database
        $dbconnect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
        mysql_select_db($dbase) or die( "Unable to select database<br>");

        // Query Database and update record
        $updatedb = "UPDATE dept SET tickets='$igposcount' WHERE name='Infogenesis POS'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$lvl3count' WHERE name='Level III Escalations'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$v1count' WHERE name='V1'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$mmscount' WHERE name='MMS'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$igcscount' WHERE name='IG Customer Service'";
        mysql_query($updatedb);

        $updatedb = "UPDATE dept SET tickets='$lmscount' WHERE name='LMS'";
        mysql_query($updatedb);

        // Close the MySQL Database
        mysql_close($dbconnect);

	echo "Update Complete.<br>";
?>
