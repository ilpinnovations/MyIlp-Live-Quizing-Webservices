<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$current_date = new DateTime();

$sql= "SELECT submit_time,ques_id FROM ibuzquestions";
$result = mysql_query($sql,$connection) or die("Error in Selecting " . mysql_error($connection));

while($dates = mysql_fetch_assoc($result))
{
	$date=$dates['submit_time'];
	
	$q_id = $dates['ques_id'];
$new_date = new DateTime($date);
$interval = $current_date->diff($new_date);
$elapsed = $interval->format('%i');
if($elapsed>=30)
{
	$sql1= "UPDATE ibuzquestions SET status='Inactive' WHERE ques_id='$q_id' ";
$result2 = mysql_query($sql1,$connection) or die("Error in Selecting " . mysql_error($connection));
$sql2= "DELETE FROM ibuzanswers WHERE ques_id='$q_id'";
$result3 = mysql_query($sql2,$connection) or die("Error in Selecting " . mysql_error($connection));

	}
	}
mysql_close($connection);
?>