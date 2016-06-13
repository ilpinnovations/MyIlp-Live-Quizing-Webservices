<?php
include_once('my_ilp_db.php'); 
//$query = $_POST['param'];
$query = "param1=1038233&param2=komal+dua&param3=kaustav&param4=dg&param5=sdfd&param6=what+is+your+name&param7=1";

foreach (explode('&', $query) as $chunk) {
    $param = explode("=", $chunk);
$emp_id = urldecode($param[1]);
$option1 = urldecode($param[1]);
$option2 = urldecode($param[1]);
$option3 = urldecode($param[1]);
$option4 = urldecode($param[1]);
$question =urldecode($param[1]);
$correct_answer = intval(urldecode($param[1]));
   
}
echo $emp_id;
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