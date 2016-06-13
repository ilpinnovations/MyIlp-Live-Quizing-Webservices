<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$q_id = $_GET['q_id'];
$data = array();
if(isset($q_id))
{
	$query = "SELECT ques_id FROM ibuzquestions WHERE ques_id='$q_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows==1)
{
	$sql1= "DELETE FROM ibuzquestions WHERE ques_id='$q_id'";
$result2 = mysql_query($sql1,$connection) or die("Error in Selecting " . mysql_error($connection));
if($result2)
{
$data=array(
"success"=>"Question deleted successfully"
);
}else
{
	$data=array(
"null_trigger"=>"Failed to delete question"
);
	}
}
else
{
	$data=array(
"null_trigger"=>"Question does not exist"
);
	}

	}
//header('content-type:application/json');
echo json_encode($data);

mysql_close($connection);
?>