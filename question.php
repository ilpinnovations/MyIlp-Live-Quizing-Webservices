<?php
include_once('my_ilp_db.php'); 
$emp_id = $_POST['emp_id'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$question =$_POST['question'];
$correct_answer = $_POST['correct_answer'];
$data = array();
if(isset($emp_id))
{
	
$query = "SELECT question AS count FROM ibuzquestions WHERE emp_id='$emp_id'";
$result = mysql_query($query,$connection);
$row = mysql_num_rows($result);

if($row>=5)
{
	$data[]=array(
"null_trigger"=>"You have already submitted 5 questions"
);
	}
else
{
	$query2 = "SELECT emp_loc,emp_name FROM emp_reg WHERE emp_id='$emp_id'";
$result2 = mysql_query($query2,$connection);
$row2 = mysql_fetch_assoc($result2);
$centre= $row2['emp_loc'];
$name= $row2['emp_name'];

	$sql2="INSERT INTO ibuzquestions(emp_id,option1,option2,option3,option4,question,submit_time,correct_ans,emp_loc,emp_name) VALUES('$emp_id','$option1','$option2','$option3','$option4','$question',NOW(),'$correct_answer','$centre','$name')";
$result2 = mysql_query($sql2,$connection) or die("Error in Selecting " . mysql_error($connection));
if($result2)
{
$data[]=array(
"success"=>"Question added successfully"
);}
	}
header('content-type:application/json');
echo json_encode(array('data'=>$data));  
}
mysql_close($connection);
?>