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
$sql = "SELECT option1 AS options,count(answer) AS count FROM emp_ans WHERE ques_id='$ques_id' AND answer='1' ";
$result = mysql_query($sql,$connection) or die("Error in Selecting " . mysql_error($connection));
$ans1_count = mysql_fetch_assoc($result);

$sql2 = "SELECT option2 AS options,count(answer) AS count FROM emp_ans WHERE ques_id='$ques_id' AND answer='2' ";
$result2 = mysql_query($sql2,$connection) or die("Error in Selecting " . mysql_error($connection));
$ans2_count = mysql_fetch_assoc($result2);

$sql3 = "SELECT option3 AS options,count(answer) AS count FROM emp_ans WHERE ques_id='$ques_id' AND answer='3' ";
$result3 = mysql_query($sql3,$connection ) or die("Error in Selecting " . mysql_error($connection));
$ans3_count = mysql_fetch_assoc($result3);

$sql4 = "SELECT option4 AS options,count(answer) AS count FROM emp_ans WHERE ques_id='$ques_id' AND answer='4' ";
$result4 = mysql_query($sql4,$connection ) or die("Error in Selecting " . mysql_error($connection));
$ans4_count = mysql_fetch_assoc($result4);

$data= array(
 $ans1_count,
 $ans2_count,
 $ans3_count,
 $ans4_count
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