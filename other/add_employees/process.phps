<?php
// Load the config of goodness
include('../config.php');

// Setup Department array
$departments = array("Applications Hosting", "DMS", "Eatec", "Eatec Dev", "Eatec Interfaces", "Eatec QA", "Eatec Reports", "Eatec Tech", "Eatec Upgrades", "Eatec-SIS", "Escalate to QA", "Field Services", "Guest 360", "HSG Support Tools", "IG Customer Service", "IG Entitlement", "InfoGenesis POS", "Interface Team", "International", "Level III Escalations", "LMS", "LMS DEV", "LMS INTS", "MMS", "Oil", "PBS", "QA", "Support", "UK POS", "V1", "V1 INTS", "V1 NET", "Virtual Expert");

// Connect/Select Database
mysql_connect("$dbhost", "$dbuser", "$dbpass") or die(mysql_error());
mysql_select_db("$dbase") or die(mysql_error());

// Open CSV file for import
$handle = fopen("users.csv", "r");

// Loop with magical goodness and insert into database
while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
	foreach ($departments as &$value) {
		$query = "INSERT INTO employees (`id`, `name`, `realname`, `tickets`, `dept`) VALUES (NULL, '$data[0]', '$data[1]', '0', '$value')";
		$result = mysql_query($query) or die(mysql_error());
		echo $data[1] . ' successfully added to ' . $value . ' department<br>';
	}
}
// Destroy array
unset($value);
?>
