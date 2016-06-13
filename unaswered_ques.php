<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$emp_id = $_GET['emp_id'];
$data = array();
if(isset($emp_id))
{
	
$query = "SELECT * FROM emp_reg WHERE emp_id='$emp_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows==1)
{
$query1 = "select ques_id, question from ibuzquestions WHERE status='Active' AND ques_id not in (select ques_id from ibuzanswers where emp_id='2')";
$result1 = mysql_query($query1,$connection);
while($row = mysql_fetch_assoc($result1))
{
$data[]= $row;
}

}
else{
$data=array(
"null_trigger"=>"Invalid Employee ID"
);
}
//header('content-type:application/json');
echo json_encode(array('data' =>$data));
}
mysql_close($connection);
?>