<?php
include_once('my_ilp_db.php'); 
$q_id = $_POST['q_id'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$question =$_POST['question'];
$correct_answer = $_POST['correct_answer'];
$data = array();
if(isset($q_id))
{
	$sql1= "UPDATE ibuzquestions SET option1='$option1', option2='$option2',option3='$option3',option4='$option4',question='$question',correct_ans='$correct_answer' WHERE ques_id='$q_id' ";
$result2 = mysql_query($sql1,$connection) or die("Error in Selecting " . mysql_error($connection));
if($result2)
{
$data[]=array(
"success"=>"Question updated successfully"
);
}else
{
	$data[]=array(
"success"=>"Failed to update question"
);
	}
	}
header('content-type:application/json');
echo json_encode(array('data'=>$data));  

mysql_close($connection);
?>