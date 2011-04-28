<?php

// Setup Department name
$dept_name = *********REAPLCE WITH DEPARTMENT VAR **********;

// Query Database
$dept_ticket_result = mysql_query("SELECT * FROM `dept` WHERE `name` = '$dept_name'") or die('Query failed: ' . mysql_error());

// Fetch Current Ticket count and update 
$dept_tickets = mysql_fetch_array($dept_ticket_result) or die(mysql_error());
$new_count = $dept_tickets['tickets'] + ***** REPLACE WITH CORRECT VAR *********;
$dept_ticket_update = mysql_query("UPDATE `dept` SET `tickets` =  '$new_count' WHERE `name` = '$dept_name' LIMIT 1") or die('Query failed: ' . mysql_error());

?>
