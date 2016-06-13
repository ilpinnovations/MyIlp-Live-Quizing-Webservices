<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$ques_id = $_GET['q_id'];
$data = array();
$ans_option = $_GET['ans_option'];
$emp_id = $_GET['emp_id'];

if(isset($emp_id) && isset($ques_id) && isset($ans_option))
{
$sql2="INSERT INTO ibuzanswers(emp_id,ques_id,answer,submit_time) VALUES('$emp_id','$ques_id','$ans_option',NOW())";
$result2 = mysql_query($sql2,$connection) or die("Error in Selecting " . mysql_error($connection));
if($result2)
{
$data[]=array(
"message"=>"Answer sumitted successfully"
);
}
else
{
$data[]=array(
"message"=>"Error in submitting answer"
);	
}

//header('content-type:application/json');
echo json_encode(array('data'=> $data));
  
  
}
 mysql_close($connection);
?>