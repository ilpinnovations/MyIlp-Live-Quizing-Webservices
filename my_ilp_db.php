<?php
$db_username = "jeet";
$db_password = "J@447788";
$db_host = "localhost";
$db_name = "schedulingnew";
$connection = mysql_connect($db_host,$db_username,$db_password) or die('Cannot connect to Database');
mysql_select_db($db_name,$connection) or die('Error selecting Database');

?>