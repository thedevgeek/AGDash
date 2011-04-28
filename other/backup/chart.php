<?php  
 // Include Config File
 include('../config.php');

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
 // $result = mysql_query("SELECT * FROM dept ORDER BY `tickets` DESC") or die('Query failed: ' . mysql_error()); 
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
 include("../pChart/pData.class");  
 include("../pChart/pChart.class");  
  
 // Dataset definition   
 $DataSet = new pData;  
 $DataSet->AddPoint(array($ticketlist),"Serie1");  
 $DataSet->AddPoint(array($namelist),"Serie2");  
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie("Serie2");  
  
 // Initialise the graph  
 $Test = new pChart(570,400);  
 $Test->loadColorPalette("../pChart/color.txt");
 $Test->drawFilledRoundedRectangle(7,7,567,341,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,569,343,5,230,230,230);  
  
 // Draw the pie chart  
 $Test->setFontProperties("../pChart/fonts/tahoma.ttf",8);  
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),225,130,175,PIE_PERCENTAGE,TRUE,50,20,5);  
 $Test->drawPieLegend(437,12,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  
  
//$Test->Render("chart.png");  
 $Test->Stroke("totals.png");  
?> 
