<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 

$ques_id = $_GET['q_id'];
$data = array();
if(isset($ques_id))
{
$query = "SELECT ques_id FROM ibuzquestions WHERE ques_id='$ques_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows==1)
{
	$sql = ";";
$sql = "select emp_loc As centre,count(*) AS count from emp_ans WHERE ques_id='$ques_id' AND answer=correct_ans AND emp_loc='Trivandrum'";
$result = mysql_query($sql,$connection) or die("Error in Selecting " . mysql_error($connection));
$trivandrum_count = mysql_fetch_assoc($result);

$sql2 = "select emp_loc As centre,count(*) AS count from emp_ans WHERE ques_id='$ques_id' AND answer=correct_ans AND emp_loc='Hydrabad' ";
$result2 = mysql_query($sql2,$connection) or die("Error in Selecting " . mysql_error($connection));
$hydrabad_count = mysql_fetch_assoc($result2);

$sql3 = "select emp_loc As centre,count(*) AS count from emp_ans WHERE ques_id='$ques_id' AND answer=correct_ans AND emp_loc='Chennai'";
$result3 = mysql_query($sql3,$connection ) or die("Error in Selecting " . mysql_error($connection));
$chennai_count = mysql_fetch_assoc($result3);

$sql4 = "select emp_loc As centre,count(*) AS count from emp_ans WHERE ques_id='$ques_id' AND answer=correct_ans AND emp_loc='Ahemdabad' ";
$result4 = mysql_query($sql4,$connection ) or die("Error in Selecting " . mysql_error($connection));
$ahemdabad_count = mysql_fetch_assoc($result4);

$sql5 = "select emp_loc As centre,count(*) AS count from emp_ans WHERE ques_id='$ques_id' AND answer=correct_ans AND emp_loc='Guwahati'";
$result5 = mysql_query($sql5,$connection) or die("Error in Selecting " . mysql_error($connection));
$guwahati_count = mysql_fetch_assoc($result5);

$data= array(
 $trivandrum_count,
$hydrabad_count,
$chennai_count,
$ahemdabad_count,
$guwahati_count
);	
}
else
{
	$data[]=array(
"null_trigger"=>"Question does not exist"
);
	}
//header('content-type:application/json');
echo json_encode(array('data' =>$data));
}
 mysql_close($connection);
?>