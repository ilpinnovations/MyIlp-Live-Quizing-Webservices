<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('my_ilp_db.php'); 
$emp_id = $_GET['emp_id'];
$data = array();
if(isset($emp_id))
{
	
$query5 = "SELECT * FROM emp_reg WHERE emp_id='$emp_id'";
$result5 = mysql_query($query5,$connection);
$rows5 = mysql_num_rows($result5);
if($rows5==1)
{
	
	$query = "SELECT emp_id FROM ibuzquestions WHERE emp_id='$emp_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
if($rows>=1)
{
	
$query1 = "SELECT * FROM ibuzquestions WHERE emp_id='$emp_id'";
$result1 = mysql_query($query1,$connection);

while($row = mysql_fetch_assoc($result1))
{
$data[]= $row;
}
echo json_encode(array('data_faculty'=>$data));
}
else{
	
$query2 = "select * from ibuzquestions WHERE status='Active' AND ques_id not in (select ques_id from ibuzanswers where emp_id='$emp_id')";
$result2 = mysql_query($query2,$connection);

while($row2 = mysql_fetch_assoc($result2))
{
$data[]= $row2;
}
echo json_encode(array('data_employee'=>$data));
}


	}
else
{
	
	$data[]=array(
"null_trigger"=>"User do not exist"
);
//header('content-type:application/json');
echo json_encode(array('error'=>$data));
	}

}
mysql_close($connection);
?>