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
<table border="0" cellspacing="1" cellpadding="0" width="98%">
<tbody>
<form name="contact_form" method="post" action="send">
  <div align="center">Name<br>
    <input name="name" type="text" size="50">
    <br>
    Email Address<br>
    <input name="email" type="text" size="50" maxlength="200">
    <br>
    Information<br>
    <textarea name="information" cols="50" rows="10"></textarea>
    <br>
    <input type="submit" name="Submit" value="Submit">
    <input type="reset" name="Submit2" value="Clear">
  </div>
</form>
</tbody>
</table>

